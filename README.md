# rest-recipes


## Router

Routes a request to specific endpoint and extracts variables

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