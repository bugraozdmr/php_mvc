<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

/**
 * Main Controller
 */
class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => 'Grant',
            'age' => 3000
        ];
        return $this->render('home',$params);
    }

    // static method (? no need (?))
    public function contact()
    {
        return $this->render('contact');
    }
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        echo "<pre>";
        var_dump($body);
        echo "</pre>";
        return 'handling submitted data';
    }
}