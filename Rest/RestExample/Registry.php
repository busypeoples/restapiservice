<?php
namespace RestExample;

class Registry {
    
    private static $registry = null;
    
    private $collection;
    
    private function __construct() {
        
    }
    
    private function __clone() {
        
    }
    
    public static function getInstance() {
        if (self::$registry === null) {
            self::$registry = new Registry();
        }
        
        return self::$registry;
    } 
    
    public function set($key, $value) {
        $this->collection[$key] = $value;
    }
    
    public function get($key) {
        if (! $this->has($key)) {
            return false;
        }
        
        return $this->collection[$key];
    }
    
    public function has($key) {
        return isset($key, $this->collection);
    }
    
}
