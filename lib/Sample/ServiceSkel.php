<?php
namespace Lib\Sample;

abstract class ServiceSkel
{

    public function __construct()
    {
        echo 'loading... service skel' . PHP_EOL;
    }

    abstract public function say($word);
}
