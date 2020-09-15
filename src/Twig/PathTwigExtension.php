<?php

namespace ZelFramework\Kernel\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use ZelFramework\Kernel\Configuration;
use ZelFramework\Router\RouteCollection;

class PathTwigExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('path', [$this, 'path'])
        ];
    }

    public function path(string $path = '/', array $params = null)
    {
        if (substr($path, 0, 1) !== '/') {
	        $router = Configuration::get('router');
	        $route = RouteCollection::getRouteByName($path);
	        $path = ($router['default_uri'][strlen($router['default_uri']) -1 ] === '/' ? substr($router['default_uri'], 0, -1) : $router['default_uri']) . $route->getPath();
	        if ($params) {
                foreach ($params as $key => $value) {
                    $path = preg_replace('/\{' . $key . '\}/', $value, $path);
                }
            }
            if (preg_match('/\{(.*)\}/', $path, $matches)) {
                throw new \Exception('No parameters found in the redirection ("' . $route->getName() . '", "' . $path . '")');
            }
        }
        return $path;
    }

}