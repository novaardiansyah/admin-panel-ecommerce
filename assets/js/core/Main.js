moment.locale('id');

let autohideInvalid = $('.autohide-invalid');

if (autohideInvalid.length > 0) {
  autohideInvalid.on('focus blur click', function() {
    let key = $(this).attr('name')
    $(`.invalid-feedback.${key}`).html('Something went wrong.').hide()
  })
}

function base_url(path = '')
{
  return config.base_url + path;
}

function adminlte_url(path = '')
{
  return config.adminlte_url + path;
}

function redirect(path = '', fullpath = false)
{
  if (fullpath == true) {
    return window.location.href = path;
  }

  return window.location.href = base_url(path);
}

function log_server_error(url, error)
{
  let entryAt = moment().format()

  // * Retrieve data from local storage
  let data = localStorage.getItem(url);

  // * If data doesn't exist, create new data
  if (data == null) {
    localStorage.setItem(url, JSON.stringify([{ error: error, entryAt: entryAt }]));
  } else {
    // * If data exists, merge new data with old data
    let newData = JSON.parse(data);
    newData.push({ error: error, entryAt: entryAt });
    localStorage.setItem(url, JSON.stringify(newData));
  }

  // * Return data from local storage
  return localStorage.getItem(url)
}