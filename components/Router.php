<?php

/**
* 
*/
class Router
{
	private $routes; //массив для хранения маршрутов

	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}
	/**
	 * Return request string
	 * return type string
	 */
	private function getUri()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run()
	{
		//получаем строку запроса
		$uri = $this->getUri();

		//находим совпадения в масиве маршрутов $routes
		foreach ($this->routes as $uriPattern => $path) {
			//проверяем совпадения $uriPattern с $uri
			if (preg_match("~$uriPattern~", $uri)) {
				
				//получаем внутренний путь из внешнего по правилу
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);

				//определяем контроллер и action обработчик
				$segments = explode('/', $internalRoute);
				
				//создаем переменную с именем класса контроллера
				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);
				
				//создаем переменную с именем метода action-а
				$actionName = 'action'.ucfirst(array_shift($segments));

				//получаем параметры для передачи в модель
				$params = $segments;
				
				//подключаем файл класса контроллера
				$controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				}

				//создаем обьект клас-контроллер и вызываем его метод
				$controllerObj = new $controllerName;
				$res = $controllerObj->$actionName($params);
				if ($res != null) {
					break;
				}

			}
		}
		
		
	}
}
?>