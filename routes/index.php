<?php
$app->get('/', function($id = null) use ($app) {
  echo 'default' . $id;
});
