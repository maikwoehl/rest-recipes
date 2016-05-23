<?php
/**
 * Router
 * 
 * @author Maik Wöhl
 * @version 0.1
 * @package RestRecipes
 */

namespace RestRecipes;

/**
 * Simple Router to create routes
 * 
 * @example test-api.php API in action
 */
class Router {
    
    /**
     * @var bool $requestAccepted Whether the request was accepted by a former handler
     */
    private $requestAccepted = false;
    
    /**
     * Constructor 
     * 
     * @param string $querySelector
     */
    public function __construct($querySelector = "q") {
        $this->querySelector = $querySelector;
        $this->query = filter_input(INPUT_GET, $this->querySelector);
    }
    
    /**
     * Routes a request to specific endpoint and extracts variables
     * 
     * A route must begin with '/'.
     * 
     * The order of the parameters of the route and the parameters of the routeFunction
     * should be the same.
     * 
     * The order of routes must be in a order like:
     * 
     *  - /recipe/
     *  - /recipe/create (e.g. default data and id as response)
     *  - /recipe/create/&lt;name&gt; (specific name for creation and id as response)
     *  - /recipe/&lt;id&gt;
     *  - /recipe/&lt;id&gt;/export
     *  - /recipe/&lt;id&gt;/&lt;someVar&gt;
     * 
     * 
     * @param string $route
     * @param string $method
     * @param callable $routeFunction
     * @throws \InvalidArgumentException if $routeFunction is not a callable
     */
    public function route($route, $method, callable $routeFunction) {
        
        // TODO Maybe make a priority list programatically
        
        // Check if $routeFunction is a callable
        if (!is_callable($routeFunction)) {
            throw new InvalidArgumentException("callback function is not a callable");
            return;
        }
        
        // If used method doesn't fit into this route, jump back
        if ($_SERVER["REQUEST_METHOD"] != $method) {
            return;
        }
        
        $routeList = array(); // Route Parts
        $varList = array(); // Variable Parts (index important)
        $parameters = array(); // Parameters who will be send to callable
        
        $routeArray = explode("/", $route);
        
        //echo "route: ". $route."\n";
        
        // Sort routeArray into routes and variables
        foreach ($routeArray as $i => $item) {
            if (strpos($item, "<") !== false) {
                $item = str_replace("<", "", $item);
                $item = str_replace(">", "", $item);
                $varList[$i] = $item;
            } else {
                $routeList[$i] = $item;
            }
        }
        
        // Check query type
        $routeList[0] = "ROOT";
        
        if (strcasecmp(substr($route, -1), "/") == 0)
            $routeList[sizeof($routeList)-1] = "FULL_END";
        else 
            $routeList[] = "END";
        
        
        
        if ($routeList[sizeof($routeList)-1] == "FULL_END") {
            if (strcasecmp(substr($this->query, -1), "/") != 0)
                return;
        }
        
        if ($routeList[sizeof($routeList)-1] == "END") {
            if (strcasecmp(substr($this->query, -1), "/") == 0)
                return;
        }
        
        
        // Compare route size with query size
        if (substr($this->query, -1) == "/")
            $routeListSize = sizeof($routeList);
        else 
            $routeListSize = sizeof($routeList)-1;
        
        
        $callQueryArray = explode("/", $this->query);
        
        if ($routeListSize+sizeof($varList) != sizeof($callQueryArray))
            return;
        
        // Check if this handler is the correct one
        foreach ($routeList as $i => $item) {
            // Tags should not be inspected
            if ($item != "ROOT" && $item != "END" && $item != "FULL_END") {
                
                //echo "\n$item - {$callQueryArray[$i]}\n";
                // No empty items and only items who are in routeList and query
                if (empty($item) || (strcasecmp($item, $callQueryArray[$i]) != 0))
                    return;
            }
        }
        
        // Populate variables
        foreach ($varList as $i => $var) {
            // ${$var} = ... not necessary
            $parameters[] = $callQueryArray[$i];
        }
        
        // Only call function if there was no other function call
        if (!$this->requestAccepted) {
            call_user_func_array($routeFunction, $parameters);
            $this->requestAccepted = true;
        }
    }
}