<?php


namespace ZelFramework\Kernel;


use Symfony\Component\Yaml\Yaml;

class Configuration
{
	
	public static function explodeDot(string $var): array
	{
		if (empty($var))
			throw new \Exception('Var cannot be empty');
		return explode('.', $var);
	}
	
	public static function get(string $path, $return = \Exception::class)
	{
		$explode = self::explodeDot($path);
		$content = Yaml::parseFile(PROJECT_DIR . 'config/' . $explode[0] . '.yaml');
		
		if (count($explode) > 0) {
			foreach ($explode as $key => $var) {
				if ($key !== 0) {
					if (isset($content[$var])) {
						$content = $content[$var];
						
					} else {
						if ($return === \Exception::class)
							throw new \Exception('"' . $path . '" not found');
						else
							return $return;
					}
				}
			}
		}
		
		return $content;
	}
	
}