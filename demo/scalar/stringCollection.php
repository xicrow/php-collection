<?php
require_once('../bootstrap.php');

use Xicrow\PhpCollection\Scalar\StringCollection;

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
$string = StringCollection::Create('Hello', 'world')->join(' ');
debugCode('$string = StringCollection::Create(\'Hello\', \'world\')->join(\' \');', $string);

echo '<h3>StringCollection::split</h3>';
$collection = StringCollection::Create('Hello world')->split(' ');
debugCode('$collection = StringCollection::Create(\'Hello world\')->split(\' \');', $collection);
?>

</body>

</html>
