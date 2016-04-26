<style>
.DTTT.btn-group{display:none;}
</style>
	<p id="renderingEngineFilter"></p>
            <div class="panel-body">
            <div class="form-group">
            <div class="col-sm-3">
            <form action="" method="post" id="search_dropdown">
           	<select class="form-control" name="year" id="year" onchange="return get_staff_list(this.value);">
            	<option value="">Select year</option>
                <option value="2016">2015-2016</option>
                <option value="2017">2016-2017</option>
                <option value="2018">2017-2018</option>
                <option value="2019">2018-2019</option>
            </select>
            </div>
             <div class="col-sm-3">
           	<select class="form-control" name="staff_name" id="staff_name">
            	<option value="">Select Staff</option>
            </select>
             </div>
              <div class="col-sm-3">
            <button type="submit" class="btn btn-info" name="search_dropdown" id="search_dropdown">Search</button>
            </div>
            </form>
            </div>
          </div>
          <div id="history_staff_detail_individual"></div>

<!---  DATA TABLE EXPORT CONFIGURATIONS -->                      
<script type="text/javascript">
 function get_staff_list(year){
		    $.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_history_staff/'+year,
				success: function(response)
				{
					jQuery('#staff_name').html(response);
				}
			});
	 }
	 
// After Submit 	 
$( document ).ready(function() {	 
$("#search_dropdown").submit(function( event ) {
	event.preventDefault();
  var year=$("#year").val();
  var staff_name=$("#staff_name").val();
  $.ajax({
		url: '<?php echo base_url();?>index.php?admin/history_staff_detail_individual/',
		data: {year: year,staff_name:staff_name},
		type: "POST",
		success: function(response)
		{
			jQuery('#history_staff_detail_individual').html(response);
		}
	});		
});
});

</script>


