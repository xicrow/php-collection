<?php
require_once('../bootstrap.php');
?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Xicrow/PhpCollection</title>
		<link rel="stylesheet" type="text/css" href="../assets/style.css">
	</head>

	<body>
		<h1>StringCollection</h1>
		<a href="../index.php">Back to index</a>
		<p>Demonstration of methods specific for the StringCollection.</p>

		<?php
		echo '<h3>StringCollection::join</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$string = StringCollection::Create('Hello', 'world')->join(' ');
			
			var_dump($string);
			PHP
		);

		echo '<h3>StringCollection::split</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = StringCollection::Create('Hello world')->split(' ');
			
			print_r($collection);
			PHP
		);
		?>
	</body>
</html>
