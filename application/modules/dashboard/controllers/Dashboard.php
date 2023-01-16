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
    $data = [
      'pageTitle' => 'Dashboard',
      'script' => [
        base_url('assets/js/dashboard/Dashboard.js' . versionAssets())
      ]
    ];
    $this->load->view('dashboard/Dashboard', $data);
  }
}
