$(document).ready(function () {
    $(document).on('click','.delete-test',function (e) {
        e.preventDefault();
        var element='#test-'+e.target.id;
        $.ajax({
            url: '/test/delete', // Url to which the request is send
            type: "GET",             // Type of request to be send, called as method
            data:{id:e.target.id}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            success: function (data)   // A function to be called if request succeeds
            {
                alert('deleted');
                $(element).remove(element);
            }
        });
    });
});