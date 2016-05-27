<?php

require_once "RestRecipes/autoload.php";

use RestRecipes\AuthenticationProvider;

$security = new AuthenticationProvider(AuthenticationProvider::AUTH_HTTP_VAR);

$security->setHttpVarAuthenticationApikey("test");

var_dump($security->authenticate());