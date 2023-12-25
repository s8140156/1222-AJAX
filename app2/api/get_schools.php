<?php

include_once "db.php";

$schools=$GraduateSchool->all();
$options="";
foreach($schools as $school){
	$options.="<option value='{$school['id']}'>{$school['county']}{$school['name']}</option>";
	// 這是以字串格式要傳回前端
}

echo $options;

?>