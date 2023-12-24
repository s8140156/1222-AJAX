<?php
//處理查詢資料的請求

include_once "db.php";

switch($_GET['do']){
	case "all":
        header('Content-Type: application/json; charset=utf-8');
		// 在php要帶資料出去前先把格式改成json, 就不用在js那邊轉格式
		echo json_encode($Student->all());
	break;
	case "sex":
		$users=$Student->q("select `name`,`uni_id`,`school_num`,`birthday` from  `students` where substr(`uni_id`,2,1)='{$_GET['value']}'");
		//使用直接的sql語法並只撈需求的欄位及條件(視前端如何設定)比原先整個資料撈出來(xhr 113k)資料量會少非常多(xhr 30k(男生) 8k(女生)篩選過後加起來還是比全撈資料量小)
        header('Content-Type: application/json; charset=utf-8');
		echo json_encode($users);
		// dd($_GET['value']);
		//解析GET送過來的有do=def, 還有陣列拆分[0]=>sex, [1]=>1
	break;
    case 'class':
		//這邊是聯表操作
		//先是確認傳進來的班級代碼是什麼去資料庫撈出
        $stnums=$ClassStudent->all(['class_code'=>$_GET['value']]);
        // dd($stnums);
        $nums=[];
        foreach($stnums as $st){
            $s=$Student->find(['school_num'=>$st['school_num']]);
            if(!empty($s)){
                $nums[]=$s['id'];
				// 從聯表classstudent對應班級後 製作一個空陣列 除了把$stnums資料拆開後加入,並去找另一張student 以school_num對應連結 去取student的id放進$nums=[]陣列中
            }
        }
        $in=join(',',$nums);
        $users=$Student->q("select `name`,`uni_id`,`school_num`,`birthday` from `students` where `id` in($in)");
		//這邊使用sql語法in(特殊指定) 將上述指定的資料插進去
		//注意這邊是先將陣列轉成字串 然後再把字串插進去sql語法裡

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($users);
    break;
    case 'classes':
        $classes=$Class->q("select `code`,`name` from `classes`");
        header('Content-Type: application/json; charset=utf-8');        
        echo json_encode($classes);
		//這邊是在判斷當傳值do=classes時,針對按下哪個班級的button去做對應班級的撈資料
		// 而button在用變數方式
    break;
}


?>