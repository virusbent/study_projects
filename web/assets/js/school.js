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
                populateStudentList(students);
            });

        // request to DB for all registered courses
        getAllCourses()
            .then(function (courses) {
                // set to global var of courses
                allCourses = courses;
                // push the data to the list of courses on the view
                console.log('sending to populate: ', courses);
                populateCourseList(courses);
            })
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