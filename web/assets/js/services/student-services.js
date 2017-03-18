/**
 * Created by evgeniy on 08/01/17.
 */
(function () {
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
                        throw response;
                })
                .catch(function (err) {
                    console.error(err);
                    throw err;
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


    window.handleStudentToServer = handleStudentToServer;
    window.handleStudentImage    = handleStudentImage;
})();