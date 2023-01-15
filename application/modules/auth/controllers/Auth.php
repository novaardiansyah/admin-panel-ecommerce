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
      'pageTitle' => 'Admin Panel - Login',
      'script' => [
        base_url('assets/js/auth/Login.js' . versionAssets())
      ]
    ];
    $this->load->view('auth/Login', $data);
  }

  public function on_login()
  {
    $rules = [
      ['field' => 'username', 'label' => 'Username', 'rules' => 'trim|required|max_length[30]'],
      ['field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|max_length[20]']
    ];

    $validate = $this->form_validation->set_rules($rules);

    if ($validate->run() == FALSE) {
      echo json_encode([ 'status' => false, 'status_code' => 'invalid-form', 'data' => NULL, 'error' => $validate->error_array() ]); exit;
    }

    $send = [
      'username'     => getReqBody('username', ''),
      'password'     => getReqBody('password', ''),
      'clientId'     => env('CLIENT_ID'),
      'clientSecret' => env('CLIENT_SECRET')
    ];

    $req = requestApi('users/login', 'POST', $send);

    if ($req->status && $req->status_code == 200)
    {
      $data  = $req->data;
      $token = $data->token;

      $session_log = [
        'log_userId'        => $data->id,
        'log_username'      => $data->username,
        'log_name'          => $data->name,
        'log_email'         => $data->email,
        'log_phone'         => $data->phone,
        'log_address'       => $data->address,
        'log_roleId'        => $data->roleId,
        'log_companyId'     => $data->companyId,
        'log_access_token'  => $token->access_token,
        'log_refresh_token' => $token->refresh_token
      ];

      setSession($session_log);
    }

    echo json_encode($req); exit;
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