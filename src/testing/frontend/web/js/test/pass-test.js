var delayed_test_questions;
var question_number=0;
$(document).ready(function () {
    $('.select2').select2();
    var question_count=$('#question_count').attr('data-count');
    $('#test-progress').css('width',parseInt(100/Number(question_count))+'%');
    $(document).on('click','#next-question',function (e) {
        e.preventDefault();
        if(question_number<question_count-1) {

            var elem_id = '#question-number-' + question_number;
            $(elem_id).css('display', 'none');
            question_number++;
            elem_id = '#question-number-' + question_number;
            $(elem_id).css('display', 'block');
            var result=parseInt(Number(question_number+1)/Number(question_count)*100);
            $('#test-progress').css('width',result+'%');
        }

    });
    $(document).on('click','#previous-question',function (e) {
        e.preventDefault();
        if(question_number>0) {

            var elem_id = '#question-number-' + question_number;
            $(elem_id).css('display', 'none');
            question_number--;
            elem_id = '#question-number-' + question_number;
            $(elem_id).css('display', 'block');
            var result=parseInt(Number(question_number+1)/Number(question_count)*100);
            $('#test-progress').css('width',result+'%');
        }
    });
});