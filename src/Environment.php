<?php


namespace ZelFramework\Kernel;


class Environment
{
	
	function __construct()
	{
		if (!file_exists(PROJECT_DIR))
			throw new \Exception('The ".env" file cannot be found');
		$this->parse(PROJECT_DIR . '.env');
		if ($_ENV['APP'] === 'dev' && file_exists(PROJECT_DIR . '.env.dev'))
			$this->parse(PROJECT_DIR . '.env.dev');
		if ($_ENV['APP'] === 'prod' && file_exists(PROJECT_DIR . '.env.prod'))
			$this->parse(PROJECT_DIR . '.env.prod');
	}
	
	public function add(string $data)
	{
		$explode = explode('=', $data);
		$_ENV[$explode[0]] = $explode[1];
	}
	
	public function parse(string $path)
	{
		$content = file_get_contents($path);
		$content = str_replace(["\r\n", "\r"], "\n", $content);
		$fileExplode = explode("\n", $content);
		
		foreach ($fileExplode as $line) {
			if (!empty($line) && $line[0] !== '#')
				$this->add($line);
		}
	}
}