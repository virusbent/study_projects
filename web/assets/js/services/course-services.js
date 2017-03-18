/**
 * Created by evgeniy on 08/01/17.
 * Edited on 03/03/17
 */
(function () {
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


    window.handleCourseToServer = handleCourseToServer;
})();
