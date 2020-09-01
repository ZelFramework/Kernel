<?php


namespace ZelFramework\Kernel\Bundle\Controller;


use Doctrine\ORM\EntityManager;
use ZelFramework\Router\RouteCollection;
use ZelFramework\Kernel\Bundle\Dependency\Dependencies;
use ZelFramework\Kernel\Doctrine\DoctrineManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
	
	static $doctrine;
	
	protected function redirect(string $url, int $status = 302): RedirectResponse
	{
		return new RedirectResponse($url, $status);
	}
	
	protected function redirectToRoute(string $route, array $parameters = [], int $status = 302)
	{
		$route = RouteCollection::getRouteByName($route);
		$to = $route->getPath();
		
		if ($parameters)
			foreach ($parameters as $key => $value)
				$to = preg_replace('/\{' . $key . '\}/', $value, $to);
		
		if (preg_match('/\{(.*)\}/', $to, $matches))
			throw new \Exception('Aucun paramètre trouver dans la redirection (' . $route->getName() . ')');
		
		return $this->redirect($to, $status);
	}
	
	protected function render(string $view, array $parameters = []): Response
	{
		$response = new Response();
		$response->setContent(Dependencies::getTwig()->render($view . 'html.twig', $parameters));
		return $response;
	}
	
	protected function getUser()
	{
		return $_SESSION['user'] ?? null;
	}
	
	protected function getDoctrine(): EntityManager
	{
		if (!isset(self::$doctrine))
			self::$doctrine = DoctrineManager::get();
		return self::$doctrine;
	}
	
}