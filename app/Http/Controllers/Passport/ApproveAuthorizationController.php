<?php
namespace App\Http\Controllers\Passport;

use Illuminate\Http\Request;
use Zend\Diactoros\Response as Psr7Response;
use League\OAuth2\Server\AuthorizationServer;
use Laravel\Passport\Http\Controllers\ApproveAuthorizationController as Base;

class ApproveAuthorizationController extends Base
{}