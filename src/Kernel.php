<?php


namespace ZelFramework\Kernel;


use ZelFramework\Debug\Debug;
use ZelFramework\Router\Router;
use Symfony\Component\HttpFoundation\Response;

class Kernel
{
	
	private $app;
	private $projectDir;
	/**
	 * @var Router
	 */
	private $router;
	
	function __construct()
	{
		$this->app = $_ENV['APP'];
		$this->projectDir = PROJECT_DIR;
		$this->configureRouter();
	}
	
	/**
	 * @return string
	 * @throws \Exception
	 */
	public function getProjectDir(): string
	{
		if (empty($this->projectDir))
			throw new \Exception('The project dir could not be auto-detect');
		return $this->projectDir;
	}
	
	public function isDebug(): bool
	{
		if ($this->app === 'dev')
			return true;
		return false;
	}
	
	private function configureRouter(array $controller = ['/' => 'App\Controller']): void
	{
		$router = Configuration::get('router');
		$this->router = new Router($controller);
	}
	
	public function handle()
	{
		$this->router->searchAllRoute();
		try {
			$response = $this->router->call($this->router->match($_SERVER['REQUEST_URI']));
			
			if ($response === null)
				throw new \Exception('Response not found');

			return $response;
			
		} catch (\Exception $e) {
			return Debug::handle($e);
		}
	}
	
}