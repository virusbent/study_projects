/**
 * Created by evgeniy on 31/03/17.
 */
'use strict';

// actual var for saving students from server
var allAdmins;


$(document).ready(function () {

    /* show count of all students and courses */
    $('#admin-count').show();

    /* get all administrators and populate the list with them */
    getAllAdmins().then(function (admins) {
        // set to global var of students
        allAdmins = admins;
        // push the data to the list of students on the view
        populateAdminList(admins);
        $("#admin-count").text(allAdmins.length);
    });

    /* EVENTS */

    $("#add-admin").on("click", function (event) {
        addNewAdmin();
    });


    function addNewAdmin() {
        $("#count").hide();
        $("#details-admin").addClass("hidden");
        // show new admin form
        $("#add-new-admin").removeClass("hidden");

        /* Empty inputs */
        $("#db-admin-id").text("");
        $("#new-admin-name").val("");
        $("#new-admin-phone").val("");
        $("#new-admin-email").val("");
        $("#new-admin-role").val("");
        $('#new-admin-pass').attr('placeholder', "Password");
        $('#new-admin-pass-confirm').attr('placeholder', "Confirm Password");
    }


    /* Show Admin in the right view */
    function showAdminDetails(target_id) {
        $("#count").hide();
        $("#add-new-admin").addClass("hidden");
        // show admin details form
        $("#details-admin").removeClass("hidden");

        var admin = findAdminByID(target_id);

        fillAdminDetails(admin, "show");

    }

    function editAdmin() {
        var admin_id = $("#admin-id").text();
        var admin    = findAdminByID(admin_id);

        fillAdminDetails(admin, "edit");
    }

    function closeView(view) {
        if(view === 'details'){
            $("#details-admin").addClass("hidden");
            $("#count").show();
        }
        else if (view === 'new'){
            $("#add-new-admin").addClass("hidden");
            $("#count").show();
        }
        else if(view === 'reset'){
            $("#details-admin").addClass("hidden");
            $("#add-new-admin").addClass("hidden");
            $("#count").show();
        }
    }


    /* INNER METHODS */


    function findAdminByID(id) {
        var found = '';
        allAdmins.map(function (admin) {
            if (admin.a_ID == id)
                found = admin;
        });

        return found;
    }

    function fillAdminDetails(data, type) {
        /* Selectors */
        var id       = '';
        var name     = '';
        var phone    = '';
        var email    = '';
        var role     = '';
        var pass     = '';
        var pass2    = '';
        var suffix   = 'none';  // default

        if(type === "show"){
            id       = $("#admin-id");
            name     = $("#admin-name");
            phone    = $("#admin-phone");
            email    = $("#admin-email");
            role     = $("#admin-role");

            id.text(data.a_ID);
            name.text(data.a_name);
            phone.text(data.a_phone);
            email.text(data.a_email);
        }
        else if(type === "edit"){
            $("#count").hide();
            $("#details-admin").addClass("hidden");
            // show new admin form
            $("#add-new-admin").removeClass("hidden");

            if(!isOwner())
                $("#new-admin-role").disable();

            $('#new-admin-pass').attr('placeholder', "Old Password");
            $('#new-admin-pass-confirm').attr('placeholder', "New Password");

            id       = $("#db-admin-id");
            name     = $("#new-admin-name");
            phone    = $("#new-admin-phone");
            email    = $("#new-admin-email");
            role     = $("#new-admin-role");
            //pass     = $('#new-admin-pass');
            //pass2    = $('#new-admin-pass-confirm');

            id.text(data.a_ID);
            name.val(data.a_name);
            phone.val(data.a_phone);
            email.val(data.a_email);
            //pass.val(data.a_password);
        }



        /* select role */
        switch (data.a_role){
            case "Owner":
                suffix = 'owner';
                break;
            case "Manager":
                suffix = 'manager';
                break;
            case "Sales":
                suffix = 'sales';
                break;
        }

        role.val('role-' + suffix);

    }







    window.showAdminDetails = showAdminDetails;
    window.closeView        = closeView;
    window.editAdmin        = editAdmin;
});