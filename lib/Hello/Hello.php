<?php
/**
 * Helloクラスのファイル
 */

namespace Lib\Hello;

/**
 * 一番単純なクラスのサンプル
 */
class Hello
{
    /**
     * @ignore
     */
    public function __construct()
    {
    }

    /**
     * 'Hello'を返す
     *
     * @access public
     * @return String 'Hello'という文字列を返す
     */
    public function say()
    {
        return 'Hello';
    }
}
