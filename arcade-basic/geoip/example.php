<?php
require_once("ipgeobase.php");
$gb = new IPGeoBase();
#$data = $gb->getRecord('46.46.152.210');
#var_dump($data);
/*
array(7) {
  ["range"]=>
  string(27) "46.46.128.0 - 46.46.169.255"
  ["cc"]=>
  string(2) "RU"
  ["city"]=>
  string(6) "Москва"
  ["region"]=>
  string(6) "Москва"
  ["district"]=>
  string(29) "Центральный федеральный округ"
  ["lat"]=>
  string(9) "55.755787"
  ["lng"]=>
  string(9) "37.617634"
}
*/
#$data = $gb->getRecord('192.168.0.1');
#var_dump($data);
//bool(false)
$regions = array();
for($i = 1; $i < 3500; $i++) {
	$data = $gb->getCityById($i);
	if($data && $data['cc'] == 'RU') {
		$regions[$data['region']] = 1;
	}
}

$regions = array_keys($regions);
sort($regions, SORT_STRING);

foreach($regions as $region) {
	echo $region . "<br />";
}

?>