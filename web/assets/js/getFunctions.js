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
