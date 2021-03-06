/**
 * Created by evgeniy on 09/01/17.
 */
(function () {

    // will take an array of courses (pulled from server)
    // and create <li> item for each one of the courses in the array.
    // structure :
    /* <li class="list-group-item">
     <div class="row">
     <img  class="col-lg-4" src="url to course thumbnail"/>
     <span class="col-lg-8"> course name  </span>
     <span class="col-lg-8"> course phone </span>
     </div>
     </li> */
    function populateCourseList(courses) {
        var courseList = $("#course-list");
        console.log('populateCourseList --------> ', courses);
        $.each(courses, function (i) {
            var courseUnit = $('<li/>')
                .attr('id', courses[i].c_ID)
                .addClass('list-group-item')
                .appendTo(courseList)
                .on('click', function (event) {
                    // show course details on the main view.
                    mainViewCtrl('show-course', courses[i]);
                });

            var row = $('<div/>')
                .addClass('row')
                .appendTo(courseUnit);

            // courses[i].c_img[2] for course thumbnail. (courses[c_img][thumb]).
            var thumb = $('<img/>')
                .addClass('col-lg-4')
                .attr('src', courses[i].c_img[2])
                .appendTo(row);

            var name = $('<span/>')
                .text(courses[i].c_name)
                .addClass('col-lg-8')
                .appendTo(row);

            var phone = $('<span/>')
                .text(courses[i].c_phone)
                .addClass('col-lg-8')
                .appendTo(row);
        })
    }


    function populateStudentList(students) {
        var studentList = $("#student-list");
        console.log('populateStudentList --------> ', students);
        $.each(students, function (i) {
            var studentUnit = $('<li/>')
                .attr('id', students[i].s_ID)
                .addClass('list-group-item')
                .appendTo(studentList)
                .on('click', function (event) {
                    // show student details on the main view.
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

    function populateAdminList(admins) {
        var adminList = $("#admin-list");
        console.log('populateAdminList --------> ', admins);
        $.each(admins, function (i) {
            var adminUnit = $('<li/>')
                .attr('id', admins[i].a_ID)
                .addClass('list-group-item')
                .appendTo(adminList)
                .on('click', function (event) {
                    // show admin details on the main view.
                    showAdminDetails(admins[i].a_ID);
                });

            var row = $('<div/>')
                .addClass('row')
                .appendTo(adminUnit);

            var div = $('<div/>')
                .addClass('col-lg-12 col-md-12 col-sm-12')
                .appendTo(row);

            var name = $('<div/>')
                .text(admins[i].a_name)
                .addClass('col-lg-10 col-md-10 col-sm-10 text-left')
                .appendTo(div);

            var role = $('<div/>')
                .text(admins[i].a_role)
                .addClass('col-lg-10 col-md-10 col-sm-10 text-left')
                .appendTo(div);
        })
    }

    function updateStudentList() {
        var studentList = $("#student-list");

        getAllStudents().then(function (students) {
            console.log("updating student list with new list: \n\r", students);

            // updating student list
            allStudents = students;
            studentList.empty();
            populateStudentList(students);
            mainViewCtrl("add-student", null);
        })
    }

    function updateCourseList() {
        var courseList = $("#course-list");

        getAllCourses().then(function (courses) {
            console.log("updating course list with new list: \n\r", courses);

            // updating course list
            allCourses = courses;
            courseList.empty();
            populateCourseList(courses);
            mainViewCtrl("add-course", null);
        })
    }

    function updateAdminList() {
        var adminList = $("#admin-list");

        getAllAdmins().then(function (admins) {
            console.log("updating admin list with new list: \n\r", admins);

            // updating admin list
            allAdmins = admins;
            adminList.empty();
            populateAdminList(admins);
            closeView('reset');
        })
    }


    window.populateCourseList = populateCourseList;
    window.populateStudentList= populateStudentList;
    window.populateAdminList  = populateAdminList;
    window.updateStudentList  = updateStudentList;
    window.updateCourseList   = updateCourseList;
    window.updateAdminList    = updateAdminList;
})();