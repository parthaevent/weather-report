<?php
namespace App\Repository;

use App\Interfaces\WeatherInterface;
use GuzzleHttp\Client;

/**
 * Class WeatherRepository
 * @package App\Repository
 */
class WeatherRepository implements WeatherInterface
{
	/**
	 * @param $request
	 * @return array
	 */
	public function compareWeatherReport($request)
	{
		return $this->getWeather(explode(',', $request));
	}

	/**
	 * @param $data
	 * @return array
	 */
	protected function getWeather($data)
	{
		$collection = collect($data);
		$client = new Client();
		$reoportData = $collection->map(function ($country) use($client) {
			$response = $client->request('GET', env('WEATHER_REPORT_URL', '').'?q='.$country.'&appid='.env('WEATHER_APP_ID', ''));
			$weatherData = json_decode($response->getBody()->getContents())->list;
			if (!empty($weatherData)) {
				return $weatherData[0];
			}
        });
		return $reoportData->toArray();
	}
}