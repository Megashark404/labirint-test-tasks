<?php

/* СКРИПТ ПРИНИМАЕТ ТЕКУЩЕЕ СОСТОЯНИЕ ПОЛЯ И ВЫДАЕТ СЛЕДУЮЩЕЕ СОСТОЯНИЕ ПОЛЯ*/




// Получаем поле
$data = file_get_contents('php://input');
$field = json_decode($data);

// высчитываем размеры поля
$m = count($field);
$n = count($field[0]);

// создаем новый массив, в который будем записывать следующее состояние поля (копируем старый)
$nextField = $field;

// запускаем цикл, который определяет следующее состояние клетки (согласно заданию). Записываем следующие состояние в массив nextField
for ($i=0; $i<$m; $i++) {

	for ($j=0; $j<$n; $j++) {

		// вычисляем состояние (активная или неактивная)
		$state = getState($i,$j);

		if ($state == 0 && countActiveNeighbors($i,$j) == 3) { // Активация
			$nextField[$i][$j] = 1; 
		}
		elseif ($state == 1) {

			if (countActiveNeighbors($i,$j) >= 4 OR countActiveNeighbors($i,$j) <= 1) { // Перегрузка и изоляция
				$nextField[$i][$j] = 0; 
			} 
			else {
				$nextField[$i][$j] = 1; // Вымирание
			}
		}
	}
		
}

// Перед следующей итерацией цикла обновяем поле в соответствии с правилами
$field = $nextField;

// выдаем обновленное поле
header('Content-Type: application/json; charset=utf-8');
echo json_encode($field);













// функция подсчета активных соседей
function countActiveNeighbors($i, $j) {
	global $field;
	global $m, $n;

	$count = 0;

	for ($k = $i-1; $k <= $i+1; $k++) {
		// если координаты клетки выпадают за границы поля, пропускаем шаг цикла
		if ($k < 0 OR $k > $m - 1) continue;
		for ($l = $j-1; $l <= $j+1; $l++)  {	
			// если координаты клетки выпадают за границы поля, пропускаем шаг цикла		
			if ($l < 0 OR $l > $n - 1) continue; 
			// координаты попадают на саму клетку, пропускаем 
			if ($l == $j AND $k == $i) continue; 

			// считаем активные клетки
			if (getState($k,$l) == 1) {
				$count = $count + 1;
			}
		}
	}

	return $count;
}


// функция, возвращающая состояние клетки (активная, неактивная)
function getState($i, $j) {
	global $field;

	if ($field[$i][$j] == 1) {
		return 1;
	}
	else {
		return 0;
	}
};

?>