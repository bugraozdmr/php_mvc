<?php

namespace app\controllers;

use app\core\Application;

/**
 * Main Controller
 */
class SiteController
{
    public static function home()
    {
        $params = [
            'name' => 'Grant',
            'age' => 3000
        ];
        return Application::$app->router->renderView('home',$params);
    }

    // static method (? no need (?))
    public function contact()
    {
        return Application::$app->router->renderView('contact');
    }
    public function handleContact()
    {
        return 'handling submitted data';
    }
}