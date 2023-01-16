<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Menu extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function onStore($data)
  {
    $send = [
      'name'      => getReqBody('name', '', $data),
      'url'       => getReqBody('url', '', $data),
      'icon'      => getReqBody('icon', '', $data),
      'isParent'  => getReqBody('isParent', 0, $data),
      'isActive'  => getReqBody('isActive', 1, $data),
      'isDeleted' => getReqBody('isDeleted', 0, $data),
      'createdBy' => getReqBody('createdBy', 1, $data)
    ];
    
    return requestApi('menus', 'POST', $send);
  }
}