moment.locale('id');

let autohideInvalid = $('.autohide-invalid');

if (autohideInvalid.length > 0) {
  autohideInvalid.on('focus blur click', function () {
    let key = $(this).attr('name')
    $(`.invalid-feedback.${key}`).html('Something went wrong.').hide()
  })
}

function base_url(path = '') {
  return config.base_url + path;
}

function adminlte_url(path = '') {
  return config.adminlte_url + path;
}

function redirect(path = '', fullpath = false) {
  if (fullpath == true) {
    return window.location.href = path;
  }

  return window.location.href = base_url(path);
}

function log_server_error(url, error) {
  let entryAt = moment().format()
  let key = 'server-error';

  // * Retrieve data from local storage
  let data = localStorage.getItem(key);

  // * If data doesn't exist, create new data
  if (data == null) {
    data = {
      ip_address: userAgent.ip_address,
      user_agent: userAgent.user_agent,
      platform: userAgent.platform,
      data_log: [
        { url: url, error: error, entryAt: entryAt }
      ]
    }
    localStorage.setItem(key, JSON.stringify(data));
  } else {
    // * If data exists, merge new data with old data
    let newData = JSON.parse(data);
    // * Add new data to the array
    newData.data_log.push({ url: url, error: error, entryAt: entryAt });
    localStorage.setItem(key, JSON.stringify(newData));
  }

  // * Return data from local storage
  return localStorage.getItem(key)
}

// * onStoreServerLog({ callback: () => redirect('dashboard') })
function onStoreServerLog({ callback, access_token = null, refresh_token = null }) 
{
  let key = 'server-error';
  let log = localStorage.getItem(key);

  if (log == null) return callback();
  if (access_token == null || refresh_token == null) return callback();

  let url = base_url('utils/store-server-log');

  $.ajax({
    url: url,
    type: 'POST',
    data: { log: log, access_token: access_token, refresh_token: refresh_token },
    dataType: 'json',
    success: function(response) {
      if (response.status == true && response.status_code == 200) {
        localStorage.removeItem(key);
      }
      
      console.log('Server log stored', response);
      return callback();
    }
  })
}