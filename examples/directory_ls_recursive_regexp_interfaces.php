<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$filesystem = \React\Filesystem\Filesystem::create($loop);
echo 'Using ', get_class($filesystem->getAdapter()), PHP_EOL;
$filesystem->dir(dirname(__DIR__))->lsRecursive()->then(function (array $list) {
    $iterator = new ArrayIterator($list);
    $interfaces = new RegexIterator($iterator, '/.*?Interface.php$/');

    foreach ($interfaces as $node) {
        echo $node->getPath(), PHP_EOL;
    }
}, function ($e) {
    echo $e->getMessage(), PHP_EOL;
});

$loop->run();
