<?php
//處理查詢資料的請求

include_once "db.php";

switch($_GET['do']){
	case "all":
        header('Content-Type: application/json; charset=utf-8');
		// 在php要帶資料出去前先把格式改成json, 就不用在js那邊轉格式
		echo json_encode($Student->all());
	break;
	case "def":
		dd($_GET);
		//解析GET送過來的有do=def, 還有陣列拆分[0]=>sex, [1]=>1
	break;
}


?>