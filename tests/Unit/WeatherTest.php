<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Requests\DTO\PlaceRequest;
use App\Http\Controllers\HomesController;
use App\Repository\WeatherRepository;

class WeatherTest extends TestCase
{
    /**
     * Test case for compare weather controller.
     *
     * @return void
     */
    public function testCompareWeather()
    {
        $request = new PlaceRequest();
        $mockInterface = $this->getMockBuilder('App\Interfaces\WeatherInterface')->getMock();
        $controller = new HomesController($mockInterface);
        $obj = $controller->compareWeather($request);
		$this->assertEquals(true, $obj->getData()->status->success);
		$this->assertEquals(200, $obj->getData()->status->http_code);
		$this->assertEquals('suggestion result', $obj->getData()->status->message);
    }

    /**
     * Test Case for Weather Repository.
     *
     * @return void
     */
    public function testWeatherRepository()
    {
    	$data = 'berlin, london';
    	$repo = new WeatherRepository();
    	$obj = $repo->compareWeatherReport($data);
    	$this->assertInternalType('array', $obj);

    }
}
