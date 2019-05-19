# NetteSlalom
Do configuration magic easily in Nette!

Extension of ```Spaceboy\ConfigSlalom``` for Nette.

## Installation:
Type

```
composer require spaceboy/nette-slalom
```

and that's all.

## Example:
```
use Spaceboy\ConfigSlalom\NetteSlalom;

$configurator = NetteSlalom::run()
    ->when()
        ->serverNameIs('localhost')
        ->addConfig('config.local.neon')
        ->setDebugMode(TRUE)
        ->andContinue()
    ->when()
        ->serverNameIsIn(['localhost', 'farhost'])
        ->addConfig('config.farhost.neon')
        ->andContinue()
    ->when()
        ->serverNameNotMatches('^ocalhost$')
        ->addConfig('config.ocal.neon')
    ->otherwise()
        ->throw(new \Exception('Wrong server host.'))
    ->finally()
        ->addConfig('config.finally.neon')
        ->addParameters('finally', 'FOO')
        ->addParameters([
            'finally1'  => 'BAR',
            'finally2'  => 'BAZ',
        ])
    ->run();

$container = $configurator->createContainer();

return $container;
```
- ### `withConfigurator(Nette\Configurator $configurator): NetteSlalom`
  Starts new configuration slalom with existing `$configurator`.

- ### `addDynamicParameters(array $parametersArray): NetteSlalom`
  Provides an action.
  
  Equal to `$configurator->addDynamicParameters($parametersArray)`.

- ### `addConfig(string $config): NetteSlalom`
  Provides an action.
  
  Equal to `$configurator->addConfig($config)`.

- ### `addParameters(array|string $parameters[, mixed $value]): NetteSlalom`
  Provides an action.
  
  Adds parameters to `$configurator`.

  When first parameter is array, sets array of parameters.

  When first parameter is string, parameter array is created as ```array($firstParameter => secondParameter)```.

  Equal to `$configurator->addParameters($parameters)`.

- ### `addServices(array $servicesArray): NetteSlalom`
  Provides an action.
  
  Adds a `$servicesArray` to `$configurator`.

  Equal to `$configurator->addServices($servicesArray)`.

- ### `createRobotLoader(): NetteSlalom`
  Provides an action.

  Creates robot loader.

  Equal to `$configurator->createRobotLoader()`.

- ### `enableDebugger([string $logDirectory[, string $email]]): NetteSlalom`
  Provides an action.
  
  Adds a `$config` file to `$configurator`.

  Equal to `$configurator->enableDebugger([$logDirectory[, $email]])`.

- ### `enableTracy([string $logDirectory[, string $email]]): NetteSlalom`
  Provides an action.
  
  Enables Tracy.

  Equal to `$configurator->enableTracy([$logDirectory[, $email]])`.

- ### `setDebugMode(bool $mode): NetteSlalom`
  Provides an action.

  Sets DEBUG mode.

  Equal to `$configurator->setDebugMode($mode)`.

