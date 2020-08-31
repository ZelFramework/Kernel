<?php


namespace ZelFramework\Kernel\Doctrine;


use Doctrine\ORM\Tools\Setup;

class DoctrineManager
{
	static $em;
	
	public static function get()
	{
		if (!isset(self::$em)) {
			$paths = [PROJECT_DIR . 'src/Entity'];
			
			$_ENV['APP'] === 'dev' ? $isDevMode = true : $isDevMode = false;
			
			$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
			self::$em = \Doctrine\ORM\EntityManager::create(['url' => $_ENV['DATABASE_URL']], $config);
		}
		return self::$em;
	}
	
}