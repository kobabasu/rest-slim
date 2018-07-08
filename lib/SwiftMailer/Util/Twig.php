<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\SwiftMailer\Util;

class Twig
{
    /** @var Object #twig twigオブジェクト */
    private $twig;

    /** Twigのコンテントディレクトリ */
    const CONTENT_DIR = '../slimphp/mail';

    /** Twigのテンプレートディレクトリ */
    const TEMPLATE_DIR = 'slimphp/mail';

    /** Twigのキャッシュディレクトリseparatorはいらない */
    const CACHE_DIR = 'cache';

    /** デバッグモード。falseにするとcacheが有効になる */
    const DEBUG = true;

    /**
     * Twigのテンプレートを反映して返す
     *
     * @param String $template // テンプレートファイル名
     * @param Array $data // テンプレート内ファイルの変数
     * @return void
     */
    public function render(
        $template,
        $data = array()
    ) {
        if (file_exists(__DIR__ . '/../../../../slimphp')) {
            $dir = self::TEMPLATE_DIR;
        } else {
            $dir = self::CONTENT_DIR;
        }
        $loader = new \Twig_Loader_Filesystem($dir);
        $this->twig = new \Twig_Environment($loader, array(
            'debug' => self::DEBUG,
            'cache' => self::CACHE_DIR
        ));

        return $this->twig->render(
            $template,
            (Array)$data
        );
    }
}
