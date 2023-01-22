function onLockScreen(event)
{
  event.preventDefault();
  let form     = $('#lockscreen-form');
  let url      = form.attr('action');
  let method   = form.attr('method');
  let formData = new FormData(form[0]);

  let urlQuery = new URLSearchParams(window.location.search);
  let username = urlQuery.get('username');
  formData.append('username', username);

  $.ajax({
    url: url,
    type: method,
    data: formData,
    dataType: 'json',
    processData: false,
    contentType: false,
    beforeSend: function() {
      form.find('.invalid-feedback').html('Something went wrong.').hide()
    },
    success: function(response) {
      if (response.status == true && response.status_code == 200)
      {
        let token = response.data.token;
        return onStoreServerLog({ callback: () => redirect('dashboard'), access_token: token.access_token, refresh_token: token.refresh_token })
      }

      if (response.status == false && response.status_code == 'invalid-form') {
        let errors = response.error;

        Object.keys(errors).forEach(function(key) {
          let error = errors[key]
          form.find(`.invalid-feedback.${key}`).html(error).show()
        })

        return console.log('Validation failed', response);
      }
      
      if (response.status == false && response.status_code == 400) {
        return console.log('Login failed', response);
      }

      log_server_error(url, response)
      return console.log('Internal server error-1: ', response);
    },
    error: function(response) {
      log_server_error(url, response)
      console.log('Internal server error-2: ', response);
    }
  });
}

if (hasSession == false) {
  let countdown = $('#countdown');
  let seconds   = 5;

  let interval = setInterval(function() {
    seconds--;
    countdown.html(seconds);
    if (seconds == 0) {
      clearInterval(interval);
      redirect('auth/login');
    }
  }, 1000);
}