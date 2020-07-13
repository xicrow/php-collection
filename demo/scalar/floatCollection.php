<?php
require_once('../bootstrap.php');

use Xicrow\PhpCollection\Scalar\FloatCollection;

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
echo '<h3>FloatCollection::sum</h3>';
$sum = FloatCollection::Create(1.2, 3.4, 5.6, 7.8)->sum();
debugCode('$sum = FloatCollection::Create(1.2, 3.4, 5.6, 7.8)->sum();', $sum);
?>

</body>

</html>
