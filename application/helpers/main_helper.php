<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

function getAppName($type = 'long')
{
  $ci = get_instance();

  if ($type == 'long') {
    return env('APP_NAME_LONG', 'My Application');
  }

  return env('APP_NAME_SHORT', 'My App');
}

function userAgent()
{
  $ci = get_instance();

  $ci->load->library('user_agent');

  $data = [
    'user_agent'      => $ci->agent->agent_string(),
    'ip_address'      => $ci->input->ip_address(),
    'browser'         => $ci->agent->browser(),
    'browser_version' => $ci->agent->version(),
    'platform'        => $ci->agent->platform(),
    'mobile'          => $ci->agent->mobile(),
    'robot'           => $ci->agent->robot(),
    'referrer'        => $ci->agent->referrer()
  ];

  return arrayToObject($data);
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

  $ci = get_instance();

  return $_ENV['API_PATH'] . $path;
}

function adminlte_url($path = '')
{
  $ci  = get_instance();
  $url = base_url('vendor/almasaeed2010/adminlte/');
  return $url . $path;
}

function env($key, $default = '')
{
  $dotenv = Dotenv::createImmutable(dirname(__FILE__, 3));
  $dotenv->load();

  return $_ENV[$key] ?: $default;
}

function setSession($data = [])
{
  $ci = get_instance();
  foreach ($data as $key => $value) {
    $key = env('PREFIX_SESSION') . $key;
    $ci->session->set_userdata($key, $value);
  }
}

function getSession($key)
{
  $ci  = get_instance();
  $key = env('PREFIX_SESSION') . $key;
  return $ci->session->userdata($key);
}

function destroySession($data = [])
{
  $ci = get_instance();
  foreach ($data as $key) {
    $key = env('PREFIX_SESSION') . $key;
    $ci->session->unset_userdata($key);
  }
}

function requestApi($url, $method = 'POST', $data = [], $contentType = 'form-urlencoded')
{
  $url = api_url($url);

  $send = [
    'access_token'  => getSession('log_access_token'),
    'refresh_token' => getSession('log_refresh_token')
  ];

  $data = array_merge($data, $send);

  if ($method == 'GET') {
    $url = $url . '?' . http_build_query($data);
  }

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
  $response = json_decode($response);
  $response = arrayToObject($response);

  curl_close($curl);

  if ((isset($response->status_code) && $response->status_code == 401)) return isLogin(false);
  return $response;
}

function arrayToObject($array)
{
  if (!is_array($array)) {
    return $array;
  }

  $object = new stdClass();
  if (is_array($array) && count($array) > 0) {
    foreach ($array as $name => $value) {
      $name = trim($name);
      if (!empty($name)) {
        $object->$name = arrayToObject($value);
      }
    }
    return $object;
  } else {
    return FALSE;
  }
}

function cleanInput($input)
{
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );

  $output = preg_replace($search, '', $input);
  return $output;
}

function getReqBody($key = 'key', $default = null, $data = [])
{
  $ci = get_instance();

  $res = $default;

  if (isset($data[$key])) {
    $res = $data[$key];
  } else if (isset($_POST[$key])) {
    $res = $_POST[$key];
  } else if (isset($_GET[$key])) {
    $res = $_GET[$key];
  }

  // * if $res == string
  if (is_string($res)) {
    $res = cleanInput($res);
    $res = trim($res);
  }

  return $res;
}

function backend($view, $data)
{
  $ci = get_instance();

  $data['pageTitle'] = isset($data['pageTitle']) ? $data['pageTitle'] : $data['title'];

  $data = array_merge($data, [
    'content' => $view
  ]);

  $ci->load->view('Main', $data);
}

function encode($value)
{
  if (!$value) return false;

  $ci = get_instance();

  $key       = sha1(env('ENCODED_KEY'));
  $strLen    = strlen($value);
  $keyLen    = strlen($key);
  $j         = 0;
  $crypttext = '';

  for ($i = 0; $i < $strLen; $i++) {
    $ordStr = ord(substr($value, $i, 1));
    if ($j == $keyLen) {
      $j = 0;
    }
    $ordKey = ord(substr($key, $j, 1));
    $j++;
    $crypttext .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
  }

  return base64_encode($crypttext);
}

function decode($value)
{
  if (!$value) return false;

  $ci = get_instance();

  $value       = base64_decode($value);
  $key         = sha1(env('ENCODED_KEY'));
  $strLen      = strlen($value);
  $keyLen      = strlen($key);
  $j           = 0;
  $decrypttext = '';

  for ($i = 0; $i < $strLen; $i += 2) {
    $ordStr = hexdec(base_convert(strrev(substr($value, $i, 2)), 36, 16));
    if ($j == $keyLen) {
      $j = 0;
    }
    $ordKey = ord(substr($key, $j, 1));
    $j++;
    $decrypttext .= chr($ordStr - $ordKey);
  }

  return $decrypttext;
}

function isLogin($status = true)
{
  $ci = get_instance();

  $session_log = [
    'log_userId'        => getSession('log_userId'),
    'log_username'      => getSession('log_username'),
    'log_name'          => getSession('log_name'),
    'log_email'         => getSession('log_email'),
    'log_phone'         => getSession('log_phone'),
    'log_address'       => getSession('log_address'),
    'log_roleId'        => getSession('log_roleId'),
    'log_companyId'     => getSession('log_companyId'),
    'log_access_token'  => getSession('log_access_token'),
    'log_refresh_token' => getSession('log_refresh_token')
  ];
  $session_log = json_decode(json_encode($session_log));

  if ($status == false || $session_log->log_access_token == null || $session_log->log_refresh_token == null) {
    destroySession($session_log);
    $ci->session->sess_destroy();

    $name     = 'name=' . encode($session_log->log_name);
    $username = 'username=' . encode($session_log->log_username);

    $url = base_url('auth/session-expired?' . $name . '&' . $username);
    return header('Location: ' . $url);
  }
}

function textCapitalize($text)
{
  $text = ucwords(strtolower($text));
  return trim($text);
}

function textLowercase($text)
{
  $text = strtolower($text);
  return trim($text);
}

function textUppercase($text)
{
  $text = strtoupper($text);
  return trim($text);
}