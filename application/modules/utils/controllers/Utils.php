<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Utils extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Utils', 'model');
  }

  public function store_server_log()
  {
    $log           = getReqBody('log', [], $_POST);
    $access_token  = getReqBody('access_token', '', $_POST);
    $refresh_token = getReqBody('refresh_token', '', $_POST);
    
    $log = json_decode($log);

    $send = [
      'log_ip_address' => $log->ip_address,
      'log_user_agent' => $log->user_agent,
      'log_platform'   => $log->platform,
      'log_data'       => $log->data_log,
      'access_token'   => $access_token,
      'refresh_token'  => $refresh_token
    ];

    $req = requestApi('users/store_server_log', 'POST', $send);
    echo json_encode($req); exit;
  }
}
