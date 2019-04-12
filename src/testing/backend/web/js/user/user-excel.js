$(document).ready(function () {
    $(document).on('click','#choose-excel-file',function (e) {
        e.preventDefault();
        $('#excel-file').click();
    });
    $(document).on('change', '#excel-file', function (e) {
        $('#file-input-flag').css('display', 'inline');
    });
});