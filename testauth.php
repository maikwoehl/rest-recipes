<?php

require_once "RestRecipes/autoload.php";

use RestRecipes\SecurityProvider;

$security = new SecurityProvider(SecurityProvider::AUTH_HTTP_BASIC);

$security->setHttpBasicAuthenticationCredentials("maik", "bla");

var_dump($security->authenticate());