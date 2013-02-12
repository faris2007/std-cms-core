<?php

/**
 * this class for add,edit and remove from email table
 * 
 * @author Faris Al-Otaibi
 */
class email extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        if($this->users->isAdmin()){
        $this->load->library('peeker');

        $config['login']='sales@std-hosting.com';
        $config['pass']='shc@1434';
        $config['host']='server1.std-hosting.com';
        $config['port']='995';
        $config['service_flags'] = '/pop3/ssl/novalidate-cert';

        $this->peeker->initialize($config);
        if ($this->peeker->message_waiting())
        {
            echo 'Message count:' . $this->peeker->get_message_count();
        }
        else
        {
            echo 'No messages waiting.';
        }
        $email_array = $this->peeker->get_message(1,5);
        print_r($email_array);exit;

        $this->peeker->close();

        // now tell us the story of the connection
        print_r($this->peeker->trace()); 
        }else
            redirect (STD_CMS_ERROR_PAGE);
    }
}

?>
