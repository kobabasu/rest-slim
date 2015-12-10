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
    $this->setDefault();
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

  public function send() {
    $message = \Swift_Message::newInstance()
      ->setSubject($this->subject)
      ->setTo('taro@example.com')
      ->setFrom($this->from)
      ->setBody($this->body);

    $mailer = \Swift_Mailer::newInstance($this->transport);
    $mailer->send($message);
  }
}
