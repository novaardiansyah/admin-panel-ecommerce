<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function versionAssets($version = 1)
{
  $domain = explode(':', $_SERVER['HTTP_HOST'])[0];

  if ($domain == 'localhost') {
    return '?v=' . getTimes('now', 'YmdHis');
  }

  if ($version == 2) return '?v=' . getTimes('now', 'YmdH');
  
  return '?v=' . getTimes('now', 'Ymd');
}

function api_url($path = '')
{
  $ci = get_instance();
  $url = $ci->config->item('api_url');

  return $url . '/' . $path;
}

function requestApi($url, $method, $data = [])
{
  $ci = get_instance();

  $send = [];
  $data = array_merge($data, $send);
  
  $curl = curl_init();

  $params = [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING       => '',
    CURLOPT_MAXREDIRS      => 10,
    CURLOPT_TIMEOUT        => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST  => $method
  ];

  if ($method == 'POST') {
    $params[CURLOPT_POSTFIELDS] = $data;
  }

  curl_setopt_array($curl, $params);

  $response = curl_exec($curl);
  $response = json_decode($response, FALSE);

  curl_close($curl);

  return $response;
}