<?php
namespace app\core;

class Request
{
    /* old code
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }
    */

    /**
     * gets the path
     * @return string
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }

        $basePath = "/php_mvc";
        if (strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath));
        }

        return $path === '' ? '/' : $path;
    }


    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}