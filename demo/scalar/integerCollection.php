<?php
require_once('../bootstrap.php');

use Xicrow\PhpCollection\Scalar\IntegerCollection;

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Xicrow/PhpCollection</title>
	<link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>

<body>

<h1>IntegerCollection</h1>
<a href="../index.php">Back to index</a>
<p>Demonstration of methods specific for the IntegerCollection.</p>

<?php
echo '<h3>IntegerCollection::average</h3>';
$average = IntegerCollection::Create(1, 2, 3, 4, 5, 6, 7, 8)->average();
debugCode('$average = IntegerCollection::Create(1, 2, 3, 4, 5, 6, 7, 8)->average();', $average);

echo '<h3>IntegerCollection::maximum</h3>';
$maximum = IntegerCollection::Create(1, 2, 3, 4, 5, 6, 7, 8)->maximum();
debugCode('$maximum = IntegerCollection::Create(1, 2, 3, 4, 5, 6, 7, 8)->maximum();', $maximum);

echo '<h3>IntegerCollection::minimum</h3>';
$minimum = IntegerCollection::Create(1, 2, 3, 4, 5, 6, 7, 8)->minimum();
debugCode('$minimum = IntegerCollection::Create(1, 2, 3, 4, 5, 6, 7, 8)->minimum();', $minimum);

echo '<h3>IntegerCollection::sum</h3>';
$sum = IntegerCollection::Create(1, 2, 3, 4, 5, 6, 7, 8)->sum();
debugCode('$sum = IntegerCollection::Create(1, 2, 3, 4, 5, 6, 7, 8)->sum();', $sum);
?>

</body>

</html>
