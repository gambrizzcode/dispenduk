<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
	function sendMail() {
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "abalabalsayang@gmail.com";
        $config['smtp_pass'] = "dubidareka13%";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        
        $ci->email->initialize($config);
 
        $ci->email->from('abalabalsayang@gmail.com', 'Syaikhu Rizal');
        $list = array('permanen29@gmail.com');
        $ci->email->to($list);
        $ci->email->subject('Judul Percobaan');
        $ci->email->message('Jangan dibaca');
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }
}
