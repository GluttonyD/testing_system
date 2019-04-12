$(document).ready(function () {
    $(document).on('submit','form#question-form',function (e) {
        e.preventDefault();
        var form = $(e.target);
        var data = new FormData(this);
        var url='/question/';
        if($('#question-form').data('edit')){
            url+='edit?question_id='+$('#question-form').data('id');
        }
        else{
            url+='create';
        }
        alert(url);
        $.ajax({
            url: url, // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data:new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            dataType:'json',// To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                var errors='';
                for(var element in data){
                    errors+='<p>'+data[element][0]+'</p>';
                }
                $('#question-errors-list').html(errors);
                $('#question-error-modal').modal({ show: true });
            }
        });
    }) ;
});