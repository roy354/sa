<?php
$ticket = "sHp2r312otmCpnGns3mCqJhovNiBh5ncr9B5sL-1h8q9inaviYbNz4PMdai1hYqehaCn23-HkM-u0Iqks6h2kq2jra6KZM3XjZSKo7-Ik2ubfrCUi4RzoQ";
$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "http://news.masjmzs.com/app/mission_new/handler",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "NRDy/RjwMZbZajCYHp5vpR9jmzm9wBg6jaySe+o6KQCZPHTMqvGC8wsWRchlWBO9",
	CURLOPT_HTTPHEADER => array(
		"Accept-Encoding: gzip",
		"Connection: Keep-Alive",
		"Content-Length: 64",
		"Content-Type: text/plain",
		"Host: news.masjmzs.com",
		"User-Agent: okhttp/3.8.0",
		"bh: 1",
		"brand: Xiaomi",
		"cache-control: no-cache",
		"cpu: 1",
		"language: in",
		"meid: e17af2c215bbb3af",
		"os: android",
		"ratio: 720*1280",
		"sensor: 1",
		"ticket: $ticket",
		"version: 1.1.2",
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
sleep("10");