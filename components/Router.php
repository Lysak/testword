<?php
class Router
{
    private $routes;
    public function __construct()
    {
        // Читаєм і зпам'ятовуєм роути
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath); // змінній routes присвоюємо файл routes.php
    }
    private function getURI()
    {
        // Отримуємо строку запиту *.*/***
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    public function run()
    {
        $uri = $this->getURI();
        foreach ($this->routes as $uriPattern => $path) { // $uriPattern - строка запиту маршрута, $path - шлях обробника (якщо умова превильна в $path буде зберігати потрібне ім'я котроллера і екшен)
            if(preg_match("~$uriPattern~", $uri)) { // Порівнюєм строку запиту і дані які містяться в роутах
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute); // Визначаємо який котроллер і екшен обробляє запит
                $controllerName = array_shift($segments).'Controller'; // array_shift отримує перший елемент з масива і видаляє його
                $controllerName = ucfirst($controllerName);
                $actionName = 'action'.ucfirst(array_shift($segments));
                $parameters = $segments;
                $controllerFile = ROOT . '/controllers/' .$controllerName. '.php'; // Записуєм файл
                if (file_exists($controllerFile)) { // Перевіряєм чи такий є
                    include_once($controllerFile); // Підключаєм
                }
                $controllerObject = new $controllerName; // Створюєм об'єкт класу контроллер, передаєм змінну з ім'ям контроллера
                
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters); // ? Для об'єкта викликаєм метод
                if ($result != null) {
                    break;
                }
            }
        }
    }
}