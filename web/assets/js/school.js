/**
 * Created by evgeniy on 16/12/16.
 */
$(document).ready(function () {

    //var Promise = require("bluebird");

    var tempSingleStudentImgs = [];

    // DEV. local testing
    //var students = [];

    // actual var for saving students from server
    var allStudents;

    // *** SELECTORS **************

    var studentForm     = $("#add-new-student");
    var studentDetails  = $("#details-student");
    var courseForm      = $("#add-new-course");



    // *** EVENTS ***************

    $("#add-student").on("click", function (event) {
        $("#count").hide();
        mainViewCtrl(event.target.id, null);
    });

    $("#add-course").on("click", function (event) {
        $("#count").hide();
        mainViewCtrl(event.target.id, null);
    });

    $("#close-btn").on("click", function () {
       console.log('TODO: close this view');
    });


    // *** FUNCTIONS **************

    function init() {
        // request to randomuser.me api to get mock data. DEV ONLY
        //getMockStudents();

        // request to DB
        getAllStudents()
            .then(function (students) {
                console.log('getAllStudents ', students);
                setDataToStudents(students);

                //TODO: FINISH TESTING THIS
                getStudentCourses(7);
            })
    }




    // will take an array of students (pulled from server)
    // and create <li> item for each one of the students in the array.
    // structure :
    /* <li class="list-group-item">
         <div class="row">
            <img  class="col-lg-4" src="url to student thumbnail"/>
            <span class="col-lg-8"> student name  </span>
            <span class="col-lg-8"> student phone </span>
         </div>
       </li> */
    function populateStudentsList(students) {
        var studentList = $("#student-list");
        console.log('populateStudentsList --------> ', students);
        console.log('       images        --------> ', students[1].s_img[2]);
        $.each(students, function (i) {
            var studentUnit = $('<li/>')
                .attr('id', students[i].s_ID)
                .addClass('list-group-item')
                .appendTo(studentList)
                .on('click', function (event) {
                    // show student details on the main view.
                    //mainViewCtrl('show-student', students[i].s_ID);
                    mainViewCtrl('show-student', students[i]);
                });

            var row = $('<div/>')
                .addClass('row')
                .appendTo(studentUnit);

            // students[i].s_img[2] for student thumbnail. (students[s_img][thumb]).
            var thumb = $('<img/>')
                .addClass('col-lg-4')
                .attr('src', students[i].s_img[2])
                .appendTo(row);

            var name = $('<span/>')
                .text(students[i].s_name)
                .addClass('col-lg-8')
                .appendTo(row);

            var phone = $('<span/>')
                .text(students[i].s_phone)
                .addClass('col-lg-8')
                .appendTo(row);
        })
    }

    // manipulating the main view by changing the visibility on
    // add-student/course, student-details
    // only one visible at a time.
    // TODO: change the 'student-id-pulled-from-server' case according to the changes made to studentUnit in populateStudentsList().
    function mainViewCtrl(viewToShow, student) {
        //var studentId = student.s_ID;
        console.log('> clicked on: ', viewToShow);
        switch(viewToShow){
            // if course+ was clicked
            case 'add-course':
                studentDetails.addClass("hidden");
                studentForm.addClass("hidden");
                // show course add form
                courseForm.removeClass("hidden");
                break;
            // if student+ was clicked
            case 'add-student':
                studentDetails.addClass("hidden");
                courseForm.addClass("hidden");
                // show student add form
                studentForm.removeClass("hidden");
                break;
            // if clicked on the specific student
            case 'show-student':
                console.log('will show student with id: ', student);
                studentForm.addClass("hidden");
                courseForm.addClass("hidden");
                // show details view
                studentDetails.removeClass("hidden");
                if (student.s_ID !== null){
                    showStudentDetails(student);
                }
                break;
        }
    }

    // walk through allStudents array and returns student with requested id.
    function findStudentByID(id) {
        allStudents.map(function (student) {
            if(student.s_ID === id){
                return student;
            }
            else {
                return null;
            }
        })
    }

    // will receive student id and will push his data to the view.
    function showStudentDetails(studentToShow) {
        // needed selectors
        var img     = $("#student-img");
        var name    = $("#student-name");
        var phone   = $("#student-phone");
        var email   = $("#student-email");

        //pushing data to student's containers
        //studentToShow.s_img[1] student's big image
        img.attr('src', studentToShow.s_img[1]);
        name.text(studentToShow.s_name);
        phone.text(studentToShow.s_phone);
        email.text(studentToShow.s_email);

    }

    // will set received data from the server to the global var allStudents
    // and will push fill the data in the list of students thumbnail profiles.
    function setDataToStudents(data) {
        console.log('> set this data to students: ', data);
        allStudents = data;
        populateStudentsList(data);
    }


    // *** SERVICES *****************

    // pulling students from the server.
    function getAllStudents() {
        return new Promise(function (fulfill, reject) {
            $.ajax({
                type    : 'GET',
                url     : '/getAllStudents',
                dataType: 'json'
            })
                .then(function (response) {
                    Promise.each(response, function (student) {
                        return getStudentImages(student.s_img)
                                .then(function (studentImgs) {
                                    student.s_img = studentImgs;
                                });
                    })
                        .then(function (modifiedStudents) {
                            console.log('modified students: ', modifiedStudents);
                            fulfill(modifiedStudents);
                        })
                })
                .catch(function (err) {
                    console.log('Error: ', err);
                })

        })
    }
    
    // getting images per student. executes after getAllStudents() got response from the server.
    function getStudentImages(s_img_id) {
        return new Promise(function (fulfill, reject) {
            $.ajax({
                type: 'GET',
                url: '/getStudentImgs/' + s_img_id,
                dataType: 'json'
            })
                .then(function (response) {
                    fulfill(response);
                })
                .catch(function (err) {
                    console.log('Error: ', err);
                    reject(err);
                })

        });
    }

    init();

});