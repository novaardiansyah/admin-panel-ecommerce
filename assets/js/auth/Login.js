$(document).ready(function() {
  
})

function onLogin(event)
{
  event.preventDefault();
  let form     = $('#U9Q-Login-Form')
  let formData = new FormData(form[0])
  let url      = base_url('auth/on-login')

  $.ajax({
    url: url,
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    dataType: 'json',
    beforeSend: function() {
      form.find('.invalid-feedback').html('Something went wrong.').hide()
    },
    success: function(response) {
      if (response.status == true && response.status_code == 200)
      {
        return redirect('dashboard');
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