<?php
namespace App\Interfaces;

/**
 * Interface WeatherInterface
 * @package App\Interfaces
 */
interface WeatherInterface
{
	/**
	 * @param $request
	 * @return mixed
	 */
	public function compareWeatherReport($request);
}
