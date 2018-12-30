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
class bot {
	var $ticket;
	var $meid;
	var $sign;
	var $jenis;
	function kode($panjang, $jenis) {
		switch ($jenis) {
		case '1':
			$str = array_merge(range("0", "9"));
			break;
		case '2':
			$str = array_merge(range("0", "9"), range("a", "z"));
			break;
		case '3':
			$str = array_merge(range("0", "9"), range("a", "z"), range("A", "Z"));
			break;
		default:
			$str = array_merge(range("0", "9"), range("a", "z"));
			break;
		}
		$kode = "";
		for ($i = 0; $i < $panjang; $i++) {
			$kode .= $str[array_rand($str)];
		}
		return $kode;
	}
	function __construct() {
		$this->ticket = null; // Sangat penting jadi null saja
		$this->meid = $this->kode(18, 3);
		$this->sign = $this->kode(118, 3);
		$data = file_get_contents("hp.txt");
		$data = explode(",", $data);
		$this->hp = $data[array_rand($data)];
		$this->kode_ref = file_get_contents("kode_ref.txt"); // Kode referal
		$data1 = file_get_contents("nama.txt");
		$data1 = explode(",", $data1);
		$this->nama = $data1[array_rand($data1)] . $data1[array_rand($data1)];
		$data1 = file_get_contents("ico.txt");
		$data1 = explode("\r\n", $data1);
		$this->ico = $data1[array_rand($data1)];
	}

	function lihat($id, $jenis) {
		$header = 'sensor: 1
brand: ' . $this->hp . '
version: 1.1.2
ratio: 720*1280
language: in
ticket:
meid: ' . $this->meid . '
os: android
cpu: 1
bh: 1
Content-Type: application/json; charset=UTF-8
Host: news.masjmzs.com
Connection: Keep-Alive
Accept-Encoding: gzip
User-Agent: okhttp/3.8.0';
		if ($jenis == "gmail") {
			$data = '{"gm_id":"' . $id . '","headimg":"' . $this->ico . '","invite_code":"","login_source":"gmail","mobile_brand":"' . $this->hp . '","nickname":"' . $this->nama . '","sex":"' . rand(1, 2) . '","nonce_str":"' . $this->kode("11", "3") . '","sign":"' . $this->kode("64", "2") . '","time":"1545998738038"}';
		}
		if ($jenis == "fb") {
			$data = 'fb_access_token=EAAILP65cwxYBANyywUzwewhnDVNUqgsm1VtWnIzEZCmZCm9jBkHBZCIv8vZBWYywZCmZBvBCrKNiuX5sZAcZAtHSdORAJnTAsz4P5mKSpyR8wDdG2nBjNy2xKJYqmzOUZC8jwncHKb20lcXWOxkeUP8VXqJCwJkhiZCD6bF89cacohePZCaoBBPeJ2C8M9O9kbJ0ILcn9TLwlilngHVeQk3V09B4x7DTqewI70ZD&fb_id=' . $id . '&headimg=' . $this->ico . '&invite_code=eoy&login_source=fb&mobile_brand=' . $this->hp . '&nickname=' . $this->nama . '&sex=' . rand(1, 2) . '&nonce_str=ZQKmF7JAdxH&sign=2c4feecf3319f55fa4ac0176320d1719b3f4b96c0f781102be3201ba1688239e&time=1544542342344&language=in&ticket=&meid=' . $this->meid . '&sign=' . $this->kode("64", "2") . '&os=android&version=1.1.2';
		}
		$x = explode("\r\n", $header);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, "http://news.masjmzs.com/app/Login/thirdPartyLogin");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		if ($jenis == "gmail") {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $x);
		}
		$hasil = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($hasil);
		$data = get_object_vars($json->data);
		$ticket = $data['ticket'];
		$data_user = get_object_vars($data['user_info']);
		$nama = $data_user['nickname'];
		$level = $data_user['level'];
		$gold = $data_user['gold_flag'];
		if ($json->code == "200") {
			echo "\033[92mAnda Berhasil Login\nNama : $nama\nLevel : $level\nJumlah Point: $gold\n";
		}
		while (TRUE) {
			# code...

// Ambil Token
			$header = 'sensor: 1
brand: ' . $this->hp . '
version: 1.1.2
ratio: 720*1280
language: in
ticket: ' . $ticket . '
meid: ' . $this->meid . '
os: android
cpu: 1
bh: 1
Content-Type: application/json; charset=UTF-8
Host: news.masjmzs.com
Connection: Keep-Alive
Accept-Encoding: gzip
User-Agent: okhttp/3.8.0';
			$q = explode("\r\n", $header);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, "http://news.masjmzs.com/app/fourth/setting");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, '{"nonce_str":"' . $this->kode("11", "3") . '","sign":"' . $this->kode("64", "2") . '","time":"1545998750069"}');
			curl_setopt($ch, CURLOPT_HTTPHEADER, $q);
			$hasil = curl_exec($ch);
			curl_close($ch);
			$token = json_decode($hasil);
			$d = get_object_vars($token->data['0']);
			$token = $d['token'];
			$token1 = json_decode($hasil);
			if ($token1->code == "200") {
				echo "\033[91mBerhasil Ambil Data\n";
			}
