<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Sample;

/**
 * Serviceの雛形クラス
 *
 * @package Sample
 */
abstract class ServiceSkel
{

    /**
     * 雛形自体が出力
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        echo 'loading... service skel' . PHP_EOL;
    }

    /**
     * 引数を合わせ返す
     *
     * @access public
     * @param String $word
     * @return String
     */
    abstract public function say($word);
}
