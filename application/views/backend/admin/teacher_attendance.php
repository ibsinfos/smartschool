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
            url: '<?php echo base_url();?>index.php?admin/get_teacher_month_attendance/' + month ,
            success: function(response)
            {
				jQuery('#teacher_attendance_data').html(response);
            }
        });
}
function search_teacher_name(search_value){
			
			if(search_value=="")
			{
				jQuery('#teacher_attendance_data').html('');
			}
		
 			$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_month_attendance_teacher_name/' + search_value ,
            success: function(response)
            {
				jQuery('#teacher_attendance_data').html(response);
            }
        });
}
</script>
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					 Enter Attendance 
                    	</a></li>
            <li>
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					Attendance Listing
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box" id="list">	
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
                            <input type="text" class="form-control" name="teacher_name" id="teacher_name" onkeyup="search_teacher_name(this.value);" placeholder="Search by staff name"/>
                            	</div>  
                            
                            </div>
                            
                            
                  	</form>  
    <div class="row" id="attendance_list" >
    <div class="col-sm-offset-1 col-sm-10">
     <form action="<?php echo  base_url().'index.php?admin/delete_staffattend'; ?>" method="post">	
     <div id="teacher_attendance_data">
     </div>
        
        </form>
    </div>
</div>              
                </div>                
			</div>
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box active" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/teacher_attendance/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                        <div class="mandatory"><i>Enter Absentism Only</i></div>
                        <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Date<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control datepicker" name="date" data-validate="required" data-message-required="Date is required"/>
                                </div>
                            </div>
                              
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Staff<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                    <select name="staff" id="staff" class="form-control" style="width:100%;" data-validate="required" data-message-required="Staff is required">
                                    <option value="">Select Teacher</option>
                                   <?php
									$teacher = $this->db->get('teacher')->result_array();
									foreach ($teacher as $row):
                                    ?>
                                       <option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
                                	<?php
                                	endforeach;
                                	?>	
                                    </select>
                                    
                                </div>
                            </div>
                  			<div class="form-group">          
          					<label class="col-sm-3 control-label">Description<span class="mandatory">*</span></label>
								<div class="col-sm-3">
									<textarea class="form-control" id="description" name="description" data-validate="required" data-message-required="Description is required"></textarea>
								</div>
							</div>	
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info">Mark Absent</button>
                                  <button type="button" class="btn btn-info" onClick="window.location.reload()">Cancel</button>
                              </div>
						   </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->  

<script>
 jQuery(document).ready(function() {
	 jQuery("#deletesall").click(function(){
		 var student_length =  $(".checkbox1:checked").length;
		
		   if(student_length < 1)
			{
				 alert('Please select at least one!');
				return false;	 
			}
	 			var r = confirm("Do you want to delete selected data?");
								
								if (r == true) {
									
								} else {
								
								   return false;
								}		
								});
  jQuery('#selecctall').click(function(event) {  
  
								
 
   if(this.checked) { 
    jQuery('.checkbox1').each(function() { 
     this.checked = true;          
    });
    }else{
    jQuery('.checkbox1').each(function() { 
     this.checked = false;               
    });         
   }
  });
  
  jQuery(".checkbox1").click(function(){
   if($(".checkbox1").length == $(".checkbox1:checked").length) {
    jQuery("#selecctall").prop("checked",true);
    } else {
    jQuery("#selecctall").prop("checked",false);
   }
   
  }); 
  
 });
</script>

>