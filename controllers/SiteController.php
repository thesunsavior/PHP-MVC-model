<?php

namespace app\controllers;

namespace app\core;

use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{
    public static function Home()
    {
        $param = [
            'name' => "Trung"
        ];
        return Application::$app->router->render_view('home', $param);
    }

    public static function contact()
    {
        $param = [
            'name' => "Trung"
        ];
        return Application::$app->router->render_view('contact', $param);
    }

    public static function handleContact()
    {
        return "handling data";
    }
}
