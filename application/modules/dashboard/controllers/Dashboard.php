<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Dashboard', 'model');
  }

  public function index()
  {
    isLogin();
    
    $data = [
      'title'      => 'Dashboard',
      'breadcrumb' => [
        'Home'      => base_url('dashboard'),
        'Dashboard' => ''
      ],
      'menus' => $this->model->getMenu(),
      'script' => [
        base_url('assets/js/dashboard/Dashboard.js' . versionAssets())
      ]
    ];

    backend('dashboard/Dashboard', $data);
  }
}
