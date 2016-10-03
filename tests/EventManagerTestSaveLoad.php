<?php
/**
 * Class EventManagerTestSaveLoad
 *
 * PHP Task 4 EnglishDom
 *
 * @author   Sergey Borodinov <root.vs.bsa@gmail.com>
 * @version  1.0
 */

use \Core\Events\EventManager;
require_once __DIR__.'/../init.server.php';

/**
 * Class EventManagerTestSaveLoad
 */
class EventManagerTestSaveLoad extends \PHPUnit_Framework_TestCase {

    /**
     * Testing the instance of EventManager
     * @return void
     */
    public function testSaveLoad() {
        EventManager::getInstance()->add_testEvent('\\Helpers\\EventManagerHelper::replaceFail2Pass', 0);
        EventManager::getInstance()->add_testEvent('\\Helpers\\EventManagerHelper::replaceFail2Pass', 1);
        $result1 = EventManager::getInstance()->getData();
        $sdata = EventManager::getInstance()->saveData();
        EventManager::getInstance()->loadData($sdata);
        $result2 = EventManager::getInstance()->getData();
        $this->assertEquals($result1, $result2);
    }
}
