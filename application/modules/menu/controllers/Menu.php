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
    $menu = requestApi('menus', 'POST', []);

    if ($menu->status == false && isset($menu->error) && $menu->error == 'refresh_token') {
      $menu = requestApi([
        'url'    => $menu->response->url,
        'method' => $menu->response->method,
        'data'   => $menu->response->data
      ]);
    }

    echo json_encode($menu); exit;
  }

  public function onStore()
  {
    $req = $this->model->onStore($_POST);
    echo json_encode($req); exit;
  }
}