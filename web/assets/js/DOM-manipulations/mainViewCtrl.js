/**
 * Created by evgeniy on 09/01/17.
 */
(function () {

    var PREFIX = {
        student : 's_',
        course  : 'c_',
        admin   : 'a_'
    };


    // *** SELECTORS **************

    var studentForm     = $("#add-new-student");
    var studentDetails  = $("#details-student");
    var courseDetails   = $("#details-course");
    var courseForm      = $("#add-new-course");
    // in case of edit ID is present
    //var id              = $("#quick-edit").parent().find("span:hidden");
    var id              = $("#db-student-id");

    // manipulating the main view by changing the visibility on
    // add-student/course, student-details
    // only one visible at a time.
    // if receives second param then it's edit mode.
    function mainViewCtrl(viewToShow, data) {
        switch(viewToShow){
            // if course+/edit was clicked
            case 'add-course':
                $('#count').hide();
                emptyDetails("course");
                studentDetails.addClass("hidden");
                studentForm.addClass("hidden");
                courseDetails.addClass("hidden");
                // show course add form
                courseForm.removeClass("hidden");
                showListForSelection('course');

                if (typeof data === 'object' && data != null){
                    fillDetails(data);
                }
                break;
            // if student+/edit was clicked
            case 'add-student':
                $('#count').hide();
                emptyDetails("student");
                studentDetails.addClass("hidden");
                courseForm.addClass("hidden");
                courseDetails.addClass("hidden");
                // show student add form
                studentForm.removeClass("hidden");
                // show all available courses for new student
                showListForSelection('student');

                if (typeof data === 'object' && data != null){
                    fillDetails(data);
                }
                break;
            // if clicked on the specific student
            case 'show-student':
                $('#count').hide();
                studentForm.addClass("hidden");
                courseForm.addClass("hidden");
                courseDetails.addClass("hidden");
                // show details view
                studentDetails.removeClass("hidden");

                if (data.s_ID !== null || data.s_ID !== false){
                    showStudentDetails(data);
                }
                break;
            // if clicked on the specific course
            case 'show-course':
                $('#count').hide();
                studentForm.addClass("hidden");
                courseForm.addClass("hidden");
                studentDetails.addClass("hidden");
                // show details view
                courseDetails.removeClass("hidden");

                if (data.c_ID !== null || data.c_ID !== false){
                    showCourseDetails(data);
                }
                break;
        }
    }

    // generate list of courses that can be added to the student
    function showListForSelection(list_type) {
        if(list_type === 'student'){
            var courseList = $('#list-of-courses-to-add');
            allCourses.forEach(function (course) {
                var item = $('<li/>')
                    .attr('id', 'course-item-' + course.c_ID)
                    .addClass('list-group-item')
                    .text(course.c_name)
                    .appendTo(courseList)
                    .on('click', function () {
                        $(this).toggleClass('active');
                    });
            });
        }
        else if(list_type === 'course'){
            var studentList = $('#list-of-students-to-add');
            allStudents.forEach(function (student) {
                var item = $('<li/>')
                    .attr('id', 'student-item-' + student.s_ID)
                    .addClass('list-group-item')
                    .text(student.s_name)
                    .appendTo(studentList)
                    .on('click', function () {
                        $(this).toggleClass('active');
                    });
            });
        }
    }

    // will receive student and will push his data to the view.
    function showStudentDetails(dataToShow) {
        // needed selectors
        var img         = $("#student-img");
        var name        = $("#student-name");
        var phone       = $("#student-phone");
        var email       = $("#student-email");
        var courseList  = $("#this-student-courses");

        // first clean the previous presented courses, if was presented
        courseList.empty();

        //pushing data to student's containers
        //dataToShow.s_img[1] student's big image
        img.attr('src', dataToShow.s_img[1]);
        name.text(dataToShow.s_name);
        phone.text(dataToShow.s_phone);
        email.text(dataToShow.s_email);
        id.text(dataToShow.s_ID);

        if (dataToShow.s_courses !== null)
        {
            var courses = dataToShow.s_courses;
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
                        .attr({type:"button", id : dataToShow.s_ID})
                        .text('Add Course')
                        .on('click', function (event) {
                            addCourseToStudent(event.target.id);
                        })
                );
        }
    }


    // will receive student and will push his data to the view.
    function showCourseDetails(dataToShow) {
        // needed selectors
        var img             = $("#course-img");
        var name            = $("#course-name");
        var desc            = $("#course-description");
        var studentList     = $("#this-course-students");
        var id              = $("#db-course-id");

        // first clean the previous presented courses, if was presented
        studentList.empty();

        //pushing data to course's containers
        //dataToShow.s_img[1] course's big image
        img.attr('src', dataToShow.c_img[1]);
        name.text(dataToShow.c_name);
        desc.text(dataToShow.c_description);
        id.text(dataToShow.c_ID);

        if (dataToShow.c_students !== null)
        {
            var students = dataToShow.c_students;
            students.map(function (student) {
                var studentUnit = $('<li/>')
                    .text(student.s_name)
                    .attr('id', student.s_ID)
                    .addClass('list-group-item')
                    .appendTo(studentList);
            });
        }
        else
        {
            var studentUnit = $('<li/>')
                .appendTo(studentList)
                .addClass('list-group-item')
                .text('Not assigned to any student')
                .append(
                    $('<button/>')
                        .addClass('btn btn-primary btn-block')
                        .attr({type:"button", id : dataToShow.c_ID})
                        .text('Add Student')
                        .on('click', function (event) {
                            //addCourseToStudent(event.target.id);
                            console.log('add students to this course');
                        })
                );
        }
    }


/* TODO: > showDetails < should combine functions showStudentDetails and showCourseDetails */
/*
    function showDetails(data) {
    // selectors
        var img;
        var name;
        var phone;
        var email;
        var list;

        var received_prefix = Object.keys(data)[0].substr(0, 2);
        var key = {
            student : 'student',
            course  : 'course',
            admin   : 'admin'
        };

        switch (received_prefix){
            case PREFIX.student :
                img         = $("#student-img");
                name        = $("#student-name");
                phone       = $("#student-phone");
                email       = $("#student-email");
                list        = $("#this-student-courses");
                break;
            case PREFIX.course  :
                img         = $("#course-img");
                name        = $("#course-name");
                phone       = $("#course-phone");
                email       = $("#course-email");
                list        = $("#this-course-courses");
                break;
            case PREFIX.admin   :
                console.log('admin');
                break;
        }

        // first clean the previous presented courses/students, if was presented
        list.empty();

        //pushing data to student's/course's containers
        //data.PREFIX_img[1] student's/course's big image
        img.attr('src', data.[received_prefix + '_img'][1]);
        name.text(data.[received_prefix + '_name']);
        phone.text(data.[received_prefix + '_phone']);
        email.text(data.[received_prefix + '_email']);
        id.text(data.[received_prefix + '_ID']);

    }

*/




    function editThisStudent() {
        findStudentByID(id.text(), function (student) {
            mainViewCtrl('add-student', student);
        });
    }

    function editThisCourse() {
        var id = $("#db-course-id");
        findCourseByID(id.text(), function (course) {
            mainViewCtrl('add-course', course);
        });
    }


    function emptyDetails(type) {
        if(type === "student"){
            $('#db-student-id').text("");
            $('#list-of-courses-to-add').empty();
            $('#add-student-img').attr("src", "http://placehold.it/250x250");

            if($('#new-student-name').val() !== "")     $('#new-student-name').val("");
            if($('#new-student-phone').val() !== "")    $('#new-student-phone').val("");
            if($('#new-student-email').val() !== "")    $('#new-student-email').val("");
        }
        else if(type === "course"){
            $('#db-course-id').text("");
            $('#list-of-students-to-add').empty();
            $('#add-course-img').attr("src", "http://placehold.it/250x250");

            if($("#new-course-name").val() !== "")      $("#new-course-name").val("");
            if($("#new-course-desc").val() !== "")      $("#new-course-desc").val("");
        }
    }

    // Fill inputs with details of chosen Student/Course to be edited
    function fillDetails(details){
        var received_prefix = Object.keys(details)[0].substr(0, 2);

        switch (received_prefix){
            case PREFIX.student :
                $('#student-info-inputs').find('span:hidden').text(details.s_ID);
                $('#new-student-name').val(details.s_name);
                $('#new-student-phone').val(details.s_phone);
                $('#new-student-email').val(details.s_email);
                $('#add-student-img').attr('src', details.s_img[1]);
                var courseListNotActive = $("#list-of-courses-to-add").children();
                if(details.s_courses){
                    details.s_courses.map(function (course) {
                        courseListNotActive.each(function () {
                            var courseNotActive = $(this);
                            if(course.c_name === courseNotActive.text()){
                                // selecting current courses of student
                                courseNotActive.addClass('active');
                            }
                        })
                    });
                }
                break;
            case PREFIX.course  :
                $('#course-info-inputs').find('span:hidden').text(details.c_ID);
                $('#new-course-name').val(details.c_name);
                $('#new-course-desc').val(details.c_description);
                $('#add-course-img').attr("src", details.c_img[1]);
                var studentListNotActive = $("#list-of-students-to-add").children();
                details.c_students.map(function (student) {
                    studentListNotActive.each(function () {
                        var studentNotActive = $(this);
                        if(student.s_name === studentNotActive.text()){
                            // selecting current courses of student
                            studentNotActive.addClass('active');
                        }
                    })
                });
                break;
            case PREFIX.admin   :
                console.log('this is Admin!');
                break;
        }
    }


    /* Random String */
    //var random_string = Array(32).join((Math.random().toString(36)+'00000000000000000').slice(2, 18)).slice(0, 32);


    window.mainViewCtrl             = mainViewCtrl;
    window.emptyDetails             = emptyDetails;
    window.editThisStudent          = editThisStudent;
    window.editThisCourse           = editThisCourse;
    window.showStudentDetails       = showStudentDetails;
    window.showListForSelection     = showListForSelection;
})();