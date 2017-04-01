/**
 * Created by evgeniy on 31/03/17.
 */
'use strict';
(function () {
    function getAllAdmins() {
        return new Promise(function (fulfill, reject) {
            $.ajax({
                type    : 'GET',
                url     : '/getAllAdmins',
                dataType: 'JSON'
            })
                .then(function (response) {
                    Promise.each(response, function (admin) {
                        return getAdminRole(admin.a_role)
                            .then(function (role) {
                                admin.a_role   = role;
                            });
                    })
                        .then(function (modifiedAdmins) {
                            console.log('modified admins: ', modifiedAdmins);
                            fulfill(modifiedAdmins);
                        })
                })
                .catch(function (err) {
                    console.log('getAllAdmins - Error: ', err);
                    reject(err);
                })

        })
    }

    function getAdminRole(role_id) {
        return new Promise(function (fulfill, reject) {
            $.ajax({
                type: 'GET',
                url: '/getAdminRole/' + role_id,
                dataTpe: 'JSON'
            })
                .then(function (response) {
                    fulfill(response);
                })
                .catch(function (err) {
                    console.log('getAdminRole - Error: ', err);
                    reject(err);
                })
        });
    }

    function createAdmin(admin){
        console.log('creating admin -> ', admin);
        return $.ajax({
            type      : 'POST',
            url         : '/createAdmin',
            /*contentType : 'application/x-www-form-urlencoded',*/
            data        : admin
            /*processData : false*/
        })
            .then(function (response) {
                console.log('*createAdmin* - Promise response: ', response);
                if(response != false)
                    return response;
                else if(response == "password_missmatch")
                    alert("Re-Type the Passwords!");
                else
                    throw new Error(response);
            })
            .catch(function (err) {
                throw new Error(err);
            });
    }

    function updateAdmin(admin){
        console.log('updating admin -> ', admin);
        return $.ajax({
            type      : 'POST',
            url         : '/updateAdmin',
            data        : admin
        })
            .then(function (response) {
                console.log('*updateAdmin* - Promise response: ', response);
                if(response != false)
                    return response;
                else
                    throw new Error(response);
            })
            .catch(function (err) {
                throw new Error(err);
            });
    }


    window.getAllAdmins = getAllAdmins;
    window.getAdminRole = getAdminRole;
    window.createAdmin  = createAdmin;
    window.updateAdmin  = updateAdmin;

})();