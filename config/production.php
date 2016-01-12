<?php
const ENVIRONMENT_MODE = 'production';
const DEBUG_MODE       = false;

$_ENV['SLIM_MODE']  = ENVIRONMENT_MODE;

const DB_HOST       = '0.0.0.0';
const DB_NAME       = 'api';
const DB_USER       = 'api';
const DB_PASS       = 'api012';
const DB_PORT       = '3306';

const MAIL_HOST     = '127.0.0.1';
const MAIL_PORT     = 1025;
const MAIL_USER     = null;
const MAIL_PASS     = null;
const MAIL_LOGS     = true;
