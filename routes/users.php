<?php
namespace Routes;

/**
 * users
 */
$app->group('/users', function () {

    /**
     * GET
     */
    $this->get(
        '/{name:.*}',
        function (
            $request,
            $response,
            $args
        ) {
            $body = array('名前' => $args['name']);

            return $response->withJson(
                $body,
                200,
                $this->get('withJsonEncOption')
            );
        }
    );

});
