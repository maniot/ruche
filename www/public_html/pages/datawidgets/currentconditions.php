<?php

// Get Hive Data First
$alldatasth = $conn->prepare("SELECT hiveweight, hiverawweight, hivetempf, hivetempc, hiveHum, weather_tempf, weather_tempc, weather_humidity, precip_1hr_in, solarradiation, lux, date AS datetime FROM allhivedata ORDER BY datetime(\"date\") DESC LIMIT 1");
$alldatasth->execute();
$alldata = $alldatasth->fetch(PDO::FETCH_ASSOC);

$sth1 = $conn->prepare("SELECT seasongdd, daygdd FROM gdd ORDER BY datetime(\"calcdate\") DESC LIMIT 1;");
$sth1->execute();
$gdddata = $sth1->fetch(PDO::FETCH_ASSOC);


if ($chart_rounding == "on") {
	if ($SHOW_METRIC == "on") {
		# Show Metric or do calcs
		# Get Hivetempc and pass it via hivetempf
		$hivetempf = ceil($alldata['hivetempc']);
		$wxtempf = ceil($alldata['weather_tempc']);
		$imperialweight = $alldata['hiveweight'];
		$hiveweight = round(($imperialweight * 0.453592),1);
		$imperialraw = $alldata['hiverawweight'];
		$rawweight = round(($imperialraw * 0.453592),1);

	} else {
		#Show Imperial
		$hivetempf = ceil($alldata['hivetempf']);
		$hiveweight = ceil($alldata['hiveweight']);
		$wxtempf = ceil($alldata['weather_tempf']);
		$rawweight = ceil($alldata['hiverawweight']);
	}

	$hivehumi = ceil($alldata['hiveHum']);
	$wxhumi = ceil($alldata['weather_humidity']);
	$datetime = ceil($alldata['datetime']);
	$daygdd = ceil($gdddata['daygdd']);
	$seasongdd = ceil($gdddata['seasongdd']);
}
else {
	if ($SHOW_METRIC == "on") {
		# Show Metric or do calcs
		# Get Hivetempc and pass it via hivetempf
		$hivetempf = $alldata['hivetempc'];
		$wxtempf = $alldata['weather_tempc'];
		$imperialweight = $alldata['hiveweight'];
		$hiveweight = round(($imperialweight * 0.453592),2);
		$imperialraw = $alldata['hiverawweight'];
		$rawweight = round(($imperialraw * 0.453592),2);

	} else {
		#Show Imperial
		$hivetempf = $alldata['hivetempf'];
		$hiveweight = $alldata['hiveweight'];
		$wxtempf = $alldata['weather_tempf'];
		$rawweight = $alldata['hiverawweight'];
	}

	$hivehumi = $alldata['hiveHum'];
	$wxhumi = $alldata['weather_humidity'];
	$datetime = $alldata['datetime'];
	$daygdd = $gdddata['daygdd'];
	$seasongdd = $gdddata['seasongdd'];
}


#Get some trends
$trendsth = $conn->prepare("SELECT hiveweight, hiverawweight, hivetempf, hiveHum, weather_tempf, weather_humidity, precip_1hr_in, solarradiation, lux, date AS datetime FROM allhivedata ORDER BY datetime(\"date\") DESC LIMIT 288;");
$trendsth->execute();
$trenddata = $trendsth->fetch(PDO::FETCH_ASSOC);

$pasthivetempf = ceil($trenddata['hivetempf']);
$pasthivehumi = ceil($trenddata['hiveHum']);
$pasthiveweight = ceil($trenddata['hiveweight']);
$pastwxtempf = ceil($trenddata['weather_tempf']);
$pastwxhumi = ceil($trenddata['weather_humidity']);
$pastrawweight = ceil($trenddata['hiverawweight']);

$changeweight = ($pasthiveweight - $hiveweight);  


?>