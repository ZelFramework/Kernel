<?php


namespace ZelFramework\Kernel;


use Symfony\Component\Yaml\Yaml;

class Configuration
{
	
	public static function explodeDot(string $path): array
	{
		if (empty($var))
			throw new \Exception('Var cannot be empty');
		return explode('.', $var);
	}
	
	public static function get(string $path)
	{
		$explode = self::explodeDot($path);
		$content = Yaml::parse(file_get_contents(PROJECT_DIR . 'config/' . $explode[0] . '.yaml'));
		
		if (count($explode) > 0) {
			foreach ($explode as $var) {
				if (isset($content[$var]))
					$content = $content[$var];
				else
					throw new \Exception('"' . $path . '" not found');
			}
		}
		
		return $content;
	}
	
}