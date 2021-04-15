<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

define('PROJECT_ROOT', realpath(__DIR__ . '/..'));

require_once(PROJECT_ROOT . '/vendor/autoload.php');
require_once(PROJECT_ROOT . '/src/autoload.php');

use Xicrow\PhpCollection\BaseCollection;

function debugCode(string $strCode, $result = null): void
{
	$highlightSearchAndReplace = [
		"\n"             => "",
		"&lt;?php<br />" => "",
	];

	echo '<div class="debug-code">';
	echo '<div class="code-header">Code:</div>';
	echo '<pre class="code">';
	echo str_replace(array_keys($highlightSearchAndReplace), array_values($highlightSearchAndReplace), highlight_string("<?php\n" . $strCode, true));
	echo '</pre>';
	if ($result !== null) {
		echo '<div class="result-header">Result:</div>';
		echo '<pre class="result">';
		if ($result instanceof BaseCollection) {
			if ($result->count() === 0) {
				echo get_class($result) . '[]';
			} else {
				echo get_class($result) . "[\n";
				foreach ($result as $value) {
					if (is_bool($value)) {
						echo "    " . gettype($value) . "(" . ($value === true ? 'true' : 'false') . "),\n";
					} elseif (is_scalar($value)) {
						echo "    " . gettype($value) . "($value),\n";
					} else {
						var_dump($value);
					}
				}
				echo "]";
			}
		} elseif (is_array($result)) {
			if (count($result) === 0) {
				echo 'array[]';
			} else {
				echo "array[\n";
				foreach ($result as $value) {
					if (is_bool($value)) {
						echo "    " . gettype($value) . "(" . ($value === true ? 'true' : 'false') . "),\n";
					} elseif (is_scalar($value)) {
						echo "    " . gettype($value) . "($value),\n";
					} else {
						var_dump($value);
					}
				}
				echo "]";
			}
		} elseif (is_bool($result)) {
			echo gettype($result) . "(" . ($result === true ? 'true' : 'false') . ")";
		} elseif (is_scalar($result)) {
			echo gettype($result) . "($result)";
		} else {
			var_dump($result);
		}
		echo '</pre>';
	}
	echo '</div>';
}
