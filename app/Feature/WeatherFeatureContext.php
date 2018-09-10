<?php
namespace App\Feature;

use Behat\Behat\Context\Context;
use Exception;
use GuzzleHttp;

class WeatherFeatureContext implements Context
{

    public function getWeatherReport () {
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', 'http://mytest.dev/compare/weather', [
            'form_params' => [
                'place_name' => 'london',
            ]
        ]);
        return json_decode($response->getBody()->getContents());
    }

	/**
     * @Given I can see weather
     */
    public function icanSeeWeather()
    {
        $res = $this->getWeatherReport();
        if (!$res->data) {
            throw new Exception('There are some Error');
        }
    }

    /**
     * @Then I can see its success
     */
    public function icanSeeItsSuccess()
    {
        $res = $this->getWeatherReport();
        if (!$res->status->success) {
            throw new Exception('There are some Error');
        }
    }

    /**
     * @Then I can see http code as 200
     */
    public function icanSeeHttpCode()
    {
        $res = $this->getWeatherReport();
        if ($res->status->http_code !== 200) {
            throw new Exception('There are some Error');
        }
    }

    /**
     * @Then I can see message
     */
    public function icanSeeMessage()
    {
        $res = $this->getWeatherReport();
        if ($res->status->message !== 'suggestion result') {
            throw new Exception('There are some Error, I am unable to get user');
        }
    }

    public function getWeatherReportValidationError () {
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', 'http://mytest.dev/compare/weather', [
            'form_params' => [
                'place_name' => '',
            ]
        ]);
        return json_decode($response->getBody()->getContents());
    }

    /**
     * @Then I cant see its success
     */
    public function icantSeeItsSuccess()
    {
        $res = $this->getWeatherReportValidationError();
        if ($res->status->success) {
            throw new Exception('There are some Error');
        }
    }

    /**
     * @Then I should get http code as 422
     */
    public function icanSeeValidationHttpCode()
    {
        $res = $this->getWeatherReportValidationError();
        if ($res->status->http_code !== 422) {
            throw new Exception('There are some Error');
        }
    }

    /**
     * @Then I should get validation message
     */
    public function icanSeeValidationMessage()
    {
        $res = $this->getWeatherReportValidationError();
        if ($res->status->message->place_name !== 'Place Name is required') {
            throw new Exception('There are some Error');
        }
    }

}
