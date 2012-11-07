<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Main extends CI_Controller {
    
    
    /**
     * Constructor
     */
    public function __construct()        
    {
        parent::__construct();

        $this->load->library('module');
        
        $this->load->model('mcbans_model');
        
        $this->load->library('ui');
        $this->load->library('validation');
        $this->load->library('mcbans');
    }
    
    
    public function index()
    {
        $data['bans'] = $this->mcbans_model->get_bans();
        
        // Load output
        $data['content'] = 'main/main_tpl';
        $this->load->view('core/container_tpl', $data);
    }
    
    
    /**
     * Ajax callback function
     */
    public function unban()
    {
        if( ! $this->input->is_ajax_request()) show_error('Direct access denied.', 500);

        // For debug
        sleep(1);
        
        $data['fields'] = array();
        
        if($this->input->post('submit-form'))
        {
            $pay_method = $this->validation->get_paymethod();
            $pay_code = $this->input->post($pay_method.'code');
            
            /**
             * Starting validation check
             */
            if($this->validation->validation_parser($data['fields'], $pay_method) == FALSE)
            {
                $output = array(
                    'type' => 'error',
                    'text' => 'Lūdzu pārbaudiet visus ievadītos datus!',
                );
                echo json_encode($output);
            }
            else 
            {
                // Get answer about code from airtel api
                $response = $this->{$pay_method.'code'}->code_response_wsearch($pay_code, TRUE);
                
                
                if($response['price'] >= $this->config->item($pay_method, 'unban_price'))
                {
                    
                    // Remove ban
                    $this->mcbans_model->del_ban($this->input->post('username'));
                    
                    // Activate {pay_method} code
                    $this->{$pay_method.'code'}->code_response_wsearch($pay_code, $this->module->testing);
                    
                    // Output message
                    $output = array(
                        'type' => 'success',
                        'text' => 'Paldies, Jūsu bans tika noņemts!',
                    );
                    echo json_encode($output);
                    
                }
                elseif($response['answer'] == 'code_not_found')
                {
                    
                    // Output message
                    $output = array(
                        'type' => 'error',
                        'text' => 'Ir ievadīts neeksistējošs "'.$pay_method.'" kods!',
                    );
                    echo json_encode($output);
                    
                }
                else
                {
                    
                    // Output message
                    $output = array(
                        'type' => 'error',
                        'text' => 'Ir ievadīts nepareizas vērtības "'.$pay_method.'" kods!',
                    );
                    echo json_encode($output);
                    
                }  
            }
        }    
    }

    
}