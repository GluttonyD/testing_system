var test_questions_count = $('.test-edit-form').data('count');
var questions;

$(document).ready(function () {
    getQuestions();
    $(document).on('click', '#add-test-question', function (e) {
        e.preventDefault();
        console.log(questions);
        alert(test_questions_count);
        var list = '';
        test_questions_count++;
        list += '<div id="test-item-'+test_questions_count+'">';
        list+='<label for="test-question-'+test_questions_count+'">Текст вопроса</label>';
        list+='<select id="test-question-'+test_questions_count+'" class="form-control select2 select2-hidden-accessible"' +
            ' style="width: 100%;" tabindex="-1" aria-hidden="true"' +
            ' name="EditTestForm[question_list]['+test_questions_count+']">';
        for(var i=0;i<questions.length;i++){
            list+='<option value="'+questions[i]['id']+'">'+questions[i]['text']+'</option>';
        }
        list+='</select>';
        list += '</div>';
        $('#test-question-list').append(list);
        $(".select2").select2();
});
$(document).on('click', '#remove-test-question', function (e) {
    e.preventDefault();
    alert('wow');
    if(test_questions_count>0) {
        var item = '#test-item-' + test_questions_count;
        $(item).remove(item);
        test_questions_count--;
    }
});
})
;

function getQuestions() {
    $.ajax({
        url: '/question/get-question-list', // Url to which the request is send
        type: "GET",             // Type of request to be send, called as method
        data: {}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData: true,
        dataType: 'json',// To send DOMDocument or non processed data file it is set to false
        success: function (data)   // A function to be called if request succeeds
        {
            questions = data;
            console.log(questions);
        }
    });
}