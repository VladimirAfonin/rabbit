<?php
declare(strict_types=1);

use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

//$config = require __DIR__ . '/config.php';

$aggregator = new ConfigAggregator([
    new PhpFileProvider(__DIR__ . '/common/*.php'),
]);

$config = $aggregator->getMergedConfig();

return new \Slim\Container($config);