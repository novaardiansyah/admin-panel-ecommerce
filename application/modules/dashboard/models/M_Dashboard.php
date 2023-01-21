<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Dashboard extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  function getMenu()
  {
    return requestApi('menus', 'GET');
  }
}
