<?php

namespace zero;



class router{
    protected $_options = [
        'base' => '/',
    ];
    public function __construct($options = []){
        $this->_options = \array_merge($this->_options, $options);
        $this->_options['url'] = $url = request::getUri();
        // close base
        $base = $this->_options['base'];
        if (\substr($base, -1, 1) != '/'){
            $this->_options['base'] = $base = $base.'/';
        }
        $l = \strlen($base);
        if (\substr($url, 0, $l) == $this->_options['base']){
            $this->_options['rel'] = $rel = \substr($url, $l);
        }
    }
    public static function create($routes = [], $options = []){
        $r = new self($options);
        return $r->route($routes);
    }
    private function _selectPath($paths){
        $match = null;
        $matchLength = 0;
        $rel = $this->_options['rel'];
        // close rel
        if (\substr($rel, -1, 1) != '/'){
            $rel = $rel.'/';
        }
        foreach ($paths as $path){
            $test = $path;
            // close path
            if (\substr($test, -1, 1) != '/'){
                $test = $test.'/';
            }
            if (\strlen($test) > $matchLength){
                if (\strlen($test) <= \strlen($rel)){
                    // test for separator
                    if ((\strlen($test) == \strlen($rel)) || (\substr($rel, \strlen($rel), 1) == '/')){
                        if (\substr($rel, 0, \strlen($test)) == $test){
                            $match = $path;
                            $matchLength = \strlen($match);
                        }
                    }
                }
            }
        }
        return $match;
    }
    public function route($routes = []){
        $path = $this->_selectPath(\array_keys($routes));
        if (null !== $path){
            $callable = $routes[$path];
            if (\is_callable($callable)){
                $callable = \Closure::bind($callable, $this, $this);
                $arguments = [];
                \call_user_func_array($callable, $arguments);
            }
        }
    }
}
