<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new GuzzleHttp\Client();

 $response = $client->request('GET', 'http://omdbapi.com', [
 	'query' => [
 		'apikey' => '12a10303',
 		's' => 'transformers'
 	]
 ]);



$result = json_decode($response->getBody()->getContents(), true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Movie</title>
</head>
<body>
	<?php foreach($result['Search'] as $movie) : ?>
	<ul>
		<li>Title : <?= $movie['Title']; ?></li>
		<li>Year : <?= $movie['Year']; ?></li>
		<li>
			<img src="<?= $movie['Poster']; ?>" width="80">
		</li>
	</ul>
	<?php endforeach; ?>
</body>
</html>