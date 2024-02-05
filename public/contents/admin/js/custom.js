//Success and Error Message Timeout Code Start
setTimeout(function() {
    $('.alert_success').slideUp(1000);
 },5000);

setTimeout(function() {
    $('.alert_error').slideUp(1000);
 },10000);

 //Modal code start
$(document).ready(function(){
	$(document).on("click","#softDelete",function(){
		 var deleteID = $(this).data('mamun');
		 $(".modal_body #modal_id").val( deleteID );
	});

  $(document).on("click", "#restore", function () {
		 var restoreID = $(this).data('id');
		 $(".modal_body #modal_id").val( restoreID );
	});

  $(document).on("click", "#delete", function () {
		 var deleteID = $(this).data('id');
		 $(".modal_body #modal_id").val( deleteID );
	});
});

//datatable code start
$(document).ready(function() {
  $('#myTable').DataTable();

  $('#alltableinfo').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": false
  });

  $('#allTableDesc').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "order": [[ 0, "desc" ]],
    "info": true,
    "autoWidth": false
  });
  $('#summary').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "order": [[0,'asc']],
    "info": true,
    "autoWidth": false
  });
});

//Datepicker setting code start
 $(function(){
	 $('#date').datepicker({
		  autoclose: true,
		  format: 'dd-mm-yyyy',
		  todayHighlight: true
	 });

	 $('#startDate').datepicker({
		  autoclose: true,
		  format: 'yyyy-mm-dd',
		  todayHighlight: true
	 });

   $('#endDate').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    todayHighlight: true
 });
});
