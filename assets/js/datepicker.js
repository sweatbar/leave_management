$('#sandbox-container .input-append.date').datepicker({
});

$(document).ready(function(){
    var date_input=$('input[name="leave_date"]'); //our date input has the name "date"
    var container=$('#userModal').parent();
    var options={
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    };
    date_input.datepicker(options);
  })