<?php
// folder name must match
namespace app\core;


class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false) {
            $this->response->setStatusCode(404);
            // return $this->renderContent("Not found"); -> old for not found only text
            return $this->renderView("_404");
        }

        if(is_string($callback)) {
            return $this->renderView($callback);
        }

        // Burada callback bir array (controller ve method) olarak bekleniyor
        if (is_array($callback)) {
            // Eğer callback bir arrayse, örneğin [SiteController::class, 'contact'] gibi,
            // sınıfın bir örneğini oluşturuyoruz ve metodu çağırıyoruz.
            $controller = new $callback[0]();
            return call_user_func([$controller, $callback[1]]);
        }

        echo call_user_func($callback);
    }

    public function renderView($view,$params = []) 
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view,$params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent($viewContent) 
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR."/views/layout/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}