/**
 * Created by evgeniy on 26/12/16.
 */
function getStudentCourses(student_id) {
    new Promise(function (fulfill, reject) {
        $.ajax({
            type        : 'GET',
            url         : '/getThisStudentCourses/' + student_id,
            dataType    : 'json'
        })
            .then(function (courses) {
                console.log('>> getStudentCourses: courses -> ', courses);
                fulfill(courses);
            })
            .catch(function (err) {
                console.log('>> getStudentCourses: Error -> ', err);
                reject(err);
            })
    });
}

window.getStudentCourses = getStudentCourses;
/*
function getStudentImgsAndCourses(student_id) {
    return new Promise(function (fulfill, reject) {
        $.ajax({
            type    : 'GET',
            url     : '/getStudentImgsAndCourses/' + student_id,
            dataTpe : 'JSON'
        });
            .then(function (data) {
                console.log('>> getStudentImgsAndCourses: data -> \r\n' + data);
                fulfill(data);
            })
            .catch(function (err) {
                console.log('>> getStudentImgsAndCourses: Error -> ', err);
                reject(err);
            })
    })
}
window.getStudentImgsAndCourses = getStudentImgsAndCourses;*/
