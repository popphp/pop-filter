<?php
/**
 * Pop PHP Framework (https://www.popphp.org/)
 *
 * @link       https://github.com/popphp/popphp-framework
 * @author     Nick Sagona, III <dev@noladev.com>
 * @copyright  Copyright (c) 2009-2025 NOLA Interactive, LLC.
 * @license    https://www.popphp.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Pop\Filter;

use Pop\Utils\CallableObject;

/**
 * Abstract filter class
 *
 * @category   Pop
 * @package    Pop\Filter
 * @author     Nick Sagona, III <dev@noladev.com>
 * @copyright  Copyright (c) 2009-2025 NOLA Interactive, LLC.
 * @license    https://www.popphp.org/license     New BSD License
 * @version    4.0.0
 */
abstract class AbstractFilter implements FilterInterface
{

    /**
     * Filter callable
     * @var CallableObject
     */
    protected ?CallableObject $callable = null;

    /**
     * Exclude by type
     * @var array
     */
    protected array $excludeByType = [];

    /**
     * Exclude by name
     * @var array
     */
    protected array $excludeByName = [];

    /**
     * Constructor
     *
     * Instantiate the form filter object
     *
     * @param  mixed $callable
     * @param  mixed $params
     * @param  mixed $excludeByName
     * @param  mixed $excludeByType
     */
    public function __construct(mixed $callable, mixed $params = null, mixed $excludeByName = null, mixed $excludeByType = null)
    {
        $this->setCallable($callable);

        if ($params !== null) {
            $this->setParams($params);
        }
        if ($excludeByName !== null) {
            $this->setExcludeByName($excludeByName);
        }
        if ($excludeByType !== null) {
            $this->setExcludeByType($excludeByType);
        }
    }

    /**
     * Set callable
     *
     * @param  mixed $callable
     * @return AbstractFilter
     */
    public function setCallable(mixed $callable): AbstractFilter
    {
        if (!($callable instanceof CallableObject)) {
            $callable = new CallableObject($callable);
        }
        $this->callable = $callable;
        return $this;
    }

    /**
     * Set params
     *
     * @param  mixed $params
     * @return AbstractFilter
     */
    public function setParams(mixed $params): AbstractFilter
    {
        if (is_array($params)) {
            $this->callable->setParameters($params);
        } else {
            $this->callable->setParameters([$params]);
        }

        return $this;
    }

    /**
     * Set exclude by name
     *
     * @param  mixed $excludeByName
     * @return AbstractFilter
     */
    public function setExcludeByName(mixed $excludeByName): AbstractFilter
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
    public function setExcludeByType(mixed $excludeByType): AbstractFilter
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
     * @return CallableObject
     */
    public function getCallable(): CallableObject
    {
        return $this->callable;
    }

    /**
     * Get params
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->callable->getParameters();
    }

    /**
     * Get exclude by name
     *
     * @return array
     */
    public function getExcludeByName(): array
    {
        return $this->excludeByName;
    }

    /**
     * Get exclude by type
     *
     * @return array
     */
    public function getExcludeByType(): array
    {
        return $this->excludeByType;
    }

    /**
     * Has callable
     *
     * @return bool
     */
    public function hasCallable(): bool
    {
        return ($this->callable !== null);
    }

    /**
     * Has params
     *
     * @return bool
     */
    public function hasParams(): bool
    {
        return $this->callable->hasParameters();
    }

    /**
     * Has exclude by name
     *
     * @return bool
     */
    public function hasExcludeByName(): bool
    {
        return (!empty($this->excludeByName));
    }

    /**
     * Has exclude by type
     *
     * @return bool
     */
    public function hasExcludeByType(): bool
    {
        return (!empty($this->excludeByType));
    }

    /**
     * Filter value
     *
     * @param  mixed   $value
     * @param  ?string $name
     * @param  mixed   $type
     * @return mixed
     */
    public function filter(mixed $value, ?string $name = null, mixed $type = null): mixed
    {
        if ((($type === null) || (!in_array($type, $this->excludeByType))) &&
            (($name === null) || (!in_array($name, $this->excludeByName)))) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $callableParams = $this->callable->getParameters();
                    $params         = array_merge([$v], $callableParams);
                    $this->callable->setParameters($params);

                    $value[$k] = $this->callable->call();

                    $this->callable->setParameters($callableParams);
                }
            } else {
                $callableParams = $this->callable->getParameters();
                $params         = array_merge([$value], $callableParams);
                $this->callable->setParameters($params);

                $value = $this->callable->call();

                $this->callable->setParameters($callableParams);
            }
        }

        return $value;
    }

}
