<?php
/**
 * Class DBAdapter
 *
 * @author   Sergey Borodinov <root.vs.bsa@gmail.com>
 * @version  0.1
 */

namespace Core\DB;

/**
 * Class EventManager
 * @property mysqli $mysqli
 */
class Adapter {

    /**
     * Connection
     * @var mysqli
     */
    private static $mysqli;

    /**
     * Set mysqli instance
     * @return void
     * @throws \Exception if connection is not initialized
     */
    private static function init() {
        if ((static::$mysqli = mysqli_connect()) === false)
            throw new \Exception('Connection to the database is not initialized!');
    }

    /**
     * Connect to DB
     * @param string $dbname
     * @return mysqli
     * @throws \Exception if database is not selected
     */
    static function connect($dbname) {
        if (empty(static::$mysqli)) static::init();
        if (!static::$mysqli->select_db($dbname))
            throw new \Exception('Could not select a db!');
        return static::$mysqli;
    }

    /**
     * Escape string
     * @param string $string
     * @return string
     */
    static function escape($string) {
        return static::$mysqli->escape_string($string);
    }

    /**
     * Run a query
     * @param string $query
     * @return mysqli_result
     */
    static function runQuery($query) {
        return static::$mysqli->query($query);
    }

    /**
     * Run a query and get last insert ID
     * @param string $query
     * @return integer
     */
    static function getInsertID($query) {
        if (!$result = static::$mysqli->query($query))
            throw new \Exception('Could not insert the value!');
        return static::$mysqli->insert_id;
    }

    /**
     * Run a query and get a single value
     * @param string $query
     * @return mixed
     */
    static function getOneValue($query) {
        if (!$result = static::$mysqli->query($query))
            throw new \Exception('Could not get a single value!');
        return $result->fetch_row()[0];
    }

    /**
     * Run a query and get a row object
     * @param string $query
     * @return stdClass
     */
    static function getObjecRow($query) {
        if (!$result = static::$mysqli->query($query))
            throw new \Exception('Could not get the row object!');
        return $result->fetch_object();
    }
}
