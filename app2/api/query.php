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
	case "class":
		dd($_GET['value']);
		//解析GET送過來的有do=def, 還有陣列拆分[0]=>sex, [1]=>1
	break;
}


?>