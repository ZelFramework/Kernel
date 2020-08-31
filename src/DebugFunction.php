<?php

if ($_ENV['APP'] === 'dev') {
	
	function d($v)
	{
		echo '<pre>';
		var_dump($v);
		echo '</pre>';
	}
	
	function dd($v)
	{
		d($v);
		die();
	}
	
} else {
	
	function d($v)
	{
	}
	
	function dd($v)
	{
	}
	
}