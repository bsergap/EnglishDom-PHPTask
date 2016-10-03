<?php
define('STATICVER', '0.1');

use \Core\DB\Adapter;
use \Core\Events\EventManager;
require_once __DIR__.'/../init.server.php';

include __DIR__.'/../views/header.php';

$table_name = 'observers';
EventManager::getInstance()->add_testEvent('\\Helpers\\EventManagerHelper::replaceFail2Pass');
EventManager::getInstance()->add_onSubmit('\\Helpers\\EventManagerHelper::replaceSmiles', 0);
Adapter::runQuery("DELETE QUICK FROM `$table_name`");
foreach (EventManager::getInstance()->saveData() as $key1 => $val1) {
	$key1 = Adapter::escape($key1);
	foreach ($val1 as $key2 => $val2) {
		$val2 = Adapter::escape($val2);
		$sql_rows[] = "($key2, '$key1', '$val2')";
	}
}
$sql = "INSERT INTO `$table_name`(`id`, `name`, `data`) VALUES\n".implode(",\n", $sql_rows);
// echo '<pre>'; var_dump($sql); echo '</pre>'; exit;
echo 'Added '.count($sql_rows).' observers.';
Adapter::runQuery($sql);

include __DIR__.'/../views/footer.php';
