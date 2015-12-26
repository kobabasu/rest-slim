<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Sample;

use Lib\Sample\ServiceIF;
use Lib\Sample\ServiceSkel;

/**
 * 注入する側のクラス
 *
 * @package Sample
 */
class Service extends ServiceSkel implements ServiceIF
{
    /**
     * {@inheritdoc}
     */
    public function say($word)
    {
         return 'service: ' . $word . PHP_EOL;
    }
}
