/**
 * Created by evgeniy on 08/01/17.
 */
(function () {
    function handleStudentToServer(student){
        return new Promise(function (fulfill, reject) {
            console.log('Service - handleStudentToServer: ', student);
            $.ajax({
                type    : "POST",
                url     : "/saveStudent",
                headers : {"Content-type":"application/x-www-form-urlencoded"},
                data    : student
            })
                .then(function (response) {
                    console.log('Promise response: ', response);
                    if(response != false)
                        fulfill(response);
                    else
                        reject(response);
                })
                .catch(function (err) {
                    console.error(err);
                    reject(err);
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
        });
    }


    window.handleStudentToServer = handleStudentToServer;
})();