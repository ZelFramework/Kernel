<?php


namespace ZelFramework\Kernel\Bundle\Controller;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormRegistry;
use Symfony\Component\Form\ResolvedFormTypeFactory;
use ZelFramework\Kernel\Bundle\Dependency\Dependencies;
use ZelFramework\Router\RouteCollection;
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
		$response->setContent(Dependencies::getTwig()->render($view, $parameters));
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
	
	protected function createForm(string $type, $data = null, array $options = []): FormInterface
	{
		$formRegistry = new FormRegistry([], new ResolvedFormTypeFactory());
		$formFactory = new FormFactory($formRegistry);
		return $formFactory->create($type, $data, $options);
	}
	
	protected function createFormBuilder($data = null, array $options = []): FormBuilderInterface
	{
		$formRegistry = new FormRegistry([], new ResolvedFormTypeFactory());
		$formFactory = new FormFactory($formRegistry);
		return $formFactory->createBuilder(FormType::class, $data, $options);
	}
	
}