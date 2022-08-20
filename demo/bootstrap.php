<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

define('PROJECT_ROOT', realpath(__DIR__ . '/..'));

require_once(PROJECT_ROOT . '/vendor/autoload.php');
require_once(PROJECT_ROOT . '/src/autoload.php');

use Xicrow\PhpCollection\BaseCollection;

function debugCodeAndResult(string $strCode, $mResult = null): void
{
	$strPrettyCode = $strCode;
	$strPrettyCode = trim($strPrettyCode);
	$strPrettyCode = highlight_string("<?php\n" . $strPrettyCode, true);
	$strPrettyCode = str_replace('<code><span style="color: #000000">', '', $strPrettyCode);
	$strPrettyCode = str_replace("</span>\n</code>", '', $strPrettyCode);
	$strPrettyCode = str_replace("&lt;?php<br />", '', $strPrettyCode);
	$strPrettyCode = trim($strPrettyCode);

	echo '<div class="debug-code">';
	echo '<div class="code-header">Code:</div>';

	echo '<pre class="code">';
	echo $strPrettyCode;
	echo '</pre>';

	if ($mResult !== null) {
		echo '<div class="result-header">Result:</div>';
		echo '<pre class="result">';
		if ($mResult instanceof BaseCollection) {
			if ($mResult->count() === 0) {
				echo get_class($mResult) . '[]';
			} else {
				echo get_class($mResult) . "[\n";
				foreach ($mResult as $value) {
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
		} elseif (is_array($mResult)) {
			if (count($mResult) === 0) {
				echo 'array[]';
			} else {
				echo "array[\n";
				foreach ($mResult as $value) {
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
		} elseif (is_bool($mResult)) {
			echo gettype($mResult) . "(" . ($mResult === true ? 'true' : 'false') . ")";
		} elseif (is_string($mResult)) {
			echo $mResult;
		} elseif (is_scalar($mResult)) {
			echo gettype($mResult) . "($mResult)";
		} else {
			var_dump($mResult);
		}
		echo '</pre>';
	}

	echo '</div>';
}

function debugCodeEval(string $strCode): void
{
	ob_start();
	$mResult   = eval($strCode);
	$strOutput = ob_get_clean();

	debugCodeAndResult($strCode, $mResult ?? $strOutput);
}
