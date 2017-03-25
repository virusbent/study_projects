/**
 * Created by evgeniy on 08/01/17.
 * Edited on 03/03/17
 */
(function () {
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
                            fulfill(modifiedCourses);
                        })
                })
                .catch(function (err) {
                    console.log('getAllCourses - Error: ', err);
                    reject(err);
                })
        })
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

    function handleCourseToServer(course){
        console.log('COURSE -> ', course);
        console.log('Service - handleCourseToServer: ', course);
        return $.ajax({
            method      : 'POST',
            url         : '/saveCourse/',
            contentType : false,
            data        : course,
            processData : false
        })
            .then(function (response) {
                console.log('*handleCourseToServer* - Promise response: ', response);
                if(response){
                    console.log('*handleCourseToServer* - response: ', response);
                    return response;
                }
            })
            .catch(function (err) {
                console.error(err);
                throw err;
            });
    }


    window.handleCourseToServer     = handleCourseToServer;
    window.getAllCourses            = getAllCourses;
    window.getCourseImgsAndStudents = getCourseImgsAndStudents;
})();
