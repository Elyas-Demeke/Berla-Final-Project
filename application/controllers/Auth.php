<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_auth');
    
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{

		$this->logged_in();

		$this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $this->session->set_flashdata('errors','Form validation is true');
           	$email_exists = $this->model_auth->check_phone($this->input->post('phone'));

           	if($email_exists == true) {
           		$login = $this->model_auth->login($this->input->post('phone'), $this->input->post('password'));

           		if($login) {
      					if($login != -1){
                  $login += array('logged_in'=>TRUE);
        					$this->session->set_userdata($login);

             			redirect('dashboard', 'refresh');
                }
                else{
                  $this->session->set_flashdata('errors' , 'Account is Deactivated');
                  redirect('Auth/login', 'refresh');
                }
           		}
           		else {
           			$this->session->set_flashdata('errors' , 'Phone exists but password is incorrect');
           			redirect('Auth/login', 'refresh');
           		}
           	}
           	else 
           	{
           		
           		$this->session->set_flashdata('errors' , 'Phone does not exist');
           		redirect('Auth/login', 'refresh');

           	}	
        }
        else {
            // false case
            // set an empty error message
            //$this->session->set_flashdata('errors','Login page loaded');
            $this->load->view('login');
        }	
	}

	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Auth/login', 'refresh');
	}

}
