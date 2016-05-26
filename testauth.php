<?php

require_once "RestRecipes/autoload.php";

use RestRecipes\SecurityProvider;

$security = new SecurityProvider(SecurityProvider::AUTH_HTTP_VAR);

$security->setHttpVarAuthenticationApikey("test");

var_dump($security->authenticate());