<?php
class User { 
    public $username; 
    public $email; 
    
    
    function __construct($username, $email) {
    	$this->username = $username;
    	$this->email = $email;
    }

    function aUserFunc() { 
        print 'Inside `aMemberFunc()`'; 
    } 
} 

$user = new User; 