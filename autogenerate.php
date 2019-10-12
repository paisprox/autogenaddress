<?php

// Auto Generate US address on php
// Who's Me?
function getStr($source, $start, $end) {
	$a = explode($start, $source);
	$b = explode($end, $a[1]);
	return $b[0];
}

function curl($url, $data = 0, $header = 0, $cookie = 0) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	if($header) {
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	}
	if($data) {
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	}
	if($cookie) {
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
	}
	$x = curl_exec($ch);
	curl_close($ch);
	return $x;
}

    // Start CURL
    $page = curl("https://www.fakeaddressgenerator.com/World/us_address_generator");
    $output = array();
    $name = getStr($page, "Full Name</span></td><td><strong>", "</strong>");
    $name = str_replace(array("&amp;", "&nbsp;"), " ", $name);
    $name = explode(" ", $name);
    $output["fname"] = $name[0];
    $output["lname"] = $name[1]." ".$name[2];
    $output["fullname"] = $name[0]." ".$name[1]." ".$name[2];
    $output["street"] = getStr($page, "Street</span></div><div class=\"col-sm-8 col-xs-6 right\"><strong><input type=\"text\" class='no-style' value='","'");
    $output["city"] = getStr($page, "City</span></div><div class=\"col-sm-8 col-xs-6 right\"><strong><input type=\"text\" class='no-style' value='", "'");
    $output["state"] = getStr($page, "State</span></div><div class=\"col-sm-8 col-xs-6 right\"><strong><input type=\"text\" class='no-style' value='", "'");
    $output["zipcode"] = getStr($page, "Zip Code</span></div><div class=\"col-sm-8 col-xs-6 right\"><strong><input type=\"text\" class='no-style' value='", "'");
    $output["phone"] = getStr($page, "Phone Number</span></div><div class=\"col-sm-8 col-xs-6 right\"><strong><input type=\"text\" class='no-style' value='", "'");

          // if u need grab only name just use " echo $output["array"]; " array means = fname,lname,fullname,street. etc
          echo "".implode(" - ",$output);