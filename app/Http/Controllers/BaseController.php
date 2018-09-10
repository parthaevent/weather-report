<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Traits\BaseAbstract;

/**
 * Class BaseController
 * @package App\Http\Controllers
 */
class BaseController extends Controller
{
    use BaseAbstract;
    /**
     * @var int
     */
    protected $statusCode = 200;
    /**
     * @var array
     */
    protected $dataBag = [];
    /**
     * @var array
     */
    protected $metaData = [];


    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }


    /**
     * @param int $statusCode
     *
     * @return $this
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setMetaData(array $data)
    {
        $this->metaData = $data;

        return $this;
    }

    /**
     * @param array  $successArr
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($successArr = [], $message = null)
    {
        $arr = [];
        if (!is_array($successArr)) {
            $arr['success'] = $successArr;
            $arr['message'] = $message;
        } else {
            $arr = $successArr;
        }

        $response = $this->responseFormat($arr, $this->dataBag);

        return response()
            ->json($response, $this->getStatusCode());
    }

    /**
     * @param array $successArr
     * @param array $dataArr
     *
     * @return array
     */
    protected function responseFormat($successArr, $dataArr = [])
    {
        $response = [
            'status'  => [
                'success'   => $successArr['success'],
                'http_code' => $this->getStatusCode(),
                'message'   => $successArr['message'],
            ],
            'data'    => $dataArr,
            '__links' => [],
        ];

        if (\count($this->metaData) > 0) {
            $response['meta'] = $this->metaData;
        }

        return $response;
    }

    /**
     * @param $input
     * @return null|string
     */
    protected function santizeInput($input)
    {
        if (gettype($input) === 'array') {
            return count($input) === 0 ? null : $input;
        } else {
            $input = trim(e($input));
            return strlen($input) === 0 ? null : $input;
        }
    }
}
