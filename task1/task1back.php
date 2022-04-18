<?php

/*    СКРИПТ ПАРСИТ И ВЫДАЕТ ДАННЫЕ О ПОГОДЕ И ВАЛЮТЕ   */


$currency = array(); // Здесь будем хранить данные о валюте
$weather = array(); // Здесь будем хранить данные о погоде
$result = array(); // Итоговый массив, на его основе создадим json ответ



// Парсим валюту

$url = 'http://www.cbr.ru/scripts/XML_daily.asp';

// т.к. результат выдается в xml формате, открываем через simplexm
$xml = simplexml_load_file($url);
		
// в цикле разбираем ответ, берем только то что нам надо
foreach ($xml->Valute as $valute) {	

	// формируем массив с данными о валюте	
	$currency[$valute->CharCode->__toString()] = array(
		'charcode' => $valute->CharCode->__toString(),
		'nominal' => $valute->Nominal->__toString(),
		'name' => $valute->Name->__toString(),
		'value' => $valute->Value->__toString()
	);
}		



// Парсим погоду

$APIkey = '2759831927443e619ef3e64530806fe3'; // API ключ для доступа к сервису
$lat = '55.7504461'; // координаты Москвы. получено через https://openweathermap.org/api/geocoding-api
$lon ='37.6174943';
$units='metric'; // указываем, что будем получать температуру в цельсиях
$url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$APIkey}&lang=ru&units={$units}";

// получаем данные, здесь они выдаются в json формате
$weatherApiResponse = json_decode(file_get_contents($url));

// заполняем массив нужными данными
$weather = array(
	'description' => $weatherApiResponse->weather[0]->description,
	'temp' => $weatherApiResponse->main->temp,
	'feels_like' => $weatherApiResponse->main->feels_like
);


// формируем итоговый массив
$result['currency']  = $currency;
$result['weather'] = $weather;

// выдаем результат в json формате
header('Content-Type: application/json; charset=utf-8');
echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>