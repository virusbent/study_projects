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
                                admin.a_role   = role[0].r_name;
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

    function handleAdminToServer(admin){
        console.log('admin -> ', admin);
        console.log('Service - handleAdminToServer: ', admin);
        return $.ajax({
            method      : 'POST',
            url         : '/saveAdmin/',
            contentType : false,
            data        : admin,
            processData : false
        })
            .then(function (response) {
                console.log('*handleAdminToServer* - Promise response: ', response);
                if(response != false)
                    return response;
                else
                    throw new Error(response);
            })
            .catch(function (err) {
                throw new Error(err);
            });
    }


    window.getAllAdmins         = getAllAdmins;
    window.getAdminRole         = getAdminRole;
    window.handleAdminToServer  = handleAdminToServer;

})();