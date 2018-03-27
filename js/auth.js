'use strict';

function authentication() {
    $('#authentication-send').off('click').click(validateLogin);
    $("#authentication").show();
}

function validateLogin(event) {
    var login, password, text, xhr;

    event.preventDefault();

    login = $('#login').val();
    password = $('#password').val();
    $('#errors').html('');

    /*if (login == '' || password == '') {
        text = '<div id="errors" class="alert alert-danger" role="alert">';
        text += '<span class="glyphicon glyphicon-exclamation-sign"'
        text += ' aria-hidden="true"></span>';
        text += '<strong> L\'un des champs est vide.</strong></div>';
        $('#errors').html(text);
    } else {*/
    Cookies.set('login', login);

    xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/request.php/authenticate', true);
    xhr.setRequestHeader('Authorization', 'Basic ' + btoa(login + ':' + password));

    xhr.onload = function () {
        switch (xhr.status) {
            case 200:
                Cookies.set('token', xhr.responseText);
                $("#authentication").hide();
                $('#infos').html('Authentification OK');
                break;
            default:
                httpErrors(xhr.status);
        }
    };

    xhr.send();
    //}
}

ajaxRequest('GET', 'php/request.php/photos/', () => { });
