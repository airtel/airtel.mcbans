<?php

if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed'); 


class Mcbans
{
    
    
    /**
     * Superclass pointer
     */
    private $CI;
    
    
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    
    
}