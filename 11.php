<?php
function send($path, $post, $header) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, "http://news.masjmzs.com$path");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	$hasil = curl_exec($ch);
	curl_close($ch);
	return $hasil;
}
function lihat($id, $jenis) {
	$header = 'sensor: 1
brand: Xiaomi
version: 1.1.2
ratio: 720*1280
language: in
ticket: sHp2r312otmCpnGns3mCqJhovNiBh4_du9OOo7W4etqwjX-hf4m62YS2cpqzhXFjkX20y4t3mtGuqqOvwLh_yq2jra6KZM3XjZSKo7-Ik2uRo6zWlGWLoQ
meid: e17af2c215bbb3af
os: android
cpu: 1
bh: 1
Content-Type: application/json; charset=UTF-8
Host: news.masjmzs.com
Connection: Keep-Alive
Accept-Encoding: gzip
User-Agent: okhttp/3.8.0';
	if ($jenis == "gmail") {
		$data = '{"gm_id":"' . $id . '","headimg":"https://lh6.googleusercontent.com/-42hJSvw2lfo/AAAAAAAAAAI/AAAAAAAAAAA/AKxrwcY32vnf8-QBkVI82vvEb5_f4e6R2w/s96-c/photo.jpg","invite_code":"","login_source":"gmail","mobile_brand":"Xiaomi","nickname":"Derso Royhul","sex":"1","nonce_str":"OIUnnrRDob9","sign":"3ba4887fe80605830aae5faec3f961c7ff42d0b483710d5a411d44d67137bf2d","time":"1545998738038"}';
	}
	if ($jenis == "fb") {
		$data = 'fb_access_token=EAAILP65cwxYBANyywUzwewhnDVNUqgsm1VtWnIzEZCmZCm9jBkHBZCIv8vZBWYywZCmZBvBCrKNiuX5sZAcZAtHSdORAJnTAsz4P5mKSpyR8wDdG2nBjNy2xKJYqmzOUZC8jwncHKb20lcXWOxkeUP8VXqJCwJkhiZCD6bF89cacohePZCaoBBPeJ2C8M9O9kbJ0ILcn9TLwlilngHVeQk3V09B4x7DTqewI70ZD&gm_id=' . $id . '&headimg=' . $this->ico . '&invite_code=eoy&login_source=gmail&mobile_brand=' . $this->hp . '&nickname=' . $this->name . '&sex=' . rand(1, 2) . '&nonce_str=ZQKmF7JAdxH&sign=2c4feecf3319f55fa4ac0176320d1719b3f4b96c0f781102be3201ba1688239e&time=1544542342344&language=in&ticket=&meid=' . $meid . '&sign=' . $this->hasil("64", "2") . '&os=android&version=1.0.9';
	}
	$x = explode("\n", $header);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, "http://news.masjmzs.com/app/Login/thirdPartyLogin");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $x);
	$hasil = curl_exec($ch);
	curl_close($ch);
	$json = json_decode($hasil);
	$data = get_object_vars($json->data);
	$ticket = $data['ticket'];
	echo $json->code;
	while (TRUE) {
		# code...

// Ambil Token
		$header = 'sensor: 1
brand: Xiaomi
version: 1.1.2
ratio: 720*1280
language: in
ticket: ' . $ticket . '
meid: e17af2c215bbb3af
os: android
cpu: 1
bh: 1
Content-Type: application/json; charset=UTF-8
Host: news.masjmzs.com
Connection: Keep-Alive
Accept-Encoding: gzip
User-Agent: okhttp/3.8.0';
		$q = explode("\n", $header);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, "http://news.masjmzs.com/app/fourth/setting");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{"nonce_str":"VrwdjMt208L","sign":"66ffbfa9aae4fa3d4cf59774e38a870892dde67981a5892f275e8720d6e1d88b","time":"1545998750069"}');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $q);
		$hasil = curl_exec($ch);
		curl_close($ch);
		$token = json_decode($hasil);
		$d = get_object_vars($token->data['0']);
		$token = $d['token'];
//echo "$token";

// melihat berita
		$header = 'sensor: 1
brand: Xiaomi
version: 1.1.2
ratio: 720*1280
language: in
ticket: ' . $ticket . '
meid: e17af2c215bbb3af
os: android
cpu: 1
bh: 1
Content-Type: application/json; charset=UTF-8
Host: news.masjmzs.com
Connection: Keep-Alive
Accept-Encoding: gzip
User-Agent: okhttp/3.8.0';
		$w = explode("\n", $header);
		echo send("/app/fourth/actionData", '{"requestData":"[{\"action\":\"detailPageShow\",\"actionTime\":1545998837056,\"itemId\":\"704260\",\"itemSetId\":\"2056\",\"sceneId\":\"4240\",\"userId\":\"84032\"}]","token":"' . $token . '","nonce_str":"FX8POG1ibE1","sign":"2f3b56e76cf7c96c96ef8460be8f76a81c1d4498c84f7967536af065848e93c9","time":"1545998836070"}', $w);

// Visit berita
		$header = 'sensor: 1
brand: Xiaomi
version: 1.1.2
ratio: 720*1280
language: in
ticket: ' . $ticket . '
meid: e17af2c215bbb3af
os: android
cpu: 1
bh: 1
Content-Type: application/json; charset=UTF-8
Host: news.masjmzs.com
Connection: Keep-Alive
Accept-Encoding: gzip
User-Agent: okhttp/3.8.0';
		$r = explode("\n", $header);
		echo send("/app/Datapre/newsVisit", '{"news_id":"704260","nonce_str":"XuVd4eA9EnW","sign":"86fabea84c6cec3fc983af79f254e208fc63ff14341cf5f3152ab3fb495bae0c","time":"1545998837821"}', $r);
// duration
		$header = 'sensor: 1
brand: Xiaomi
version: 1.1.2
ratio: 720*1280
language: in
ticket: ' . $ticket . '
meid: e17af2c215bbb3af
os: android
cpu: 1
bh: 1
Content-Type: application/json; charset=UTF-8
Host: news.masjmzs.com
Connection: Keep-Alive
Accept-Encoding: gzip
User-Agent: okhttp/3.8.0';
		$z = explode("\n", $header);
		echo send("/app/fourth/actionData", '{"requestData":"[{\"action\":\"duration\",\"actionTime\":1545998848155,\"duration\":\"100.826\",\"itemId\":\"704260\",\"itemSetId\":\"2056\",\"sceneId\":\"4240\",\"userId\":\"84032\"}]","token":"' . $token . '","nonce_str":"94NkAhla8km","sign":"387319f859e86ad3e20c0d1af2a6222ef44c85ee3f9910c0e9b041f9cdae3267","time":"1545998847165"}', $z);
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
			$e = json_decode($response);
			if ($e->code == "10002") {
				echo "Sudah Habis Videonya";
				break;
			}
		}
		sleep(rand(11, 20));
	}
}
?>