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


    window.populateCourseList = populateCourseList;
    window.populateStudentList= populateStudentList;
    window.updateStudentList  = updateStudentList;
})();