$(document).ready(function () {
    $('#detail-modal').modal({ show: false }) ;

    $(document).on('click','.show-passed-details',function (e) {
        e.preventDefault();
        $.ajax({
            url: '/completed-test/get-details', // Url to which the request is send
            type: "GET",             // Type of request to be send, called as method
            data:{passed_id:e.target.id}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: true,
            dataType: 'json',// To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                console.log(data);
                var i;
                var details_modal='';
                details_modal+='<ol>';
                for(i=0;i<data.length;i++){
                    details_modal+='<li>'+data[i]['question_text']+"  ";
                    if(data[i]['is_right']=="1"){
                        details_modal+='<b>Правильно</b>';
                    }
                    else{
                        details_modal+='<b>Не правильно</b>';
                    }
                    // details_modal+='   '+(data[i]['is_right']==0)?'<b>Не правильно</b>':'<b>Правильно</b>';
                    details_modal+='</li>';
                }
                console.log(details_modal);
                $('.modal-body').html(details_modal);
            }
        });
    });
});

