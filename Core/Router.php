<?php

namespace app\core;

class Router
{
    protected array $routes = [];
    public  Request $request;
    public Respone $respone;
    public function __construct($request, $respone)
    {
        $this->request = $request;
        $this->respone = $respone;
    }

    //HTTP GET
    public function get($path, $callback)
    {
        $this->routes["get"][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes["post"][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethods();
        $callback = $this->routes[$method][$path] ?? false;



        if ($callback === false) {
            $this->respone->setStatusCode(404);
            return  $this->render_content("not found");
        }

        if (is_string($callback))
            return $this->render_view($callback);


        return call_user_func($callback);
    }

    public function render_view($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->render_only_view($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
        include_once Application::$ROOT_DIR . "/views/$view.php";
    }

    public function render_content($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
        include_once Application::$ROOT_DIR . "/views/$view.php";
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layout/main.php";
        return ob_get_clean();
    }

    protected function render_only_view($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
