	
<div class="row">
	<div class="col-md-12">
    	<!------CONTROL TABS END------>
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">	
			<!----TABLE LISTING ENDS--->
            <?php echo form_open(base_url() . 'index.php?student/student_attendance' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Select Month</label>
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
                                 </div> 
                                  <div class="form-group">
                               <label class="col-sm-2 control-label">Total Absentism Count</label>
                                <div class="col-sm-1">
                                <label class=" control-label"> <?php echo $absent_date=$this->db->get_where('attendance',array('student_id'=>$this->session->userdata('student_id'),'status'=>2))->num_rows(); ?></label>
                                </div>
                                 </div> 
                                  <div class="form-group">
                                 <label class="col-sm-2 control-label">Total Attend. Count</label>
                                <div class="col-sm-1">
                                <label class=" control-label">
                                 <?php //echo $this->db->get_where('attendance',array('student_id'=>$this->session->userdata('student_id'),'date >='=>'2015-09-01','date <='=>date("Y-m-d")))->num_rows();
								 
								$date1=date_create("2015-09-01");
								$date2=date_create(date('Y/m/d', time()));
								$diff=date_diff($date1,$date2);
								echo $total_count=$diff->format("%a");
								  ?></label>
                            </div>
                            </div>
                             <div class="form-group">
                               <label class="col-sm-2 control-label">Total Present (%) </label>
                                <div class="col-sm-1">
                                <label class=" control-label">
                                <?php 
								 $present_count=($total_count)-($absent_date);
								  $t=$present_count/$total_count*(100);
								echo number_format($t, 1, '.', '');
							 	 ?>
                                </label>
                                </div>
                           </div>   
                  	</form>  
    <div class="row" id="attendance_list">
    <div class="col-sm-offset-2 col-md-6">
        <table class="table table-bordered">
           <thead>
                <tr>
                    <td>Absent Date</td>
                     <td>Class</td>
                     <td>Description</td>
                      <td>Leave Type</td>
                </tr>
            </thead>
            <tbody id="student_attendance_listing">
						
          </tbody>
        </table>
    </div>
</div>              
                </div>                
			</div>
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
            url: '<?php echo base_url();?>index.php?student/get_classes/' + class_id ,
            success: function(response)
            {
                jQuery('#student_listing').html(response);
            }
        });
   }
 function get_month_attendance(month) {
	 
	$.ajax({
            url: '<?php echo base_url();?>index.php?student/get_student_month_attendance/' + month,
            success: function(response)
            {
				jQuery('#student_attendance_listing').html(response);
            }
       });
   }
 function get_class_attendance(class_id) {
	 
	$.ajax({
            url: '<?php echo base_url();?>index.php?student/get_student_class_attendance/' + class_id,
            success: function(response)
            {
				jQuery('#student_attendance_listing').html(response);
            }
       });
   }
function search_student_name(search_value){

 			$.ajax({
            url: '<?php echo base_url();?>index.php?student/get_month_attendance_student_name/' + search_value ,
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
