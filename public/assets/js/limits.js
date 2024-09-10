$(document).ready(function() {
    const limitInput = $('#limit');
    const limitCheckbox = $('#limitCheckbox');


    limitCheckbox.on('change', function () {
       $(this).is(':checked') ? limitInput.prop('disabled', false) : (limitInput.prop('disabled', true) && $('#limit').val(""));

})
});