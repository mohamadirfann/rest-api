<?php 
	
	// $mahasiswa = [
	// 	[
	// 		"nama" => "Mohamad Irfan Nurfansyah",
	// 		"nrp" => "143040108",
	// 		"email" => "mohamadirfannurfansyah@gmail.com"
	// 	],
	// 	[
	// 		"nama" => "Mohamad Irfan Nurfansyah",
	// 		"nrp" => "143040108",
	// 		"email" => "mohamadirfannurfansyah@gmail.com"
	// 	]
	// ];


	$dbh = new PDO('mysql:host=localhost;dbname=phpdasar', 'root', '');
	$db = $dbh->prepare('SELECT * FROM mahasiswa');
	$db->execute();
	$mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC);

	$data = json_encode($mahasiswa);
	echo $data;

 ?>