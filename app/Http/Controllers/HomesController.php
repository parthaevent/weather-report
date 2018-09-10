<?php
namespace App\Http\Controllers;

use App\Http\Requests\DTO\PlaceRequest;
use App\Constants\Code;
use App\Interfaces\WeatherInterface;

/**
 * Class HomesController
 * @package App\Http\Controllers
 */
class HomesController extends BaseController
{
	/**
	 * @var WeatherInterface
	 */
	protected $weatherInterface;

	/**
	 * HomesController constructor.
	 * @param WeatherInterface $weatherInterface
	 */
	public function __construct (WeatherInterface $weatherInterface)
	{
		$this->weatherInterface = $weatherInterface;
	}

	/**
	 * @param PlaceRequest $placeRequest
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function compareWeather (PlaceRequest $placeRequest)
    {
    	try {
    		$data = $this->weatherInterface->compareWeatherReport($placeRequest->place_name);
        	return $this
	            ->setStatusCode(Code::SUCCESS_CODE)
	            ->setDataBag($data)
	            ->respond(true, 'suggestion result');
    	} catch(Exception $e) {
    		return $this
	            ->setStatusCode(Code::FAILURE_CODE)
	            ->setDataBag([])
	            ->respond(true, 'no suggestion result found');
    	}
    }
}
