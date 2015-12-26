<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Sample;

use Lib\Sample\ServiceIF;

/**
 * 注入される側のクラス
 *
 * @package Sample
 */
class Client
{
    /**
     * 注入したオブジェクト
     *
     * @var Object $service
     * @access pirvate
     */
    private $service;

    /**
     * 引数でインスタンスを注入
     *
     * @access public
     * @param ServiceIF $service
     * @return void
     */
    public function __construct(ServiceIF $service)
    {
        $this->service = $service;
    }

    /**
     * 注入されたオブジェクトのsayメソッドに引数を渡す
     *
     * @access public
     * @param String $word
     * @return String
     */
    public function say($word)
    {
        return $this->service->say($word);
    }
}
