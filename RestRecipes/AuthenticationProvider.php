<?php
/**
 * AuthenticationProvider
 * 
 * @author Maik Wöhl
 * @version 0.2
 * @package RestRecipes
 */

namespace RestRecipes;


/**
 * Authentication Provider for checking authentication
 * 
 * 
 */
class AuthenticationProvider {
    
    const AUTH_HTTP_BASIC = 0;
    const AUTH_HTTP_VAR = 1;
    
    /**
     * Constructor
     * 
     * @param int $authMethod
     */
    public function __construct($authMethod = AuthenticationProvider::AUTH_HTTP_BASIC) {
        $this->authMethod = $authMethod;
    }
    
    
    /**
     * Sets credentials for HTTP BASIC Authentication method
     * 
     * @param string $username
     * @param string $password
     */
    public function setHttpBasicAuthenticationCredentials($username, $password) {
        $this->httpBasicAuthUsername = $username;
        $this->httpBasicAuthPassword = $password;
    }
    
    /**
     * Handles HTTP BASIC Authentication method
     * 
     * @return boolean
     */
    private function httpBasicAuthenticationHandler() {
        if ($_SERVER["PHP_AUTH_USER"] == $this->httpBasicAuthUsername
            && $_SERVER["PHP_AUTH_PW"] == $this->httpBasicAuthPassword)
            return true;
        else
            return false;
    }
    
    /**
     * Sets credentials for HTTP VAR Authentication method
     * 
     * @param string $apikey
     */
    public function setHttpVarAuthenticationApikey($apikey) {
        $this->httpVarApikey = $apikey;
    }
    
    /**
     * Handles HTTP VAR Authentication method
     * 
     * @return boolean
     */
    private function httpVarAuthenticationHandler() {
        if ($_SERVER["HTTP_X_API_AUTH"] == $this->httpVarApikey
            && !is_null($_SERVER["HTTP_X_API_AUTH"])
            && isset($_SERVER["HTTP_X_API_AUTH"]))
            return true;
        else
            return false;
    }
    
    /**
     * Checks authentication according auth $authMethod
     * 
     * @return boolean
     */
     public function authenticate() {
         $result = false;
         switch ($this->authMethod) {
             case AuthenticationProvider::AUTH_HTTP_BASIC:
                $result = $this->httpBasicAuthenticationHandler();
                break;
            case AuthenticationProvider::AUTH_HTTP_VAR:
                $result = $this->httpVarAuthenticationHandler();
                break;
         }
         
         return $result;
     }
}