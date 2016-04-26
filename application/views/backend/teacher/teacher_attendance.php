	
<div class="row">
	<div class="col-md-12">
    
    	
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">	
			<!----TABLE LISTING ENDS--->
            <?php echo form_open(base_url() . 'index.php?admin/teacher_attendance/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Select Month</label>
                                <div class="col-sm-3">
                                 <select name="month" class="form-control" onchange="return get_month_attendance(this.value);">
                                 <option value="">Select Month</option>
                        		 <option value="01">January </option>
                                 <option value="02">February </option>
                                 <option value="03">March</option>
                                 <option value="04">April</option>
                                 <option value="05">May </option>
                                 <option value="06">June</option>
                                 <option value="07">July </option>
                                 <option value="08">August </option>
                                 <option value="09">Septmber </option>
                                 <option value="10">October </option>	
                                 <option value="11">November</option>	
                                 <option value="12">December </option>	
                                 
                        		 </select>
                                 
                                </div>
                                <div class="col-sm-3">
                            <input type="text" class="form-control" name="teacher_name" id="teacher_name" onkeyup="search_teacher_name(this.value);" placeholder="Search Staff"/>
                            	</div>  
                            
                            </div>
                            
                            
                  	</form>  
    <div class="row" id="attendance_list" >
    <div class="col-sm-offset-3 col-md-6">
        <table class="table table-bordered datatable">
           <thead>
                <tr>
                    <td>Absent Date</td>
                    <td>Staff</td>
                </tr>
            </thead>
            <tbody id="teacher_attendance_listing">
					
          </tbody>
        </table>
    </div>
</div>              
                </div>                
			</div>
		</div>
	</div>
</div>
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->  
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable();
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
	});
	
function get_month_attendance(month) {
	 
	$.ajax({
            url: '<?php echo base_url();?>index.php?teacher/get_teacher_month_attendance/' + month ,
            success: function(response)
            {
				jQuery('#teacher_attendance_listing').html(response);
            }
        });
}
function search_teacher_name(search_value){

 			$.ajax({
            url: '<?php echo base_url();?>index.php?teacher/get_month_attendance_teacher_name/' + search_value ,
            success: function(response)
            {
				jQuery('#teacher_attendance_listing').html(response);
            }
        });
}


jQuery(document).ready(function($)
	{
		$.ajax({
            url: '<?php echo base_url();?>index.php?teacher/get_month_attendance_teacher_name/',
            success: function(response)
            {
				jQuery('#teacher_attendance_listing').html(response);
            }
	
	});
	});
	

</script>
