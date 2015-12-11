<?php
namespace Lib\SwiftMailer;

class Mailer {

  private $app;
  private $mailer;
  private $transport;
  private $message;
  private $charset;

  private $subject;
  private $from;
  private $body;

  private $twig;

  public function __construct($app, $charset = null) {
    $this->app = $app;
    $this->charset = $charset;
    $this->setDefault();

    $this->initSwift();
    $this->initTwig();
    $this->transport = $this->getTransport();
  }

  private function initSwift() {
    \Swift::init(function () {
      \Swift_DependencyContainer::getInstance()
        ->register('mime.qpheaderencoder')
        ->asAliasOf('mime.base64headerencoder');
      \Swift_Preferences::getInstance()->setCharset(
        'iso-2022-jp'
      );
    });
  }

  private function initTwig() {
    $loader = new \Twig_Loader_Filesystem('mail');
    $this->twig = new \Twig_Environment($loader, array(
      'cache' => 'cache'
    ));
  }

  private function setDefault() {
    $config = $this->app->config('mail');
    
    $this->subject = $config['subject'];
    $this->from    = $config['from'];
    $this->body    = $config['body'];
  }

  private function getTransport() {
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

  public function setSubject($subject) {
    $this->subject = $subject;
  }

  public function setFrom($from) {
    $this->from = $from;
  }

  public function setBody($body) {
    $this->body = $body;
  }

  public function setTemplate($template, $data) {
    $this->body = $this->twig->render(
      $template, $data
    );
  }

  public function send($to) {
    $message = \Swift_Message::newInstance()
      ->setSubject($this->subject)
      ->setTo($to)
      ->setFrom($this->from)
      ->setBody($this->body);

    if ($this->charset) {
      $message->setCharset($this->charset);
      $message->setEncoder(
        \Swift_Encoding::get7BitEncoding()
      );
    }

    $mailer = \Swift_Mailer::newInstance($this->transport);
    $mailer->send($message);
  }
}
