<?php
$app->group('/users', function() use ($app) {

  $app->get('(/:id)', function($id = null) use ($app) {
    echo 'users get' . $id;
  });
});
