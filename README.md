# rest-recipes


## Router

Routes a request to specific endpoint and extracts variables.

A route must begin with '/'.

The order of the parameters of the route and the parameters of the routeFunction
should be the same.

The order of routes must be in a order like:

- /recipe/
- /recipe/create (e.g. default data and id as response)
- /recipe/create/&lt;name&gt; (specific name for creation and id as response)
- /recipe/&lt;id&gt;
- /recipe/&lt;id&gt;/export
- /recipe/&lt;id&gt;/&lt;someVar&gt;

### Usage

```php
<?php
/**
 * api.php
 *
 * @version 0.1
 *
 */

require_once "RestRecipes/autoload.php";

use RestRecipes/Router;

$app = new Router();

// Index
$app->route("/recipe/", "GET", function() {
    
});

// Detail
$app->route("/recipe/<id>", "GET", function($id) {
    
});
```

The default querySelector of the Router class is `$q`. You can call the api
like this:

```
GET api.php?q=/recipe/
GET api.php?q=/recipe/3
```
