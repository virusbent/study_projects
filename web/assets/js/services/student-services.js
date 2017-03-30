/**
 * Created by evgeniy on 08/01/17.
 */
(function () {
    // pulling students from the server.
    function getAllStudents() {
        return new Promise(function (fulfill, reject) {
            $.ajax({
                type    : 'GET',
                url     : '/getAllStudents',
                dataType: 'JSON'
            })
                .then(function (response) {
                    Promise.each(response, function (student) {
                        return getStudentImgsAndCourses(student.s_ID)
                            .then(function (data) {
                                student.s_img   = data[0];
                                if (data[1].length != 0)
                                    student.s_courses = data[1];
                                else student.s_courses = null;
                            });
                    })
                        .then(function (modifiedStudents) {
                            //console.log('modified students: ', modifiedStudents);
                            fulfill(modifiedStudents);
                        })
                })
                .catch(function (err) {
                    console.log('getAllStudents - Error: ', err);
                    reject(err);
                })

        })
    }

    function getStudentImgsAndCourses(student_id) {
        return new Promise(function (fulfill, reject) {
            $.ajax({
                type: 'GET',
                url: '/getStudentImgsAndCourses/' + student_id,
                dataTpe: 'JSON'
            })
                .then(function (response) {
                    fulfill(response);
                })
                .catch(function (err) {
                    console.log('getStudentImgsAndCourses - Error: ', err);
                    reject(err);
                })
        });
    }


    function handleStudentToServer(student){
        console.log('STUDENT -> ', student);
        /*return new Promise(function (fulfill, reject) {*/
            console.log('Service - handleStudentToServer: ', student);
            return $.ajax({
                method      : 'POST',
                url         : '/saveStudent/',
                contentType : false,
                /*headers : {"Content-type":"multipart/form-data"},*/
                data        : student,
                processData : false
            })
                .then(function (response) {
                    console.log('*handleStudentToServer* - Promise response: ', response);
                    if(response != false)
                        return response;
                    else
                        throw new Error(response);
                })
                .catch(function (err) {
                    throw new Error(err);
                });
                /*.done(function (response, textStatus) {
                    if (textStatus === 'success'){
                        console.log('Services - handleStudentToServer: ', response);
                        passStudentId(response);
                    }
                })
                .fail(function (textStatus, errorThrown) {
                    console.error('Error has occured while sending the data: \n\r' +
                        textStatus, errorThrown);
                    passStudentId(false);
                }) */
    }

    function deleteFromServer(data) {
        var url     = "";
        var payload = null;

        if(data.type === "student"){
            url     = "/deleteStudent/";
            payload = data.id;
        }
        else if(data.type === "course"){
            url     = "/deleteCourse/";
            payload = data.id;
        }
        else if(data.type === "admin"){
            url     = "/deleteAdmin/";
            payload = data.id;
        }


        return $.ajax({
            method  : 'POST',
            url     : url,
            data    : payload
        }).then(function (res) {
            return res;
        }).catch(function (err) {
            throw new Error(err);
        })
    }


    // TODO: Depricated ???
    function handleStudentImage(image) {
        console.log("!!! !!! NEEDS TO BE DEPRECATED !!! !!! \n\r!!! !!! handleStudentImage !!! !!! ");
        return new Promise(function (fulfill, reject) {
            $.ajax({
                method      : "POST",
                url         : "/uploadImageToAmazon",
                //headers     : {"Content-type":"multipart/form-data"},
                mimeType    : "multipart/form-data",
                contentType : false,
                processDate : false,
                cashe       : false,
                image       : image
            }).then(function (response) {
                console.log('*handleStudentImage* - Promise response: ', response);
                if(response != false)
                    fulfill(response);
                else
                    reject(response);
            }).catch(function (err) {
                console.error("!ERROR: ", err);
                reject(err);
            });
        })
    }


    window.getAllStudents           = getAllStudents;
    window.getStudentImgsAndCourses = getStudentImgsAndCourses;
    window.handleStudentToServer    = handleStudentToServer;
    window.handleStudentImage       = handleStudentImage;
    window.deleteFromServer         = deleteFromServer;
})();