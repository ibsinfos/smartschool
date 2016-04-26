<div class="row">
	<div class="col-md-12">
    
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane active" id="list">
			<form action="" method="post" id="time_table_form_list" class="form-horizontal validate"> 
            <div class="form-group">
                                 <label class="col-sm-1 control-label">Student</label>
                                <div class="col-sm-2">
                                    <select name="student_name" id="student_name" class="form-control" style="width:100%;" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                    <option value="">Select Student</option>
                                   <?php 
								   		$this->db->select('student.student_id,student.name,student.class_id');
										$this->db->join('parent', 'parent.parent_email = student.parent_email');
										$this->db->group_by('student.student_id');
										$this->db->where('student.parent_email',$this->session->userdata('parent_email'));
										$parent_query=$this->db->get('student')->result();
										
									foreach ($parent_query as $parent_row): ?>
									<option value="<?php echo $parent_row->class_id;?>"><?php echo $parent_row->name;?></option>
                                	<?php endforeach; ?>	
                                     </select>
                                </div>
                                <label class="col-sm-1 control-label">Month</label>
                                <div class="col-sm-2">
                                 <select name="month" id="month" class="form-control" onchange="return weekCount(this.value);">
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
                                 <select name="week" id="week" class="form-control" >
                                     <option value="">Select Week</option>
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
            url: '<?php echo base_url();?>index.php?parents/get_class_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_selection_holder').html(response);
            }
        });
    }
$("#time_table_form_list").submit(function(e){
    e.preventDefault();
	
	var student_name=$("#student_name").val();
	var month=$("#month").val();
	var week=$("#week").val();
		$.ajax({
				url: '<?php echo base_url();?>index.php?parents/get_time_table_data/',
				data: { student_name:student_name,month:month,week:week},
				type: "POST",
				success: function(response)
				{
					jQuery('#get_data_table').html(response);
				}
			});		
});
function weekCount(month_number) {
 var year='2016';
    var firstOfMonth = new Date(year, month_number-1, 1);
    var lastOfMonth = new Date(year, month_number, 0);
    var used = firstOfMonth.getDay() + lastOfMonth.getDate();
    var week = Math.ceil( used / 7);
 $('#week').find('option:not(:first)').remove();
 for(var i=1; i<=week;i++){
 
 $("#week").append('<option value='+i+'>'+i+'</option>');
  
 }
}
</script>
<link rel="stylesheet" type="text/css" href="assets/css/jquery.timepicker.css">
<script type="text/javascript" src="assets/js/jquery.timepicker.js"></script>
