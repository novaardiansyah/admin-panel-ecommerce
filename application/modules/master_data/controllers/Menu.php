<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Menu', 'model');
  }

  public function index()
  {
    isLogin();
    
    $data = [
      'title'      => 'Management Menu',
      'breadcrumb' => [
        'Home'        => base_url(''),
        'Master Data' => base_url('master-data/menu'),
        'Menu'        => ''
      ],
      'script' => [
        base_url('assets/js/master-data/Menu.js' . versionAssets())
      ]
    ];

    backend('menu/List', $data);
  }

  public function list_menu()
  {
    $req = $this->model->list_menu();
    echo json_encode($req);
  }
}
