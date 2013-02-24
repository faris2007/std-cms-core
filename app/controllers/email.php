<?php

/**
 * this class for add,edit and remove from email table
 * 
 * @author Faris Al-Otaibi
 */
class email extends CI_Controller {
    
    private $_error_page = "email/error";


    public function __construct() {
        parent::__construct();
        
        $this->load->model('emails');

        $config['login']= $this->core->getSettingByName('email_username');
        $config['pass']= $this->core->getSettingByName('email_password');//'c5h6Xw0)KQD,';
        $config['host']= $this->core->getSettingByName('email_server'); //'server1.std-hosting.com';
        $config['port']= $this->core->getSettingByName('email_port');
        $config['service_flags'] = '/pop3/ssl/novalidate-cert';

        $this->emails->initialize($config);
    }
    
    public function index(){
        if($this->core->checkPermissions('email','all','all')){
            $this->show();
        }else
            redirect (STD_CMS_PERMISSION_PAGE);
    }
    
    public function show(){
        if($this->core->checkPermissions('email','show','all')){
            $segments = $this->uri->segment_array();
            $mailBox = isset($segments[3])? $segments[3]:NULL;
            if(!is_null($mailBox) && $mailBox == "sent")
                $this->emails->changeMailBox("Sent Items");
            $this->emails->open();
            if(!$this->emails->isConnected())
                redirect($this->_error_page);
            
            $data['STEP'] = 'show';
            $data['EAMILS'] = $this->emails->get_messages();
            $this->emails->close();
            $data['CONTENT'] = 'email';
            $data['TITLE'] = "-- إدارة الرسائل";
            $this->core->load_template($data);
        }else
            redirect (STD_CMS_PERMISSION_PAGE);
    }
    
    public function getattach(){
        if($this->core->checkPermissions('email','show','all')){
            $segments = $this->uri->segment_array();
            $msgId = isset($segments[3])? $segments[3]:NULL;
            $attachNo = isset($segments[4])? $segments[4]:NULL;
            if(is_null($msgId) || is_null($attachNo))
                redirect(STD_CMS_ERROR_PAGE);
            else
            {
                $this->emails->open();
                if(!$this->emails->isConnected())
                    redirect($this->_error_page);
                $data = $this->emails->getAttachment($msgId,$attachNo);
                if(!is_array($data))
                    redirect(STD_CMS_ERROR_PAGE);
                $ext = explode(".", $data['filename']);
                $this->emails->close();
                $this->output->set_content_type($ext[count($ext)-1])->set_output($data['data']);
            }
        }else
            redirect (STD_CMS_PERMISSION_PAGE);
    }
    
    public function error(){
        if($this->core->checkPermissions('email','all','all')){
            $data['TITLE'] = "-- إدارة الرسائل";
            $data['STEP'] = "error";
            $data['CONTENT'] = 'email';
            $this->core->load_template($data);
        }else
            redirect (STD_CMS_PERMISSION_PAGE);
    }

    public function view(){
        if($this->core->checkPermissions('email','show','all')){
            $segments = $this->uri->segment_array();
            $msgId = isset($segments[3])? $segments[3]:NULL;
            $this->emails->open();
            if(!$this->emails->isConnected())
                redirect($this->_error_page);
            $messageInfo = $this->emails->get_message($msgId);
            if(!$messageInfo)
                redirect(STD_CMS_ERROR_PAGE);
            $this->emails->close();
            $data['MSG_SUBJECT'] = $messageInfo['header']->subject;
            $data['MSG_FROM'] = $messageInfo['header']->fromaddress;
            $data['MSG_DATE'] = $messageInfo['header']->date;
            $data['MSG_TO'] = $messageInfo['header']->toaddress;
            $data['MSG_BODY'] = nl2br($messageInfo['body']['PLAIN']);
            $data['MSG_ID'] = $messageInfo['header']->Msgno;
            $data['attach'] = $messageInfo['body']['attachment'];
            $data['TITLE'] = "-- إدارة الرسائل -- ".$messageInfo['header']->subject;
            $data['STEP'] = "view";
            $data['CONTENT'] = 'email';
            $this->core->load_template($data);
        }else
            redirect (STD_CMS_PERMISSION_PAGE);
    }
    
    public function send(){
        if($this->core->checkPermissions('email','send','all')){
            $segments = $this->uri->segment_array();
            $type = isset($segments[3])? $segments[3]:NULL;
            $msgId = isset($segments[4])? $segments[4]:NULL;
            if(!is_null($type)){
                $this->emails->open();
                if(!$this->emails->isConnected())
                    redirect($this->_error_page);
                $messageInfo = $this->emails->get_message($msgId);
                if(!$messageInfo)
                    redirect(STD_CMS_ERROR_PAGE);
                $this->emails->close();
            }
            $data['MAILSUBJECT'] = "";
            $data['MAILTO'] = "";
            $data['MAILBODY'] = "";
            if($_POST){
                $subject = $this->input->post('subject',true);
                $to = $this->input->post('to',true);
                $message = $this->input->post('message');
                if($this->emails->send_message($to,$subject,$message)){
                    $data['CONTENT'] = 'msg';
                    $data['TITLE'] = "-- إدارة الرسائل";
                    $url = base_url().'email';
                    $data['MSG'] = 'تم حفظ البيانات بشكل صحيح <br />'.  anchor($url, "للعودة للإدارة الرسائل أضغط هنا");
                }else{
                    $data['CONTENT'] = "email";                                     
                    $data['STEP'] = 'send';
                    $data['ERROR'] = true;
                    $data['ERR_MSG'] = 'حدثت مشكلة اثناء عملية الارسال';
                }
            }else{
                $data['STEP'] = "send";
                $data['CONTENT'] = 'email';
                $data['ERROR'] = false;
                $data['ERR_MSG'] = '';
                if(!is_null($type)){
                    $data['MAILSUBJECT'] = ($type == 'replay')? "RE:".$messageInfo['header']->subject:"FW:".$messageInfo['header']->subject;
                    $data['MAILTO'] = ($type == 'replay')? $messageInfo['header']->from[0]->mailbox."@".$messageInfo['header']->from[0]->host:"";
                    $data['MAILBODY'] = ($type == 'replay')? "<br />---------- Replay ----------<br />".nl2br($messageInfo['body']['PLAIN']):"<br />---------- Forward ----------<br />".nl2br($messageInfo['body']['PLAIN']);
                }
            }
            $data['TITLE'] = "-- إدارة الرسائل -- أرسال رسالة جديدة";
            $this->core->load_template($data);
        }else
            redirect (STD_CMS_PERMISSION_PAGE);
    }
}

?>
