<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Menu', 'model');
  }

  public function index()
  {
    $data = [
      'pageTitle' => 'Menu',
      'script' => [
        // base_url('assets/js/menu/Menu.js' . versionAssets())
      ]
    ];
    $this->load->view('menu/Menu', $data);
  }

  public function onStore()
  {
    $req = $this->model->onStore($_POST);
    echo json_encode($req); exit;
  }
}