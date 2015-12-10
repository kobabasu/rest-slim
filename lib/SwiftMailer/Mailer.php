<?php
namespace Lib\SwiftMailer;

class Mailer {

  private $app;
  private $mailer;
  private $transport;
  private $message;

  private $subject;
  private $from;
  private $body;

  public function __construct($app) {
    $this->app = $app;
    $this->transport = $this->getTransport();
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

  public function setSubject() {
  }

  public function send() {
    $message = \Swift_Message::newInstance()
      ->setSubject('test')
      ->setTo('taro@example.com')
      ->setFrom('send@example.com')
      ->setBody('test');

    $mailer = \Swift_Mailer::newInstance($this->transport);
    $mailer->send($message);
  }
}
