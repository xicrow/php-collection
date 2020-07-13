<?php
require_once('bootstrap.php');

use Xicrow\PhpCollection\Scalar\StringCollection;

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Xicrow/PhpCollection</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
</head>

<body>

<h1>BaseCollection</h1>
<a href="index.php">Back to index</a>
<p>Demonstration of BaseCollection methods, which are basically the same for all collections, so they are represented here by the StringCollection.</p>

<?php
echo '<h3>BaseCollection::__construct</h3>';
$collection = new StringCollection('hello', 'world');
debugCode('$collection = new StringCollection(\'hello\', \'world\');', $collection);

echo '<h3>BaseCollection::Create</h3>';
$collection = StringCollection::Create('hello', 'world');
debugCode('$collection = StringCollection::Create(\'hello\', \'world\');', $collection);

echo '<h3>BaseCollection::CreateFromArray</h3>';
$collection = StringCollection::CreateFromArray(['hello', 'world']);
debugCode('$collection = StringCollection::CreateFromArray([\'hello\', \'world\']);', $collection);

echo '<h3>BaseCollection::asArray</h3>';
$collection = new StringCollection('hello', 'world');
$array      = $collection->asArray();
debugCode('$collection = new StringCollection(\'hello\', \'world\');
$array      = $collection->asArray();', $array);

echo '<h3>BaseCollection::add</h3>';
$collection = new StringCollection('hello', 'world');
$collection->add('hello', 'world');
debugCode('$collection = new StringCollection(\'hello\', \'world\');
$collection->add(\'hello\', \'world\');', $collection);

echo '<h3>BaseCollection::combine</h3>';
$collection = new StringCollection('hello', 'world');
$collection = $collection->combine(StringCollection::Create('foo', 'bar'));
debugCode('$collection = new StringCollection(\'hello\', \'world\');
$collection = $collection->combine(StringCollection::Create(\'foo\', \'bar\'));', $collection);

echo '<h3>BaseCollection::filter</h3>';
$collection = new StringCollection('hello', 'world');
$collection = $collection->filter(static function (string $string) {
	return $string === 'hello';
});
debugCode('$collection = new StringCollection(\'hello\', \'world\');
$collection = $collection->filter(static function (string $string) {
	return $string === \'hello\';
});', $collection);

echo '<h3>BaseCollection::first</h3>';
$collection = new StringCollection('hello', 'world');
$string     = $collection->first();
debugCode('$collection = new StringCollection(\'hello\', \'world\');
$string     = $collection->first();', $string);

echo '<h3>BaseCollection::has</h3>';
$collection = new StringCollection('hello', 'world');
$boolean    = $collection->has('hello');
debugCode('$collection = new StringCollection(\'hello\', \'world\');
$boolean    = $collection->has(\'hello\');', $boolean);

echo '<h3>BaseCollection::last</h3>';
$collection = new StringCollection('hello', 'world');
$string     = $collection->last();
debugCode('$collection = new StringCollection(\'hello\', \'world\');
$string     = $collection->last();', $string);


echo '<h3>BaseCollection::merge</h3>';
$collection = new StringCollection('hello', 'world');
$collection = $collection->merge(StringCollection::Create('hello', 'world'));
debugCode('$collection = new StringCollection(\'hello\', \'world\');
$collection = $collection->merge(StringCollection::Create(\'hello\', \'world\'));', $collection);

$collection = new StringCollection('hello', 'world');
$collection = $collection->merge(StringCollection::Create('foo', 'bar'));
debugCode('$collection = new StringCollection(\'hello\', \'world\');
$collection = $collection->merge(StringCollection::Create(\'foo\', \'bar\'));', $collection);

echo '<h3>BaseCollection::sort</h3>';
$collection = new StringCollection('hello', 'world');
$collection = $collection->sort(static function (string $a, string $b) {
	return strcmp($b, $a);
});
debugCode('$collection = new StringCollection(\'hello\', \'world\');
$collection = $collection->sort(static function (string $a, string $b) {
	return strcmp($b, $a);
});', $collection);

echo '<h3>BaseCollection::take</h3>';
$collection = new StringCollection('hello', 'world');
$collection = $collection->take(1, 0);
debugCode('$collection = new StringCollection(\'hello\', \'world\');
$collection = $collection->take(1, 0);', $collection);

echo '<h3>BaseCollection::unique</h3>';
$collection = new StringCollection('hello', 'world', 'hello', 'world');
$collection = $collection->unique();
debugCode('$collection = new StringCollection(\'hello\', \'world\', \'hello\', \'world\');
$collection = $collection->unique();', $collection);
?>

</body>

</html>
