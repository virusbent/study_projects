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
                // counting the amount of students and courses, auto updating
                $("#student-count").text(allStudents.length);
            });

        // request to DB for all registered courses
        getAllCourses()
            .then(function (courses) {
                // set to global var of courses
                allCourses = courses;
                $("#course-count").text(allCourses.length);
                populateCourseList(courses);
            })
    }


    init();

});