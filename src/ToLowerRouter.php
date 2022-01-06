<?php

namespace Zls\Router;

use Cfg;
use Z;

class ToLowerRouter extends \Zls_Router
{
    public function find()
    {
        $pathInfo = $this->toLower(Cfg::get('pathInfo'));
        Cfg::set('pathInfo', $pathInfo);
        return false;
    }

    public function url($action = '', $getData = [], $opt = [])
    {
        return (new \Zls_Router_PathInfo)->url($this->toLower($action), $getData, $opt);
    }

    private function toLower($path)
    {
        return join('/', Z::arrayMap(explode('/', $path), function ($p) {
            return Z::strSnake2Camel($p, true, '-');
        }));
    }
}
