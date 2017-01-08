/**
* Created by evgeniy on 02/01/17.
*/
$(document).ready(function () {

    // walk through allStudents array and returns student with requested id.
    function findStudentByID(id, passResult) {
        var foundStudent;
        allStudents.map(function (student) {
            if(student.s_ID === id){
                console.log('student is found: ', student);
                foundStudent = student;
            }
            else {
                return
            }
        });

        if (foundStudent !== null && typeof foundStudent != 'undefined')
            passResult(foundStudent);
        else
            passResult('No such student is found');     // error

    }

    function showCoursesForSelection() {
        var courseList = $('#list-of-courses-to-add');
        //console.log('showCoursesForSelection - reached!\r\n', allCourses);
        allCourses.forEach(function (course) {
            /* var input = $('<li/>')
             .attr({
             'id'    : 'course-item-' + course.c_ID,
             'type'  : 'checkbox'
             })
             .text(course.c_name)
             .appendTo(courseList);*/
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

    function processStudentData(event) {
        event.preventDefault();
        // * selectors *
        var selectedCourses = $('#list-of-courses-to-add').children().filter('.active');
        var name            = $('#new-student-name').val();
        var email           = $('#new-student-email').val();
        var phone           = $('#new-student-phone').val();

        allInputs = $(":input");

        // * variables *
        var len             = selectedCourses.length;
        var coursesID       = [];
        var studentToSave   = {};
        var studentID       = '';

        // TODO: check all the inputs of this form
        if (len != 0 && name != '' && email != '' && phone != ''){

            studentToSave.name      = name;
            studentToSave.email     = email;
            studentToSave.phone     = phone;

            for (var i = 0; i < len; i++){
                // the id will ALWAYS be at the end after '-'
                var course_id = selectedCourses[i].id.split('-').pop();
                coursesID.push(parseInt(course_id));
            }

            studentToSave.courses   = coursesID;
            console.log('passing - ', studentToSave);
            /*var studentID = handleStudentToServer(studentToSave, function (id) {
                if (id !== false){
                    console.log('Student is successfuly created. His fresh id: ', id);
                    return id;
                }
            });*/
            handleStudentToServer(studentToSave).then(function (id) {
                console.log('received id: ', id);
                studentID = id;
            });
            console.log('TEST: the received id: ', studentID);

        }
        else {
            console.log('Check your inputs AND You must select courses!');
        }
    }


    window.findStudentByID          = findStudentByID;
    window.processStudentData       = processStudentData;
    window.showCoursesForSelection  = showCoursesForSelection;


});