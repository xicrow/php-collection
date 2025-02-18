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
<h1>FloatCollection</h1>
<a href="../index.php">Back to index</a>
<p>Demonstration of methods specific for the FloatCollection.</p>

<?php
echo '<h3>FloatCollection::average</h3>';
debugCodeEval(
	<<<'PHP'
			use Xicrow\PhpCollection\Scalar\FloatCollection;
			
			$average = FloatCollection::Create(1.2, 3.4, 5.6, 7.8)->average();
			
			var_dump($average);
			PHP
);

echo '<h3>FloatCollection::maximum</h3>';
debugCodeEval(
	<<<'PHP'
			use Xicrow\PhpCollection\Scalar\FloatCollection;
			
			$maximum = FloatCollection::Create(1.2, 3.4, 5.6, 7.8)->maximum();
			
			var_dump($maximum);
			PHP
);

echo '<h3>FloatCollection::minimum</h3>';
debugCodeEval(
	<<<'PHP'
			use Xicrow\PhpCollection\Scalar\FloatCollection;
			
			$minimum = FloatCollection::Create(1.2, 3.4, 5.6, 7.8)->minimum();
			
			var_dump($minimum);
			PHP
);

echo '<h3>FloatCollection::sum</h3>';
debugCodeEval(
	<<<'PHP'
			use Xicrow\PhpCollection\Scalar\FloatCollection;
			
			$sum = FloatCollection::Create(1.2, 3.4, 5.6, 7.8)->sum();
			
			var_dump($sum);
			PHP
);
?>
</body>
</html>
