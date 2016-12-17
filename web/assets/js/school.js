/**
 * Created by evgeniy on 16/12/16.
 */
$(document).ready(function () {

    var showMe = '';

    $("#target-student").on("click", function (event) {
        console.log('add student clicked!', event.target.id.substr(7));
        showMe = event.target.id.substr(7);
        addNewStudent();
    });

    $("#target-course").on("click", function (event) {
        console.log('add course clicked! ', event.target.id);
        showMe = event.target.id.substr(7);
        addNewCourse();
    });


    function addNewCourse() {
        console.log('adding new course');
        $('#add-new').innerHTML = "{% include 'addNewCourse/addNewCourse.html.twig' %}";
    }

    function addNewStudent() {
        console.log('adding new student');
        $("<div><p>text</p></div>").appendTo('#add-new');
    }

});