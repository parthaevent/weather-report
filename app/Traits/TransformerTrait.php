<?php
namespace App\Traits;

use Illuminate\Support\Collection;
use League\Fractal\Manager;
use League\Fractal\Serializer\ArraySerializer;

/**
 * Class TransformerTrait
 * @package App\Traits
 */
trait TransformerTrait
{
    /**
     * @param $data
     * @param $callback
     * @param string $key
     * @return array
     */
    protected function fetch($data, $callback, $key = 'data')
    {
        if (empty($data)) {
            return [];
        }

        if (!$data instanceof Collection) {
            $data = $this->item($data, $callback);
        } else {
            $data = $this->collection($data, $callback, $key);
        }

        return $this->internalTransform($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function internalTransform($data)
    {
        $manager = new Manager();
        $manager->setSerializer(new ArraySerializer());
        $data = $manager->createData($data)->toArray();

        return array_key_exists('data', $data) ? $data['data'] : $data;
    }
}
