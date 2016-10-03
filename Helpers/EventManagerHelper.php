<?php
namespace Helpers;

/**
 * Class EventManagerHelper
 */
class EventManagerHelper {

    /**
     * Testing the EventManager
     * @param string $data
     * @return string
     */
    static function replaceFail2Pass($data) {
        return strtr($data, array('fail' => 'pass'));
    }

    /**
     * Smiles 4 Comments
     * @param string $data
     * @return string
     */
    static function replaceSmiles($data) {
        return strtr($data, array(
                ':)' => '<img src="http://www.kolobok.us/smiles/standart/smile.gif">',
                ':-)' => '<img src="http://www.kolobok.us/smiles/standart/smile.gif">',
                ':D' => '<img src="http://www.kolobok.us/smiles/standart/biggrin.gif">',
                ':-D' => '<img src="http://www.kolobok.us/smiles/standart/biggrin.gif">',
                ':(' => '<img src="http://www.kolobok.us/smiles/standart/sad.gif">',
                ':-(' => '<img src="http://www.kolobok.us/smiles/standart/sad.gif">',
                'lol' => '<img src="http://www.kolobok.us/smiles/standart/rofl.gif">',
            ));
    }
}
