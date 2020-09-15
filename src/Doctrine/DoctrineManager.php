<?php


namespace ZelFramework\Kernel\Doctrine;


use Doctrine\ORM\EntityManager;
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
			
			$connection = [
				'url' => $_ENV['DATABASE_URL'],
				'password' => $_ENV['DATABASE_PASSWORD'] ?? null,
			];
			
			self::$em = EntityManager::create($connection, $config);
		}
		
		return self::$em;
	}
	
}