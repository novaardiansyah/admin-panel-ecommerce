<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dotenv\Dotenv;

function getTimes($data = 'now', $format = 'Y-m-d H:i:s')
{
  date_default_timezone_set('Asia/Jakarta');
  return date($format, strtotime($data));
}

function format_date($data, $format = 'Y-m-d H:i:s')
{
  date_default_timezone_set('Asia/Jakarta');

  if (strpos($data, '/') !== false) {
    $data = str_replace('/', '-', $data);
  }

  return date_format(date_create($data), $format);
}

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
  $dotenv = Dotenv::createImmutable(dirname(__FILE__, 3));
  $dotenv->load();
  
  $ci  = get_instance();
  $url = $ci->config->item('api_url');

  return $url . $_ENV['API_PATH']. $path;
}

function adminlte_url($path = '')
{
  $ci  = get_instance();
  $url = base_url('vendor/almasaeed2010/adminlte/');
  return $url . $path;
}

function requestApi($url, $method = 'POST', $data = [], $contentType = 'form-urlencoded')
{
  $ci = get_instance();
  
  $url = api_url($url);

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

  if ($method == 'POST' || $method == 'PUT' || $method == 'DELETE' || $method == 'PATCH') {
    $params[CURLOPT_POSTFIELDS] = $data;

    if ($contentType == 'form-data') {
      $params[CURLOPT_HTTPHEADER] = [
        "Content-Type: multipart/form-data",
        "cache-control: no-cache"
      ];
    } else if ($contentType == 'form-urlencoded') {
      $params[CURLOPT_HTTPHEADER] = [
        "Content-Type: application/x-www-form-urlencoded",
        "cache-control: no-cache"
      ];

      $params[CURLOPT_POSTFIELDS] = http_build_query($data);
    } else {
      $params[CURLOPT_HTTPHEADER] = [
        "Content-Type: application/json",
        "cache-control: no-cache"
      ];
    }
  }

  curl_setopt_array($curl, $params);

  $error = curl_error($curl);
  
  if ($error) {
    curl_close($curl);
    return ['status' => false, 'status_code' => 500, 'message' => $error];
  }
  
  $response = curl_exec($curl);
  $response = json_decode($response, FALSE);

  curl_close($curl);

  return $response;
}