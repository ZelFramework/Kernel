<?php


namespace ZelFramework\Kernel;


use Symfony\Component\HttpFoundation\Response;

class Debug
{
	
	public static function start()
	{
		return require_once 'DebugFunction.php';
	}
	
	public static function handle($e)
	{
		return new Response('Error: ' . $e->getMessage());
	}
	
}