<?php
namespace Lib\SwiftMailer;

class Mailer
{
    const LOG_DIR = 'logs';
    const INTERVAL_COUNT = 100;
    const INTERVAL_TIME = 30;

    private $app;
    private $charset;
    private $transport;
    private $mailer;
    private $logger;
    private $twig;

    private $subject;
    private $from;
    private $body;

    public function __construct($app, $charset = null)
    {
        $this->app = $app;
        $this->charset = $charset;
        $this->setDefault();

        $this->initSwift();
        $this->initTwig();
        $this->transport = $this->getTransport();
        $this->setMailer();
        $this->setAntiFlood();
        $this->setLog();
    }

    private function initSwift()
    {
        \Swift::init(function () {
            \Swift_DependencyContainer::getInstance()
                ->register('mime.qpheaderencoder')
                ->asAliasOf('mime.base64headerencoder');
            \Swift_Preferences::getInstance()->setCharset(
                'iso-2022-jp'
            );
        });
    }

    private function initTwig()
    {
        $loader = new \Twig_Loader_Filesystem('mail');
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => 'cache'
        ));
    }

    private function setDefault()
    {
        $config = $this->app->config('mail');

        $this->subject = $config['subject'];
        $this->from    = $config['from'];
        $this->body    = $config['body'];
    }

    private function getTransport()
    {
        $config = $this->app->config('smtp');

        $transport = \Swift_SmtpTransport::newInstance(
            $config['host'],
            $config['port']
        );

        if ($config['user']) {
            $transport->setUsername($config['user']);
            $transport->setPassword($config['pass']);
        }

        return $transport;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function setTemplate($template, $data)
    {
        $this->body = $this->twig->render(
            $template,
            $data
        );
    }

    private function setMailer()
    {
        $mailer = \Swift_Mailer::newInstance($this->transport);
        $this->mailer = $mailer;
    }

    private function setAntiFlood()
    {
        $this->mailer->registerPlugin(
            new \Swift_Plugins_AntiFloodPlugin(
                self::INTERVAL_COUNT,
                self::INTERVAL_TIME
            )
        );
    }

    private function setLog()
    {
        $logger = new \Swift_Plugins_Loggers_ArrayLogger();
        $this->mailer->registerPlugin(
            new \Swift_Plugins_LoggerPlugin($logger)
        );

        $this->logger = $logger;
    }

    public function saveLog()
    {
        $date = date('ymd');
        $file = self::LOG_DIR . '/' . 'mail.' . $date . '.log';

        $current = '';
        if (file_exists($file)) {
            $current .= file_get_contents($file);
        }

        $log = $this->logger->dump();
        $current .= $log;

        file_put_contents($file, $current, FILE_APPEND);
    }

    public function send($to)
    {
        $message = \Swift_Message::newInstance()
            ->setTo($to)
            ->setSubject($this->subject)
            ->setFrom($this->from)
            ->setBody($this->body);

        if ($this->charset) {
            $message->setCharset($this->charset);
            $message->setEncoder(
                \Swift_Encoding::get7BitEncoding()
            );
        }

        $this->mailer->send($message);
    }
}
