<?php

/* СКРИПТ ВЫДАЕТ СЛУЧАЙНОЕ ПОЛЕ ПО ЗАДАННЫМ РАЗМЕРАМ*/



$data = file_get_contents('php://input');
$dimensions = json_decode($data);
$m = $dimensions->m;
$n = $dimensions->n;

for($i = 0; $i < $m; $i++) {	
		$field[] = array_fill(0, $n, rand(0,1));	
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($field);


?>