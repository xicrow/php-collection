<?php
require_once('bootstrap.php'); ?>
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
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = new StringCollection('hello', 'world');
			
			print_r($collection);
			PHP
		);

		echo '<h3>BaseCollection::Create</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = StringCollection::Create('hello', 'world');
			
			print_r($collection);
			PHP
		);

		echo '<h3>BaseCollection::CreateFromArray</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = StringCollection::CreateFromArray(['hello', 'world']);
			
			print_r($collection);
			PHP
		);

		echo '<h3>BaseCollection::asArray</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = new StringCollection('hello', 'world');
			$array      = $collection->asArray();
			
			print_r($collection);
			print_r($array);
			PHP
		);

		echo '<h3>BaseCollection::add</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = new StringCollection('hello', 'world');
			$collection->add('hello', 'world');
			
			print_r($collection);
			PHP
		);

		echo '<h3>BaseCollection::combine</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = new StringCollection('hello', 'world');
			$collection = $collection->combine(StringCollection::Create('foo', 'bar'));
			
			print_r($collection);
			PHP
		);

		echo '<h3>BaseCollection::filter</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = new StringCollection('hello', 'world');
			$collection = $collection->filter(static function (string $string) {
				return $string === 'hello';
			});
			
			print_r($collection);
			PHP
		);

		echo '<h3>BaseCollection::first</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = new StringCollection('hello', 'world');
			$string     = $collection->first();
			
			print_r($collection);
			var_dump($string);
			PHP
		);

		echo '<h3>BaseCollection::has</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = new StringCollection('hello', 'world');
			$boolean    = $collection->has('hello');
			
			print_r($collection);
			var_dump($boolean);
			PHP
		);

		echo '<h3>BaseCollection::last</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = new StringCollection('hello', 'world');
			$string     = $collection->last();
			
			print_r($collection);
			var_dump($string);
			PHP
		);

		echo '<h3>BaseCollection::merge</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = new StringCollection('hello', 'world');
			$collection = $collection->merge(StringCollection::Create('hello', 'world'));
			
			print_r($collection);
			
			$collection = new StringCollection('hello', 'world');
			$collection = $collection->merge(StringCollection::Create('foo', 'bar'));
			
			print_r($collection);
			PHP
		);

		echo '<h3>BaseCollection::sort</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = new StringCollection('hello', 'world');
			$collection = $collection->sort(static function (string $a, string $b) {
				return strcmp($b, $a);
			});
			
			print_r($collection);
			PHP
		);

		echo '<h3>BaseCollection::take</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = new StringCollection('hello', 'world');
			$collection = $collection->take(1);
			
			print_r($collection);
			PHP
		);

		echo '<h3>BaseCollection::unique</h3>';
		debugCodeEval(
			<<<'PHP'
			use Xicrow\PhpCollection\Scalar\StringCollection;
			
			$collection = new StringCollection('hello', 'world', 'hello', 'world');
			$collection = $collection->unique();
			
			print_r($collection);
			PHP
		);
		?>
	</body>
</html>
