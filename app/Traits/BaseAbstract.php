<?php
namespace App\Traits;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

/**
 * Class BaseAbstract
 * @package App\Traits
 */
trait BaseAbstract
{
    use TransformerTrait;

    /**
     * @param $item
     * @param $callback
     * @param string $key
     * @return Item
     */
    protected function item($item, $callback, $key = 'data')
    {
        return new Item($item, $callback, $key);
    }

    /**
     * @param $collection
     * @param $callback
     * @param string $key
     * @return Collection
     */
    protected function collection($collection, $callback, $key = 'data')
    {
        return new Collection($collection, $callback, $key);
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setDataBag($value = [])
    {
        $this->dataBag = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataBag()
    {
        return $this->dataBag;
    }
}
