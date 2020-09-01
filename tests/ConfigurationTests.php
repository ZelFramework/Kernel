<?php


namespace ZelFramework\Kernel\Tests;


use PHPUnit\Framework\TestCase;
use ZelFramework\Kernel\Configuration;

class ConfigurationTests extends TestCase
{
	
	// php vendor/phpunit/phpunit/phpunit tests/ConfigurationTests.php
	public function testEmptyExplode(): void
	{
		$this->expectException(\Exception::class);
		Configuration::explodeDot('');
	}
	
	public function testExplode(): void
	{
		$result = Configuration::explodeDot('file');
		$this->assertEquals($result, ['file']);
	}
	
	public function testGet()
	{
		$result = Configuration::get('router');
		$this->assertIsArray($result);
	}
	
}