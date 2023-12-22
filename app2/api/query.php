<?php
//處理查詢資料的請求

include_once "";

switch($_GET['do']){
	case "all":
		echo json_encode($Student->all());

	break;
}


?>