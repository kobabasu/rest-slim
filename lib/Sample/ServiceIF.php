<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Sample;

/**
 * Serviceのインターフェース
 *
 * @package Sample
 */
interface ServiceIF
{
    /**
     * sayは必ず実装する
     *
     * @access public
     * @param String $word
     * @return String
     */
    public function say($word);
}
