<?php
/**
 * SecurityProvider
 * 
 * @author Maik Wöhl
 * @version 0.1
 * @package RestRecipes
 */

namespace RestRecipes;


/**
 * Security Provider for checking authentication
 * 
 * 
 */
class SecurityProvider {
    
    const AUTH_HTTP_BASIC = 0;
    
    /**
     * Constructor
     * 
     * @param int $authMethod
     */
    public function __construct($authMethod = SecurityProvider::AUTH_HTTP_BASIC) {
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
     * Checks authentication according auth $authMethod
     * 
     * @return boolean
     */
     public function authenticate() {
         $result = false;
         switch ($this->authMethod) {
             case SecurityProvider::AUTH_HTTP_BASIC:
                $result = $this->httpBasicAuthenticationHandler();
                break;
         }
         
         return $result;
     }
}