<?php namespace Acme\Transformers;


abstract class Transformer {


    /**
     * Transform a collection of items
     *
     * @param $items
     * @internal param $lessons
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($items);
} 