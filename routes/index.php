<?php
/**
 * root
 */
$app->get(
    '/',
    function (
        $request,
        $response,
        $args
    ) {
        $response->write('hello');

        return $response->withHeader(
            'Content-Type',
            'text/html'
        );
    }
);
