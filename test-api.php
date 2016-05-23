<?php

require_once "RestRecipes/autoload.php";

use RestRecipes\Router;

$app = new Router();

$app->route("/recipe/", "GET", function() {
    
});

$app->route("/recipe/create", "POST", function() {
    
});

$app->route("/recipe/create/<name>", "POST", function($name) {
    
});

$app->route("/recipe/<id>", "GET", function() {
    
});

$app->route("/recipe/<id>", "PUT", function() {
    
});

$app->route("/recipe/<id>", "DELETE", function() {
    
});

$app->route("/recipe/<id>/export", "GET", function() {
    
});

$app->route("/recipe/<id>/<someVar>", "GET", function() {
    
});

/* Complex stuff */

function someFunc() {
    
    if (func_num_args > 0) {
        // Do stuff with $name
        return;
    }
    
    echo "Some Content\n";
    return;
}

$app->route("/test/", "GET", someFunc);

$app->route("/test/<name>", "GET", someFunc);
