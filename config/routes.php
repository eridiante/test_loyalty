<?php


use App\Middlewares\{
    ProccessRawBody
};
use Pecee\{
    Http\Request,
    SimpleRouter\SimpleRouter as Router
};


Router::setDefaultNamespace('App\Controllers');

Router::group([
    'prefix' => 'api/v1',
    'middleware' => [
        ProccessRawBody::class
    ]
], function () {
    Router::get('/users/{userId}/permissions', 'GroupController@getUserPermissions');
    Router::get('/users/{userId}/groups', 'GroupController@getUserGroups');
    Router::post('/users/{userId}/groups/{groupId}', 'GroupController@addUserToGroup');
    Router::delete('/users/{userId}/groups/{groupId}', 'GroupController@removeUserFromGroup');
});

Router::error(function(Request $request, Exception $exception) {

    $response = Router::response();

    if ($_ENV['DEV']) {
        return $response->json([
            'status' => 'error',
            'message' => $exception->getMessage()
        ]);
    } else {
        return $response->json([]);
    }
});