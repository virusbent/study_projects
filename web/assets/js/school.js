/**
 * Created by evgeniy on 16/12/16.
 */
$(document).ready(function () {

    var showMe = '';

    // flag that will allow posting things AFTER im sure
    // that I have received data from the DB.
    // false by default
    var dataIsReady = false;

    // DEV. local testing
    var students = [];

    // actual var for saving students from server
    var allStudents;

    // *** SELECTORS **************

    var studentForm     = $("#add-new-student");
    var studentDetails  = $("#details-student");
    var courseForm      = $("#add-new-course");



    // *** EVENTS ***************

    $("#add-student").on("click", function (event) {
        $("#count").hide();
        mainViewManip(event.target.id);
        //showStudentForm();
    });

    $("#add-course").on("click", function (event) {
        $("#count").hide();
        //showCourseForm();
        mainViewManip(event.target.id);
    });

    $("#close-btn").on("click", function () {
       console.log('TODO: close this view');
    });


    // *** FUNCTIONS **************

    function init() {
        // request to randomuser.me api to get mock data. DEV ONLY
        getMockStudents();

        // request to DB
        getAllStudents();

        // testing pulls of images from DB
        //TODO: the request is working on the server-side, but the request that coming from the client is noe good. look into it.
        getStudentImages(2)
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
    function populateStudents() {
        var studentList = $("#student-list");
        $.each(allStudents, function (i) {
            var studentUnit = $('<li/>')
                .attr('id', allStudents[i].s_ID)
                .addClass('list-group-item')
                .appendTo(studentList)
                .on('click', function (event) {
                    // show student details on the main view.
                    mainViewManip('student-id-pulled-from-server');
                });

            var row = $('<div/>')
                .addClass('row')
                .appendTo(studentUnit);

            /*var thumb = $('<img/>')
                .addClass('col-lg-4')
                .attr('src', students[i][2])
                .appendTo(row);*/

            var name = $('<span/>')
                .text(allStudents[i].s_name)
                .addClass('col-lg-8')
                .appendTo(row);

            var phone = $('<span/>')
                .text(allStudents[i].s_phone)
                .addClass('col-lg-8')
                .appendTo(row);
        })
    }

    // manipulating the main view by changing the visibility on
    // add-student/course, student-details
    // only one visible at a time.
    // TODO: change the 'student-id-pulled-from-server' case according to the changes made to studentUnit in populateStudents().
    function mainViewManip(viewToShow) {
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
            case 'student-id-pulled-from-server':
                studentForm.addClass("hidden");
                courseForm.addClass("hidden");
                // show details
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

    function setDataToStudents(data) {
        console.log('> set this data to students: ', data);
        allStudents = data;
    }


    // *** SERVICES *****************

    // service to get all the students that are saved in DB
    // TODO: application/x-www-form-urlencoded ??
    function getAllStudents() {
        $.ajax({
            type: 'GET',
            url: '/getAllStudents',
            dataType: 'json',
            success: function(students) {
                console.log('> List of Students: ', students);
                setDataToStudents(students);
            }
        });
    }

    // service to pull the images of the student,
    // done after the student is already pulled from DB
    // TODO: figure out how to assemble the right ajax request to get the images.
    function getStudentImages(studentImgId) {
        // ajax get when success setDataToStudents
        $.ajax({
            type        : 'GET',
            url         : '/getStudentImgs/'+ studentImgId,
            //data        : {studentImgId: studentImgId},
            dataType    : 'json',
            success     : function (studentImgs) {
                console.log('> image list: ', studentImgs);
            },
            error       : function (err) {
                console.log('> Error: ', err);
            }
        });
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
            }
        });
    }



    init();

});