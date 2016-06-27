<?php

require "RestRecipes/autoload.php";

use RestRecipes\Router;

$app = new Router();

$app->route("/order/<id>", "PUT", function ($order_id, $data) {
    echo $order_id;
    echo "\n".$data;
});