<?php
namespace App\Passport;

use Illuminate\Contracts\Routing\Registrar as Router;
use Laravel\Passport\RouteRegistrar as Base;

class RouteRegistrar extends Base
{
	
    /**
     * Register the routes needed for authorization.
     *
     * @return void
     */
    public function forAuthorization()
    {
        $this->router->group([
        	'namespace' => 'App\Http\Controllers\Passport',
        	'middleware' => ['web', 'auth'],
        ], function ($router) {
            $router->get('/authorize', [
                'uses' => 'AuthorizationController@authorize',
            ]);

            $router->post('/authorize', [
                'uses' => 'ApproveAuthorizationController@approve',
            ]);

            $router->delete('/authorize', [
                'uses' => 'DenyAuthorizationController@deny',
            ]);
        });
    }

    /**
     * Register the routes for retrieving and issuing access tokens.
     *
     * @return void
     */
    public function forAccessTokens()
    {
        $this->router->post('/token', [
            'uses' => 'AccessTokenController@issueToken',
            'middleware' => 'throttle',
        ]);

        $this->router->group(['namespace' => '\Laravel\Passport\Http\Controllers', 'middleware' => ['web', 'auth']], function ($router) {
            $router->get('/tokens', [
                'uses' => 'AuthorizedAccessTokenController@forUser',
            ]);

            $router->delete('/tokens/{token_id}', [
                'uses' => 'AuthorizedAccessTokenController@destroy',
            ]);
        });
    }
    
    /**
     * Register the routes needed for managing clients.
     *
     * @return void
     */
    public function forClients()
    {
        $this->router->group(['namespace' => '\Laravel\Passport\Http\Controllers', 'middleware' => ['web', 'auth']], function ($router) {
            $router->get('/clients', [
                'uses' => 'ClientController@forUser',
            ]);

            $router->post('/clients', [
                'uses' => 'ClientController@store',
            ]);

            $router->put('/clients/{client_id}', [
                'uses' => 'ClientController@update',
            ]);

            $router->delete('/clients/{client_id}', [
                'uses' => 'ClientController@destroy',
            ]);
        });
    }
    
    /**
     * Register the routes needed for managing personal access tokens.
     *
     * @return void
     */
    public function forPersonalAccessTokens()
    {
        $this->router->group(['namespace' => '\Laravel\Passport\Http\Controllers', 'middleware' => ['web', 'auth']], function ($router) {
            $router->get('/scopes', [
                'uses' => 'ScopeController@all',
            ]);

            $router->get('/personal-access-tokens', [
                'uses' => 'PersonalAccessTokenController@forUser',
            ]);

            $router->post('/personal-access-tokens', [
                'uses' => 'PersonalAccessTokenController@store',
            ]);

            $router->delete('/personal-access-tokens/{token_id}', [
                'uses' => 'PersonalAccessTokenController@destroy',
            ]);
        });
    }
}