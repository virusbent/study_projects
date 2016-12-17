/**
 * Created by evgeniy on 16/12/16.
 */
$(document).ready(function () {

    var showMe = '';

    var students = [];

    // *** SELECTORS **************

    var studentForm     = $("#add-new-student");
    var studentDetails  = $("#details-student");
    var courseForm      = $("#add-new-course");



    // *** EVENTS ***************

    $("#add-student").on("click", function (event) {
        console.log('add student clicked!', event.target.id.substr(7));
        $("#count").hide();
        mainViewManip(event.target.id);
        //showStudentForm();
    });

    $("#add-course").on("click", function (event) {
        console.log('add course clicked! ', event.target.id.substr(7));
        $("#count").hide();
        //showCourseForm();
        mainViewManip(event.target.id);
    });

    $("#close-btn").on("click", function () {
       console.log('TODO: close this view');
    });


    // *** FUNCTIONS **************

    function init() {
        getMockStudents();
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
    // TODO: change the id of studentUnit to id pulled from DB.
    function populateStudents() {
        var studentList = $("#student-list");
        $.each(students, function (i) {
            var studentUnit = $('<li/>')
                    .attr('id', 'student-id-pulled-from-server')
                    .addClass('list-group-item')
                    .appendTo(studentList)
                    .on('click', function (event) {
                       //showStudentDetails();
                        mainViewManip('student-id-pulled-from-server');
                    });

            var row         = $('<div/>')
                    .addClass('row')
                    .appendTo(studentUnit);

            var thumb       = $('<img/>')
                    .addClass('col-lg-4')
                    .attr('src', students[i][2])
                    .appendTo(row);

            var name        = $('<span/>')
                    .text(students[i][0])
                    .addClass('col-lg-8')
                    .appendTo(row);

            var phone       = $('<span/>')
                .text(students[i][1])
                .addClass('col-lg-8')
                .appendTo(row);
        })
    }

    // manipulating the main view by changing the visibility on
    // add-student/course, student-details
    // only one visible at a time.
    // TODO: change the {student-details} case according to the changes made to studentUnit in populateStudents().
    function mainViewManip(viewToShow) {
        switch(viewToShow){
            case 'add-course':
                studentDetails.addClass("hidden");
                studentForm.addClass("hidden");
                courseForm.removeClass("hidden");
                break;
            case 'add-student':
                studentDetails.addClass("hidden");
                courseForm.addClass("hidden");
                studentForm.removeClass("hidden");
                break;
            case 'student-id-pulled-from-server':
                studentForm.addClass("hidden");
                courseForm.addClass("hidden");
                studentDetails.removeClass("hidden");
                break;
        }
    }

    /*function showCourseForm() {
        console.log('adding new course');
        if(  studentForm.hasClass(".hidden") ){
            courseForm.removeClass("hidden");
        }
        else {
            studentForm.addClass("hidden");
            courseForm.removeClass("hidden");
        }
    }

    function showStudentForm() {
        console.log('adding new student');
        // first check if another form is hidden
        if(  courseForm.hasClass(".hidden") ){
            studentForm.removeClass("hidden");
        }
        else {
            courseForm.addClass("hidden");
            studentForm.removeClass("hidden");
        }
    }*/

    // will receive student-id and will show details view of this student
    function showStudentDetails() {
        console.log('showing student details');
        if(  studentForm.hasClass(".hidden") && courseForm.hasClass("hidden")){
            studentDetails.removeClass("hidden");
        }
        else {
            studentForm.addClass("hidden");
            courseForm.addClass("hidden");
            studentDetails.removeClass("hidden");
        }
    }


    // service to get a random student for testing
    function getMockStudents() {
        $.ajax({
            url: 'https://randomuser.me/api/',
            dataType: 'json',
            success: function(data) {
                students = [[data.results[0].name.first+ ' ' + data.results[0].name.last,
                    data.results[0].cell, data.results[0].picture.thumbnail]];
                populateStudents();
                //console.log(students);
            }
        });
    }



    init();

});