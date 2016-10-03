<?php
/**
 * Class EventManagerTestHandle
 *
 * PHP Task 4 EnglishDom
 *
 * @author   Sergey Borodinov <root.vs.bsa@gmail.com>
 * @version  1.0
 */

use \Core\Events\EventManager;
require_once __DIR__.'/../init.server.php';

/**
 * Class EventManagerTestHandle
 */
class EventManagerTestHandle extends \PHPUnit_Framework_TestCase {

    /**
     * Data provider 4 testHandle()
     * @return array $source, $expected, $callback
     */
    public function providerHandle() {
        return array(
            array('Test is failed.', 'Test is passed.', '\\Helpers\\EventManagerHelper::replaceFail2Pass'),
            // array('Test is failed.', 'Test is passed.', function($data) {return strtr($data, array('fail' => 'pass'));}),
            );
    }

    /**
     * Testing the instance of EventManager
     * @dataProvider providerHandle
     * @return void
     */
    public function testHandle($source, $expected, $callback) {
        EventManager::getInstance()->add_testEvent($callback);
        $result = EventManager::getInstance()->run_testEvent($source);
        $this->assertEquals($result, $expected);
    }
}
