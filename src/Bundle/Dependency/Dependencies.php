<?php


namespace ZelFramework\Kernel\Bundle\Dependency;

use ZelFramework\Kernel\Twig\PathTwigExtension;
use Twig\Environment;
use Twig\Extension\CoreExtension;
use Twig\Loader\FilesystemLoader;

class Dependencies
{
	
	static function getTwig(): Environment
	{
		$loader = new FilesystemLoader(PROJECT_DIR . 'templates');
		$twig = new Environment($loader);
		if (class_exists('App\\Entity\\User'))
			$twig->addGlobal('app', ['user' => $_SESSION['user'] ?? new App\Entity\User()]);
		$twig->addExtension(new PathTwigExtension());
		$twig->getExtension(CoreExtension::class)->setDateFormat('d/m/y');
		return $twig;
	}
	
}