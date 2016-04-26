	
<div class="row">
	<div class="col-md-12">
    
    	<!--CONTROL TABS START-->
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
    	<!--CONTROL TABS END-->
		<div class="tab-content">            
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box" id="list">	
			<!--TABLE LISTING ENDS-->
            <?php echo form_open(base_url() . 'index.php?teacher/student_attendance/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Select Month</label>
                                <div class="col-sm-3">
                                 <select name="month" id="month" class="form-control" onchange="return get_month_attendance(this.value);">
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
                            <input type="text" class="form-control" name="student_name" id="student_name" onkeyup="search_student_name(this.value);" placeholder="Search Student"/>
                            	</div>
                            </div>
                             <div class="form-group"> 
                            <label class="col-sm-3 control-label">Select Class</label>
                                <div class="col-sm-3">
                                <select name="year" class="form-control" onchange="return get_class_attendance(this.value);">
                                <option value="">Select Class</option>
                        			<?php
									$class = $this->db->get_where('teacher_class_association',array('teacher_id'=>$this->session->userdata('teacher_id')))->result_array();
									foreach ($class as $row):
                                    ?>
                                       <option value="<?php echo $row['class_id'];?>"><?php echo $row['class_id'];?></option>
                                	<?php
                                	endforeach;
                                	?>	
                        </select>
                      		  </div>
                          </div>
                  	</form>  
    <div class="row" id="attendance_list">
    <div class="col-sm-offset-3 col-md-6">
        <table class="table table-bordered">
           <thead>
                <tr>
                    <td>Absent Date</td>
                    <td>Class</td>
                    <td>Student</td>
                    <td>Description</td>
                    <td>Leave Type</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody id="student_attendance_listing">
						
          </tbody>
        </table>
    </div>
</div>              
                </div>                
			</div>
            
			<!--CREATION FORM STARTS-->
			<div class="tab-pane box active" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?teacher/student_attendance/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                           <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Date<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control datepicker" name="date" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Class</label>
                                <div class="col-sm-3">
                                    <select name="classes" id="classes" class="form-control" style="width:100%;" onchange="return get_classes(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                    <option value="">Select Class</option>
                                   <?php
									$class = $this->db->get_where('teacher_class_association',array('teacher_id'=>$this->session->userdata('teacher_id')))->result_array();
									foreach ($class as $row):
                                    ?>
                                       <option value="<?php echo $row['class_id'];?>"><?php echo $row['class_id'];?></option>
                                	<?php
                                	endforeach;
                                	?>	
                                    </select>
                                </div>
                            </div>
                  			<div class="form-group">          
          					<label class="col-sm-3 control-label">Student</label>
								<div class="col-sm-3">
									<select class="form-control" style="width:100%;" id="student_listing" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" name="student">
                    					<option value="">Select Student</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group">          
          					<label class="col-sm-3 control-label">Description</label>
								<div class="col-sm-3">
									<textarea class="form-control" id="description" name="description" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"></textarea>
								</div>
							</div>	
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info">Mark Absent</button>
                                  <button type="reset" class="btn btn-info">Cancel</button>
                              </div>
						   </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>

<script type="text/javascript">
    $("#update_attendance").hide();
    function update_attendance() {
        $("#attendance_list").hide();
        $("#update_attendance_button").hide();
        $("#update_attendance").show();

    }
</script>
<script type="text/javascript">
function get_classes(class_id) {
   	$.ajax({
            url: '<?php echo base_url();?>index.php?teacher/get_classes/' + class_id ,
            success: function(response)
            {
                jQuery('#student_listing').html(response);
            }
        });
   }
 function get_month_attendance(month) {
	 
	$.ajax({
            url: '<?php echo base_url();?>index.php?teacher/get_student_month_attendance/' + month,
            success: function(response)
            {
				jQuery('#student_attendance_listing').html(response);
            }
       });
   }
 function get_class_attendance(class_id) {
	 
	$.ajax({
            url: '<?php echo base_url();?>index.php?teacher/get_student_class_attendance/' + class_id,
            success: function(response)
            {
				jQuery('#student_attendance_listing').html(response);
            }
       });
   }
function search_student_name(search_value){

 			$.ajax({
            url: '<?php echo base_url();?>index.php?teacher/get_month_attendance_student_name/' + search_value ,
            success: function(response)
            {
				jQuery('#student_attendance_listing').html(response);
            }
        });
}
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable();
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
	});
</script>
