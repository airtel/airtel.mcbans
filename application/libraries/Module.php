<?php

if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed'); 


class Module
{
    
    
    /**
     * Superclass pointer
     */
    private $CI;
    
    public $pay_methods = array();
    
    public $testing = FALSE;
    
    public $sms_prices = array();
    
    
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->CI =& get_instance();
        
        // Loading configs
        $this->CI->load->config('mcbans/master');
        $this->CI->load->config('mcbans/system');
        
        // Load payment libraries
        $this->CI->load->library('payments/smscode');
        $this->CI->load->library('payments/paypalcode');
        $this->CI->load->library('payments/ibankcode');
        
        // Load code testing param
        $this->testing = $this->CI->config->item('testing');
        
        // Get active pay methods
        $this->pay_methods = $this->CI->config->item('minecraft_payments');
        
        $this->pay_options = $this->CI->config->item('payment_options');
        
        // SMS prices
        $this->sms_prices = $this->CI->smscode->get_prices('lv');
    }
    
    
}