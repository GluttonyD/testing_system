var section_count=0;
var sections;
$(document).ready(function () {
    getSections();
    $(document).on('click','#add-test-section',function (e) {
        e.preventDefault();
        section_count++;
        var i=0;
        var input='';
        var select_id='test-section-'+section_count
        input+='<div id="section-'+section_count+'" class="row">';
        input+='<div class="form-group col-md-9">';
        input+='<label for="test-section">Название раздела</label>';
        input+='<select  id="'+select_id+'" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="TestForm[questions]['+section_count+'][section_id]">';
        for(i=0;i<sections.length;i++){
            input+='<option value="'+sections[i]['id']+'">'+sections[i]['name']+'</option>'
        }
        input+='</select>';
        input+='</div>';
        input+='<div class="form-group col-md-3">';
        input+='<label for="test-question-count">Количество</label>';
        input+='<input type="text" id="test-question-count" class="form-control" name="TestForm[questions]['+section_count+'][count]">';
        input+='</div>';
        input+='</div>';
        $('#test-sections').append(input);
        $('#'+select_id).select2();

    });

    $(document).on('click','#remove-test-section',function (e) {
        e.preventDefault();
        if(section_count>0) {
            var section_id = '#section-' + section_count;
            $(section_id).remove(section_id);
            section_count--;
        }
    });

    $(document).on('submit','form#test-form',function (e) {
        e.preventDefault();
        var form = $(e.target);
        var data = new FormData(this);
        $.ajax({
            url: '/test/create', // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data:new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            dataType:'json',// To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                console.log(data);
                var errors='';
                for(var element in data){
                    errors+='<p>'+data[element][0]+'</p>';
                }
                $('#test-errors-list').html(errors);
                $('#test-error-modal').modal({ show: true });
            }
        });
    }) ;
});

function getSections() {
    $.ajax({
        url: '/test/get-sections', // Url to which the request is send
        type: "GET",             // Type of request to be send, called as method
        data:{}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData: true,
        dataType: 'json',// To send DOMDocument or non processed data file it is set to false
        success: function (data)   // A function to be called if request succeeds
        {
            sections=data;
        }
    });
}