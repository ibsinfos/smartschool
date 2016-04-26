<div class="row">
	<div class="col-md-12">
    
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane active" id="list">
			<form action="" method="post" id="time_table_form_list" class="form-horizontal validate"> 
            <div class="form-group">
                                <label class="col-sm-1 control-label">Month</label>
                                <div class="col-sm-2">
                                 <select name="month" id="month" class="form-control">
                                 <option value="">Select Month</option>
                        		 <option value="1">January </option>
                                 <option value="2">February </option>
                                 <option value="3">March</option>
                                 <option value="4">April</option>
                                 <option value="5">May </option>
                                 <option value="6">June</option>
                                 <option value="7">July </option>
                                 <option value="8">August </option>
                                 <option value="9">Septmber </option>
                                 <option value="10">October </option>	
                                 <option value="11">November</option>	
                                 <option value="12">December </option>	
                                 
                        		 </select>
                                </div>
                                <label class="col-sm-1 control-label">Week</label>
                                <div class="col-sm-2">
                                 <select name="week" id="week" class="form-control">
                                     <option value="">Select Week</option>
                                     <option value="1">First week</option>
                                     <option value="2">Second week</option>
                                     <option value="3">Third week</option>
                                     <option value="4">Fouth week</option>
                                 </select>
                                </div>
                                <div class="col-sm-2">
                                <button type="submit" class="btn btn-info">Search</button>
                                </div>
                            </div>
                      		<div id="get_data_table"></div>
            </form>
            </div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>

<script type="text/javascript">
    function get_class_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?student/get_class_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_selection_holder').html(response);
            }
        });
    }
$("#time_table_form_list").submit(function(e){
    e.preventDefault();
	
	var month=$("#month").val();
	var week=$("#week").val();
		$.ajax({
				url: '<?php echo base_url();?>index.php?student/get_time_table_data/',
				data: { month:month,week:week},
				type: "POST",
				success: function(response)
				{
					jQuery('#get_data_table').html(response);
				}
			});		
});
</script>
<link rel="stylesheet" type="text/css" href="assets/css/jquery.timepicker.css">
<script type="text/javascript" src="assets/js/jquery.timepicker.js"></script>
