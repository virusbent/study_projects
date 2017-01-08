/**
 * Created by evgeniy on 16/12/16.
 */
// *** GLOBALS **************

// actual var for saving students from server
var allStudents;

// actual var for saving courses from server
var allCourses;


$(document).ready(function () {

    var tempSingleStudentImgs = [];

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
        // show count of all students and courses
        $('#count').show();

        getAllData();
    }

    // responsible for retrieving student and course Data from the server.
    function getAllData() {
        // request to DB and push the response to the list of students
        getAllStudents()
            .then(function (students) {
                // set to global var of students
                allStudents = students;
                // push the data to the list of students on the view
                populateStudentsList(students);
            });

        // request to DB for all registered courses
        getAllCourses()
            .then(function (courses) {
                allCourses = courses;
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
    function mainViewCtrl(viewToShow, student) {
        //console.log('> clicked on: ', viewToShow);
        switch(viewToShow){
            // if course+ was clicked
            case 'add-course':
                $('#count').hide();
                studentDetails.addClass("hidden");
                studentForm.addClass("hidden");
                // show course add form
                courseForm.removeClass("hidden");
                break;
            // if student+ was clicked
            case 'add-student':
                $('#count').hide();
                studentDetails.addClass("hidden");
                courseForm.addClass("hidden");
                // show student add form
                studentForm.removeClass("hidden");
                // TODO: show all available courses in the add-new-student view
                showCoursesForSelection();
                break;
            // if clicked on the specific student
            case 'show-student':
                $('#count').hide();
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
    /*function findStudentByID(id) {
        allStudents.map(function (student) {
            if(student.s_ID === id){
                return student;
            }
            else {
                return null;
            }
        })
    }*/

    // will receive student id and will push his data to the view.
    function showStudentDetails(studentToShow) {
        // needed selectors
        var img         = $("#student-img");
        var name        = $("#student-name");
        var phone       = $("#student-phone");
        var email       = $("#student-email");
        var courseList  = $("#this-student-courses");

        // first clean the previous presented courses, if was presented
        courseList.empty();

        //pushing data to student's containers
        //studentToShow.s_img[1] student's big image
        img.attr('src', studentToShow.s_img[1]);
        name.text(studentToShow.s_name);
        phone.text(studentToShow.s_phone);
        email.text(studentToShow.s_email);

        if (studentToShow.s_courses !== null)
        {
            var courses = studentToShow.s_courses;
            courses.map(function (course) {
                var courseUnit = $('<li/>')
                    .text(course.c_name)
                    .attr('id', course.c_ID)
                    .addClass('list-group-item')
                    .appendTo(courseList);
            });
        }
        else
        {
            var courseUnit = $('<li/>')
                .appendTo(courseList)
                .addClass('list-group-item')
                .text('Not assigned to any course')
                .append(
                    $('<button/>')
                        .addClass('btn btn-primary btn-block')
                        .attr({type:"button", id : studentToShow.s_ID})
                        .text('Add Course')
                        .on('click', function (event) {
                            addCourseToStudent(event.target.id);
                        })
                );
        }


    }

    // TODO: a variable that returns from the helper function is undefined, fix that
    function addCourseToStudent(student_id) {
        console.log('Add course to student with ID: ', student_id);
        findStudentByID(student_id, function (student) {
            console.log('student is: ', student);
            if (typeof student != 'string')
            {
                mainViewCtrl('add-course');
            }
            else
            {
                console.log('Error: ', student);
            }
        });
        /*if (student !== null && !undefined)
            console.log('student -> ', student);
            //mainViewCtrl('add-student');
        else
            console.log('student is null');*/
    }


    // *** SERVICES *****************

    // pulling students from the server.
    function getAllStudents() {
        return new Promise(function (fulfill, reject) {
            $.ajax({
                type    : 'GET',
                url     : '/getAllStudents',
                dataType: 'JSON'
            })
                .then(function (response) {
                    Promise.each(response, function (student) {
                        return getStudentImgsAndCourses(student.s_ID)
                            .then(function (data) {
                                student.s_img   = data[0];
                                if (data[1].length != 0)
                                    student.s_courses = data[1];
                                else student.s_courses = null;
                            });
                    })
                        .then(function (modifiedStudents) {
                            //console.log('modified students: ', modifiedStudents);
                            fulfill(modifiedStudents);
                        })
                })
                .catch(function (err) {
                    console.log('getAllStudents - Error: ', err);
                    reject(err);
                })

        })
    }
    
    function getAllCourses() {
        return new Promise(function (fulfill, reject) {
            $.ajax({
                type    : 'GET',
                url     : '/getAllCourses',
                dataType: 'JSON'
            })
                .then(function (all_courses) {
                    Promise.each(all_courses, function (course) {
                        return getCourseImgsAndStudents(course.c_ID)
                            .then(function (data) {
                                course.c_img = data[0];
                                if (data[1].length != 0)
                                    course.c_students = data[1];
                                else course.c_students = null;
                            })
                    })
                        .then(function (modifiedCourses) {
                            //console.log('modified -------> ', modifiedCourses);
                            fulfill(modifiedCourses);
                        })
                })
                .catch(function (err) {
                    console.log('getAllCourses - Error: ', err);
                    reject(err);
                })
        })
    }
    
    // getting images per student. executes after getAllStudents() got response from the server.
    /*function getStudentImages(s_img_id) {
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
    }*/

    function getStudentImgsAndCourses(student_id) {
        return new Promise(function (fulfill, reject) {
            $.ajax({
                type: 'GET',
                url: '/getStudentImgsAndCourses/' + student_id,
                dataTpe: 'JSON'
            })
                .then(function (response) {
                    fulfill(response);
                })
                .catch(function (err) {
                    console.log('getStudentImgsAndCourses - Error: ', err);
                    reject(err);
                })
        });
    }

    function getCourseImgsAndStudents(course_id) {
        return new Promise(function (fulfill, reject) {
            $.ajax({
                type    : 'GET',
                url     : '/getCourseImgsAndStudents/' + course_id,
                dataType: 'JSON'
            })
                .then(function (course_additional_data) {
                    fulfill(course_additional_data);
                })
                .catch(function (err) {
                    console.log('getCourseImgsAndStudents - Error: ', err);
                    reject(err);
                })
        })
    }


    init();

});