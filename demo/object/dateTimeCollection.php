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
<h1>DateTimeCollection</h1>
<a href="../index.php">Back to index</a>
<p>Demonstration of methods specific for the DateTimeCollection.</p>

<?php
echo '<h3>DateTimeCollection::asIntegerCollection</h3>';
debugCodeEval(
	<<<'PHP'
			use Xicrow\PhpCollection\Object\DateTimeCollection;
			
			$collection = DateTimeCollection::Create(new DateTime('2020-03-01 12:00:00'), new DateTime('2020-02-01 12:00:00'), new DateTime('2020-01-01 12:00:00'));
			$collection = $collection->asIntegerCollection();
			
			print_r($collection);
			PHP
);

echo '<h3>DateTimeCollection::asStringCollection</h3>';
debugCodeEval(
	<<<'PHP'
			use Xicrow\PhpCollection\Object\DateTimeCollection;
			
			$collection = DateTimeCollection::Create(new DateTime('2020-03-01 12:00:00'), new DateTime('2020-02-01 12:00:00'), new DateTime('2020-01-01 12:00:00'));
			$collection = $collection->asStringCollection('Y-m-d');
			
			print_r($collection);
			PHP
);

echo '<h3>DateTimeCollection::filterToAfter</h3>';
debugCodeEval(
	<<<'PHP'
			use Xicrow\PhpCollection\Object\DateTimeCollection;
			
			$collection = DateTimeCollection::Create(new DateTime('2020-03-01 12:00:00'), new DateTime('2020-02-01 12:00:00'), new DateTime('2020-01-01 12:00:00'));
			$collection = $collection->filterToAfter(new DateTime('2020-02-01 12:00:00'));
			
			print_r($collection);
			PHP
);

echo '<h3>DateTimeCollection::filterToBefore</h3>';
debugCodeEval(
	<<<'PHP'
			use Xicrow\PhpCollection\Object\DateTimeCollection;
			
			$collection = DateTimeCollection::Create(new DateTime('2020-03-01 12:00:00'), new DateTime('2020-02-01 12:00:00'), new DateTime('2020-01-01 12:00:00'));
			$collection = $collection->filterToBefore(new DateTime('2020-02-01 12:00:00'));
			
			print_r($collection);
			PHP
);

echo '<h3>DateTimeCollection::firstDate</h3>';
debugCodeEval(
	<<<'PHP'
			use Xicrow\PhpCollection\Object\DateTimeCollection;
			
			$collection = DateTimeCollection::Create(new DateTime('2020-03-01 12:00:00'), new DateTime('2020-02-01 12:00:00'), new DateTime('2020-01-01 12:00:00'));
			$dateTime   = $collection->firstDate()->format('Y-m-d');
			
			print_r($dateTime);
			PHP
);

echo '<h3>DateTimeCollection::lastDate</h3>';
debugCodeEval(
	<<<'PHP'
			use Xicrow\PhpCollection\Object\DateTimeCollection;
			
			$collection = DateTimeCollection::Create(new DateTime('2020-03-01 12:00:00'), new DateTime('2020-02-01 12:00:00'), new DateTime('2020-01-01 12:00:00'));
			$dateTime   = $collection->lastDate()->format('Y-m-d');
			
			print_r($dateTime);
			PHP
);

echo '<h3>DateTimeCollection::sortAscending</h3>';
debugCodeEval(
	<<<'PHP'
			use Xicrow\PhpCollection\Object\DateTimeCollection;
			
			$collection = DateTimeCollection::Create(new DateTime('2020-03-01 12:00:00'), new DateTime('2020-02-01 12:00:00'), new DateTime('2020-01-01 12:00:00'));
			$collection = $collection->sortAscending();
			
			print_r($collection);
			PHP
);

echo '<h3>DateTimeCollection::sortDescending</h3>';
debugCodeEval(
	<<<'PHP'
			use Xicrow\PhpCollection\Object\DateTimeCollection;
			
			$collection = DateTimeCollection::Create(new DateTime('2020-03-01 12:00:00'), new DateTime('2020-02-01 12:00:00'), new DateTime('2020-01-01 12:00:00'));
			$collection = $collection->sortDescending();
			
			print_r($collection);
			PHP
);
?>
</body>
</html>
