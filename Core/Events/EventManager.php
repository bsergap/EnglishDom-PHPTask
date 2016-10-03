<?php
/**
 * Class EventManager
 *
 * PHP Task 4 EnglishDom
 *
 * @author   Sergey Borodinov <root.vs.bsa@gmail.com>
 * @version  1.0
 */

namespace Core\Events;

/**
 * Class EventManager
 * @property EventManager $instance
 * @property array $observers
 */
class EventManager {

    /**
     * Singleton instance
     * @var EventManager
     */
    private static $instance;

    /**
     * Event observers
     * @var array
     */
    private $observers = array();

    /**
     * Get EventManager instance
     * @return EventManager
     */
    public static function getInstance() {
        if (empty(static::$instance))
            static::$instance = new static();
        return static::$instance;
    }

    /**
     * Sort observers
     * @param array $observers
     * @return array sorted $observers
     */
    private function _sortObservers($observers) {
        if (count($observers) > 1) {
            usort($observers, function($a, $b) {
                if ($a['priority'] == $b['priority']) return 0;
                return $a['priority'] > $b['priority'] ? 1: -1;
            });
        }
        return $observers;
    }

    /**
     * Add observer
     * @param string $name
     * @param callable $callback
     * @param int $priority default 1, if < 1 then event set up before existing events
     */
    public function observerAdd($name, callable $callback, $priority = 1) {
        $name = trim($name);
        if (!isset($this->observers[$name])) {
            $this->observers[$name] = array();
        }
        $event = array(
            'name' => $name,
            'callback' => $callback,
            'priority' => (int)$priority,
        );
        if ($priority > 0)
            array_push($this->observers[$name], $event);
        else
            array_unshift($this->observers[$name], $event);
    }

    /**
     * Run observer
     * @param string $name
     * @param mixed $data
     * @return mixed modified $data
     */
    public function observerRun($name, $data) {
        foreach ($this->_sortObservers($this->observers[$name]) as $event) {
            $data = call_user_func($event['callback'], $data); //create_function('$data', )
        }
        return $data;
    }

    /**
     * The magic call of observer
     * @param string $name
     * @param array $args
     * @return null | mixed
     * @throws \Exception if method not exist
     */
    public function __call($name, $args) {
        switch (substr($name, 0, 4)) {
            case 'add_':
                if (isset($args[1]))
                    $this->observerAdd(substr($name, 4), $args[0], $args[1]);
                else
                    $this->observerAdd(substr($name, 4), $args[0]);
                break;
            
            case 'run_':
                return $this->observerRun(substr($name, 4), $args[0]);
                break;

            default:
                throw new \Exception("Called a unknown method!");
                break;
        }
    }

    public function saveData() {
        foreach ($this->observers as $name => $observers) {
            $observers = $this->_sortObservers($observers);
            foreach ($observers as $data) {
                $sdata[$name][] = serialize($data);

            }
        }
        return $sdata;
    }
    public function loadData($sdata) {
        $this->clearData();
        foreach ($sdata as $name => $data) {
            foreach ($data as $val) {
                $this->observers[$name][] = unserialize($val);
            }
        }
    }
    public function clearData() {
        $this->observers = array();
    }
    public function getData() {
        return $this->observers;
    }
}