//echo "$token";

// melihat berita
			$header = 'sensor: 1
brand: ' . $this->hp . '
version: 1.1.2
ratio: 720*1280
language: in
ticket: ' . $ticket . '
meid: ' . $this->meid . '
os: android
cpu: 1
bh: 1
Content-Type: application/json; charset=UTF-8
Host: news.masjmzs.com
Connection: Keep-Alive
Accept-Encoding: gzip
User-Agent: okhttp/3.8.0';
			$w = explode("\r\n", $header);
			send("/app/fourth/actionData", '{"requestData":"[{\"action\":\"detailPageShow\",\"actionTime\":1545998837056,\"itemId\":\"704260\",\"itemSetId\":\"2056\",\"sceneId\":\"4240\",\"userId\":\"84032\"}]","token":"' . $token . '","nonce_str":"' . $this->kode("11", "3") . '","sign":"' . $this->kode("64", "2") . '","time":"1545998836070"}', $w);

// Visit berita
			$header = 'sensor: 1
brand: ' . $this->hp . '
version: 1.1.2
ratio: 720*1280
language: in
ticket: ' . $ticket . '
meid: ' . $this->meid . '
os: android
cpu: 1
bh: 1
Content-Type: application/json; charset=UTF-8
Host: news.masjmzs.com
Connection: Keep-Alive
Accept-Encoding: gzip
User-Agent: okhttp/3.8.0';
			$r = explode("\r\n", $header);
			send("/app/Datapre/newsVisit", '{"news_id":"704260","nonce_str":"' . $this->kode("11", "3") . '","sign":"' . $this->kode("64", "2") . '","time":"1545998837821"}', $r);
// duration
			$header = 'sensor: 1
brand: ' . $this->hp . '
version: 1.1.2
ratio: 720*1280
language: in
ticket: ' . $ticket . '
meid: ' . $this->meid . '
os: android
cpu: 1
bh: 1
Content-Type: application/json; charset=UTF-8
Host: news.masjmzs.com
Connection: Keep-Alive
Accept-Encoding: gzip
User-Agent: okhttp/3.8.0';
			$z = explode("\r\n", $header);
			send("/app/fourth/actionData", '{"requestData":"[{\"action\":\"duration\",\"actionTime\":1545998848155,\"duration\":\"100.826\",\"itemId\":\"704260\",\"itemSetId\":\"2056\",\"sceneId\":\"4240\",\"userId\":\"84032\"}]","token":"' . $token . '","nonce_str":"' . $this->kode("64", "2") . '","sign":"' . $this->kode("64", "2") . '","time":"1545998847165"}', $z);
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
					"brand: $this->hp",
					"cache-control: no-cache",
					"cpu: 1",
					"language: in",
					"meid: $this->meid",
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

				//echo $response;
				$e = json_decode($response);
				if ($e->code == "200") {
					$json = json_decode($response);
					$get = get_object_vars($json->data);
					$gold = $get['gold_flag'];
					$ke = $get['count'];
					echo "Berhasil | Point:$gold | Tinggal:$ke\n";
				}
				if ($e->code == "10002") {
					echo "Sudah Habis Videonya\n";
					break;
				}
			}
			sleep(rand(11, 20));
		}
	}
	function lihat1() {

		$meid = $this->meid;
		//$sign = $this->sign;
		$ticket = $this->ticket;
		$hp = $this->hp;

		//lihat video//
		// Proses nonton Video
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
				"brand: $hp",
				"cache-control: no-cache",
				"cpu: 1",
				"language: in",
				"meid: $meid",
				"os: android",
				"ratio: 720*1280",
				"sensor: 1",
				"ticket: $ticket",
				"version: 1.1.1",
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			date_default_timezone_set('Asia/Jakarta');
			$file = date('d-m-Y'); // Hasil: 20-01-2017 05:32:15
			$jam = date("H:i:s");
			$decode_hasil = json_decode($response);
			$kode = $decode_hasil->code;
			if ($kode == "200") {
				$pecah = get_object_vars($decode_hasil->data);
				$ke = $pecah['count'];
				$coin = $pecah['gold_flag'];
				fwrite(fopen("log_$file.txt", "a"), " : Video Kurang : $ke | Koin : $coins | $jam");
			} else {
				echo "Gagal Ambil Lihat Video\r\n";
			}
		}

		// Akhir Proses
	}
	function tambah_ref() {
		$meid = $this->meid;
		$sign = $this->sign;
		$ticket = $this->ticket;
		$hp = $this->hp;

		// proses tambah reff
		if ($kode == 200) {
			# code...
		} else {

		}
	}
}

?>