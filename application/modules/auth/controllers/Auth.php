<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('auth/M_Auth', 'model');
  }

  public function index() 
  {
    redirect('auth/login');
  }

  public function login()
  {
    $data = [
      'page'      => 'login',
      'pageTitle' => 'Admin Panel - Login'
    ];
    $this->load->view('auth/Login', $data);
  }

  public function register()
  {
    $data = [
      'page'      => 'register',
      'pageTitle' => 'Admin Panel - Register'
    ];
    $this->load->view('auth/Register', $data);
  }

  public function forgot_password()
  {
    $data = [
      'page'      => 'login',
      'pageTitle' => 'Admin Panel - ForgotPassword'
    ];
    $this->load->view('auth/ForgotPassword', $data);
  }
}