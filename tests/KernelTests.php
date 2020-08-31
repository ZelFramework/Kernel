<?php


namespace ZelFramework\Kernel\Tests;


use PHPUnit\Framework\TestCase;
use ZelFramework\Kernel\Kernel;

class KernelTests extends TestCase
{
	
	static $kernel;
	
	// php vendor/phpunit/phpunit/phpunit tests/KernelTests.php
	public static function setUpBeforeClass(): void
	{
		$_ENV['APP'] = 'dev';
		define('PROJECT_DIR', __DIR__ . '/');
	}
	
	public function testConfig()
	{
		$this->assertSame($_ENV['APP'], 'dev');
		$this->assertSame(PROJECT_DIR, __DIR__ . '/');
		$kernel = new Kernel();
		$this->assertSame($kernel->getProjectDir(), __DIR__ . '/');
	}
	
	public function testIsDebug()
	{
		$kernel = new Kernel();
		$this->assertSame($kernel->isDebug(), true);
		$_ENV['APP'] = 'prod';
		$kernel = new Kernel();
		$this->assertSame($kernel->isDebug(), false);
	}
	
	public function testHandle()
	{
		$kernel = new Kernel();
		$kernel->handle();
		// TODO
	}
	
}