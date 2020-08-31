<?php

namespace ZelFramework\Kernel\Twig;


use Britzel\RouteRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PathTwigExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('path', [new PathTwigExtension(), 'path'])
        ];
    }

    public function path(string $path = '/', array $params = null)
    {
        if (substr($path, 0, 1) !== '/') {
            $route = RouteRepository::getRouteByName($path);
            $path = $route->getUri();
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