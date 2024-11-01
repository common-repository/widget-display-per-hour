<?php
if ($_POST["data"] && $_POST["actual"]) {
	$data = json_decode(base64_decode($_POST['data']));
	$actual = $_POST["actual"];
	$inicio = $data->startime_hour*3600 + $data->startime_min*60;
	$fin = $data->endtime_hour*3600 + $data->endtime_min*60;
	if ($actual >= $inicio && $actual<= $fin) {
		$result= $data;
	}else{
		$result="no";
	}
}
print_r(json_encode($result));