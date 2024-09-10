$(function () { 
    $(".datepicker").datepicker({  
        format: 'yyyy-mm-dd',
        autoclose: true,
    });
    if (!$(".datepicker").val()) {
      $(".datepicker").datepicker('setDate', new Date());
  }
});