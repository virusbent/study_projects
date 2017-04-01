/**
 * Created by evgeniy on 01/04/17.
 */
'use strict';

(function () {

    function login(event) {
        event.preventDefault();

        var credentials = {
            email       : $("#inputEmail").val(),
            password    : $("#inputPassword").val()
        };

        console.log(email, password);

        $.ajax({
            type      : 'POST',
            url       : '/loginAction',
            data      : credentials
        }).then(function (user) {
            console.log('LOGGING IN');
        }).catch(function (err) {
            alert(err);
        })

    }




    window.login = login;

})();