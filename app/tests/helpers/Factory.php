<?php  namespace tests\helpers;

/**
 * Class Factory
 * @package tests\helpers
 */
trait Factory {

    /**
     * @var int
     */
    protected $times = 1;



    /**
     * @param $count
     * @return $this
     */
    protected function times($count)
    {
        $this->times = $count;

        return $this;
    }

    /**
     * @param $type
     * @param array $fields
     * @throws BadMethodCallException
     */
    protected function make($type, array $fields = [])
    {
        while ($this->times--)
        {
            $stub = array_merge($this->getStub(), $fields);
            $type::create($stub);
        }

    }

    /**
     * @throws BadMethodCallException
     */
    protected function getStub()
    {
        throw new BadMethodCallException('Create your own getStub method to declare your own fields!');
    }

} 