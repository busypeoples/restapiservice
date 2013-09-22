<?php
namespace RestExample;

class Registry {
    
    private static $registry = null;
    
    private $collection;
    
    /**
     * prevent any new Operations
     */
    private function __construct() {
        
    }
    
    /**
     * prevent any cloning
     */
    private function __clone() {
        
    }
    
    /**
     * 
     * @return Registry
     * 
     */
    public static function getInstance() {
        if (self::$registry === null) {
            self::$registry = new Registry();
        }
        
        return self::$registry;
    } 
    
    /**
     * 
     * @param mixed $key
     * 
     * @param mixed $value
     * 
     */
    public function set($key, $value) {
        $this->collection[$key] = $value;
    }
    
    /**
     * 
     * @param mixed $key
     * 
     * @return boolean|mixed
     * 
     */
    public function get($key) {
        if (! $this->has($key)) {
            return false;
        }
        
        return $this->collection[$key];
    }
    
    /**
     * 
     * @param mixed $key
     * 
     * @return boolean
     * 
     */
    public function has($key) {
        return array_key_exists($key, $this->collection);
    }
    
}
