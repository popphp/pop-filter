<?php
/**
 * Pop PHP Framework (http://www.popphp.org/)
 *
 * @link       https://github.com/popphp/popphp-framework
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2020 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Pop\Filter;

/**
 * Abstract filter class
 *
 * @category   Pop
 * @package    Pop\Filter
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2020 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    3.0.0
 */
abstract class AbstractFilter implements FilterInterface
{

    /**
     * Filter callable
     * @var callable
     */
    protected $callable = null;

    /**
     * Parameters
     * @var array
     */
    protected $params = [];

    /**
     * Exclude by type
     * @var array
     */
    protected $excludeByType = [];

    /**
     * Exclude by name
     * @var array
     */
    protected $excludeByName = [];

    /**
     * Constructor
     *
     * Instantiate the form filter object
     *
     * @param  callable $callable
     * @param  mixed    $params
     * @param  mixed    $excludeByName
     * @param  mixed    $excludeByType
     */
    public function __construct(callable $callable, $params = null, $excludeByName = null, $excludeByType = null)
    {
        $this->setCallable($callable);

        if (null !== $params) {
            $this->setParams($params);
        }
        if (null !== $excludeByName) {
            $this->setExcludeByName($excludeByName);
        }
        if (null !== $excludeByType) {
            $this->setExcludeByType($excludeByType);
        }
    }

    /**
     * Set callable
     *
     * @param  callable $callable
     * @return AbstractFilter
     */
    public function setCallable(callable $callable)
    {
        $this->callable = $callable;
        return $this;
    }

    /**
     * Set params
     *
     * @param  mixed $params
     * @return AbstractFilter
     */
    public function setParams($params)
    {
        if (!is_array($params)) {
            $params = [$params];
        }
        $this->params = $params;

        return $this;
    }

    /**
     * Set exclude by name
     *
     * @param  mixed $excludeByName
     * @return AbstractFilter
     */
    public function setExcludeByName($excludeByName)
    {
        if (!is_array($excludeByName)) {
            $excludeByName = [$excludeByName];
        }
        $this->excludeByName = $excludeByName;

        return $this;
    }

    /**
     * Set exclude by type
     *
     * @param  mixed $excludeByType
     * @return AbstractFilter
     */
    public function setExcludeByType($excludeByType)
    {
        if (!is_array($excludeByType)) {
            $excludeByType = [$excludeByType];
        }
        $this->excludeByType = $excludeByType;

        return $this;
    }

    /**
     * Get callable
     *
     * @return callable
     */
    public function getCallable()
    {
        return $this->callable;
    }

    /**
     * Get params
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Get exclude by name
     *
     * @return array
     */
    public function getExcludeByName()
    {
        return $this->excludeByName;
    }

    /**
     * Get exclude by type
     *
     * @return array
     */
    public function getExcludeByType()
    {
        return $this->excludeByType;
    }

    /**
     * Has callable
     *
     * @return boolean
     */
    public function hasCallable()
    {
        return (null !== $this->callable);
    }

    /**
     * Has params
     *
     * @return boolean
     */
    public function hasParams()
    {
        return (!empty($this->params));
    }

    /**
     * Has exclude by name
     *
     * @return boolean
     */
    public function hasExcludeByName()
    {
        return (!empty($this->excludeByName));
    }

    /**
     * Has exclude by type
     *
     * @return boolean
     */
    public function hasExcludeByType()
    {
        return (!empty($this->excludeByType));
    }

    /**
     * Filter value
     *
     * @param  mixed  $value
     * @param  string $name
     * @param  mixed  $type
     * @return mixed
     */
    public function filter($value, $name = null, $type = null)
    {
        if (((null === $type) || (!in_array($type, $this->excludeByType))) &&
            ((null === $name) || (!in_array($name, $this->excludeByName)))) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $params    = array_merge([$v], $this->params);
                    $value[$k] = call_user_func_array($this->callable, $params);
                }
            } else {
                $params = array_merge([$value], $this->params);
                $value  = call_user_func_array($this->callable, $params);
            }
        }

        return $value;
    }

}