$(function () {
  // Quando il modulo viene inviato (submit)
  $("#login-form").on("submit", function (event) {
    // Previeni il comportamento predefinito del modulo (invio del modulo)
    event.preventDefault();
    $("#auth-error").css('visibility', 'hidden');


    // Ottieni i valori dei campi VID e password
    var vid = $("#username").val().trim();
    var password = $("#password").val().trim();
    var error = false;
    if (!vid.length) {
        $("#vid-error").css('visibility', 'visible')
        error = true;
    } else {
        $("#vid-error").css('visibility', 'hidden')
    }

    if (!password.length) {
        $("#password-error").css('visibility', 'visible')
        error = true;
    } else {
        $("#password-error").css('visibility', 'hidden')
    }


    if (error) {
        return;
    }

      $.ajax({
        type: "POST", 
        url: "json", 
        data: { "type": "login", "action": "login", vid, password },
        success: function(response) {
          if('error' in response) {
            $("#auth-error").css('visibility', 'visible')
          } else {
            window.location.href='/';
          }

        },
        error: function(error) {
          console.error("Errore nella chiamata AJAX: " + JSON.stringify(error));
        }
      });
  });
});
