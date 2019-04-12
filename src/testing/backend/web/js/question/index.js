$(document).ready(function () {
    $('#answers-modal').modal({ show: false }) ;

    $(document).on('click','.show-question-answers',function (e) {
        e.preventDefault();
        $.ajax({
            url: '/question/get-answers', // Url to which the request is send
            type: "GET",             // Type of request to be send, called as method
            data:{question_id:e.target.id}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: true,
            dataType: 'json',// To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                console.log(data);
                var i;
                var answers_modal='';
                answers_modal+='<ol>';
                for(i=0;i<data['answers'].length;i++){
                    answers_modal+='<li>'+data['answers'][i]['text'];
                    if(data['answers'][i]['is_right']==1){
                        answers_modal+='<span class="fa fa-check"></span>';
                    }
                    answers_modal+='</li>';
                }
                answers_modal+='</ol>';
                answers_modal+='<p>'+'Статистика вопроса'+'</p>';
                answers_modal+='<dl>';
                answers_modal+='<dt>Ответов на вопрос</dt>';
                answers_modal+='<dd>'+data['answers_count']+'</dd>';
                answers_modal+='<dt>Правильных ответов</dt>';
                answers_modal+='<dd>'+data['right_answers_count']+'</dd>';
                answers_modal+='</dl>';
                console.log(answers_modal);
                $('.modal-body').html(answers_modal);
            }
        });
    });
    $(document).on('click','.delete-question',function (e) {
        e.preventDefault();
        alert('wow');
        var element='#question-'+e.target.id;
        $.ajax({
            url: '/question/delete', // Url to which the request is send
            type: "GET",             // Type of request to be send, called as method
            data:{question_id:e.target.id}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            success: function (data)   // A function to be called if request succeeds
            {
                alert('deleted');
                $(element).remove(element);
            }
        });
    });
});

