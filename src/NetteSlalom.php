<?php

namespace Spaceboy\ConfigSlalom;

# composer require nette/nette

class NetteSlalom extends Slalom
{

    /**
     * @param \Nette\Configurator $configurator
     */
    protected function __construct($configurator)
    {
        $this->configurator = (
            is_null($configurator)
            ? new Nette\Configurator
            : $configurator
        );
    }

    /**
     * Get instantion w/ configurator
     * @param Nette\Configurator $configurator
     * @return NetteSlalom
     */
    public static function withConfigurator($configurator)
    {
        return new static($configurator);
    }

    /**
     * @param string config file
     * @return Config
     */
    public function addConfig($config)
    {
        $configurator   = $this->configurator;
        $this->active->action[] = function () use (&$configurator, $config) {
            $configurator->addConfig($config);
        };
        return $this;
    }

    /**
     * @param array params
     * @return Config
     */
    public function addDynamicParameters($params)
    {
        $configurator   = $this->configurator;
        $this->active->action[] = function () use (&$configurator, $params) {
            $configurator->addDynamicParameters($params);
        };
        return $this;
    }

    /**
     * @param array services
     * @return Config
     */
    public function addServices(array $services)
    {
        $configurator   = $this->configurator;
        $this->active->action[] = function () use (&$configurator, $services) {
            $configurator->addServices($services);
        };
        return $this;
    }

    /**
     * @param mixed logDirectory
     * @param mixed email
     * @return Config
     */
    public function enableTracy($logDirectory = null, $email = null)
    {
        $configurator   = $this->configurator;
        $this->active->action[] = function () use (&$configurator, $logDirectory, $email) {
            $configurator->enableTracy($logDirectory, $email);
        };
        return $this;
    }

    /**
     * @param mixed logDirectory
     * @param mixed email
     * @return Config
     */
    public function enableDebugger($logDirectory = null, $email = null)
    {
        $configurator   = $this->configurator;
        $this->active->action[] = function () use (&$configurator, $logDirectory, $email) {
            $configurator->enableDebugger($logDirectory, $email);
        };
        return $this;
    }

    /**
     * @return Config
     */
    public function createRobotLoader()
    {
        $configurator   = $this->configurator;
        $this->active->action[] = function () use (&$configurator) {
            $configurator->createRobotLoader();
        };
        return $this;
    }

    /**
     * @param boolean debug mode
     * @return Config
     */
    public function setDebugMode($mode)
    {
        $configurator   = $this->configurator;
        $this->active->action[] = function () use (&$configurator, $mode) {
            $configurator->setDebugMode($mode);
        };
        return $this;
    }

    /**
     * @param array|string parameters / parameter name
     * @param null|mixed: when first parameter is string, value of added parameter
     * @return Config
     */
    public function addParameters($parameters, $value = NULL)
    {
        $params = (
            is_array($parameters)
            ? $parameters
            : array($parameters => $value)
        );
        $configurator   = $this->configurator;
        $this->active->action[] = function () use (&$configurator, $params) {
            $configurator->addParameters($params);
        };
        return $this;
    }
}
