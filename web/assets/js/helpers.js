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
            passResult('No such student is found');     // handle error

    }

    // walk through allCourses array and returns course with requested id.
    function findCourseByID(id, passResult) {
        var foundCourse;
        allCourses.map(function (course) {
            if(course.c_ID === id){
                console.log('course is found: ', course);
                foundCourse = course;
            }
            else {
                return
            }
        });

        if (foundCourse !== null && typeof foundCourse != 'undefined')
            passResult(foundCourse);
        else
            passResult('No such Course is found');     // handle error

    }

    function processStudentImage(event) {
        event.preventDefault();
        /* selectors */
        var image = $('#upload-img-student').prop("files")[0];
        var form  = new FormData(this);
        form.append('student_img', image);
        console.log('sending image to server...', form);
        handleStudentImage(form).then(function (response) {
            console.log('...response from server: ', response);
        })
    }




    function processStudentData(event) {
        event.preventDefault();
        // * selectors *
        var selectedCourses = $('#list-of-courses-to-add').children().filter('.active');
        var id              = parseInt($('#student-info-inputs').find('span:hidden').val());
        var name            = $('#new-student-name').val();
        var email           = $('#new-student-email').val();
        var phone           = $('#new-student-phone').val();
        var img             = $('#upload-img-student')[0].files;

        // * variables *
        var len             = selectedCourses.length;
        var coursesID       = [];
        var studentToSave   = new FormData();
        var studentID       = '';

        if (id != 0 && len != 0 && name != '' && email != '' && phone != ''){

            studentToSave.append('id', id);
            studentToSave.append('name', name);
            studentToSave.append('email', email);
            studentToSave.append('phone', phone);
            console.log('img ->', img[0]);
            studentToSave.append('img', img[0]);

            for (var i = 0; i < len; i++){
                // the id will ALWAYS be at the end after '-'
                var course_id = selectedCourses[i].id.split('-').pop();
                coursesID.push(parseInt(course_id));
            }

            studentToSave.append('courses', coursesID);
            console.log('passing - ', studentToSave);
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

    // TODO: a variable that returns from the helper function is undefined, fix that (?)
    function addCourseToStudent(student_id) {
        console.log('Add course to student with ID: ', student_id, ' (type: ', typeof student_id, ')');
        findStudentByID(student_id, function (student) {
            console.log('student is: ', student, '\n\r (type: ', typeof student, ')');
            if (typeof student === 'object')
            {
                mainViewCtrl('add-student', student);
            }
            else
            {
                console.log('Error: ', student);
            }
        });
    }


    window.findCourseByID           = findCourseByID;
    window.findStudentByID          = findStudentByID;
    window.addCourseToStudent       = addCourseToStudent;
    window.processStudentData       = processStudentData;
    window.processStudentImage      = processStudentImage;


});