<style>
.modal-dialog{   width:50%; }
</style>
<div class="row" id="attendance">
					<div class="col-md-12">		
						<form action="" method="post">
							<div class="form-group">
					<select name="report_list" style="width:30%;" class="form-control" id="attendance_list" style="display: none" >
                        <option value="">Select Attendance</option>
                        <option value="class_wise_attendance">Class Wise</option>
                        <option value="standard_attendance">Standard wise</option>
                        <option value="all_attendance">All</option>				
					</select>
							</div>
                          </form>	
					</div>
				</div>
                
                
                
                <div id="main_attendance" class="col-md-12"> 
                          
                          <div id="attendance_sub_1" style="display:none;"> 
                        
                          <form action="" method="post" id="class_vise" class="form-horizontal validate" >
                          <div class="form-group"> 
                          <select name="class_id" style="width:30%;" class="form-control" 
                           data-validate="required" id="attendance_list" data-message-required="<?php echo get_phrase('value_required');?>" style="display: none">
                          <option value="">Select Class</option>
                           <?php $attandance_class=$this->db->get('class')->result_array(); foreach($attandance_class as $attandance_class_row): ?>
                           <option value="<?php echo $attandance_class_row['name_numeric']; ?>"><?php echo $attandance_class_row['name_numeric']; ?> </option>
                           <?php endforeach;  ?>				
					</select>
                          </div>
                           <div class="form-group">
                                <!-- <label class="col-sm-3 control-label">From Date</label> -->
                                <div class="col-sm-4">
                                <input type="text" placeholder="From Date" name="from_date" id="from_date" class="form-control datepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- <label class="col-sm-3 control-label">To Date</label> -->
                                <div class="col-sm-4">
                                <input type="text" placeholder="To Date" name="to_date" id="to_date" class="form-control datepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />  
                                </div>
                            </div>
                          <div class="form-group">
                          	<div class="row">
										<div class="col-md-12">
											<button type="submit" class="btn btn-info">Submit</button>
										</div>
                          	</div>
						  </div> 
                          </form>
                           </div>
                           
                          <div id="attendance_sub_2" style="display:none;">
                           <form action="" method="post" id="standard_wise" class="form-horizontal validate" >
                         
                          <div class="form-group"> 
                          <select name="class_id" style="width:30%;" class="form-control" 
                           data-validate="required" id="attendance_lists" data-message-required="<?php echo get_phrase('value_required');?>" style="display: none">
                          <option value="">Select Standard</option>
                          <?php for($h=1; $h<=12; $h++){ ?>
                           <option value="<?php echo $h;?>"><?php echo $h;?></option>
                          <?php }  ?> 			
					</select>
                          </div>
                           <div class="form-group">
                                <!-- <label class="col-sm-3 control-label">From Date</label> -->
                                <div class="row">
	                                <div class="col-sm-4">
	                                <input type="text" placeholder="From Date" name="from_date" id="from_dates" class="form-control datepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
	                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- <label class="col-sm-3 control-label">To Date</label> -->
                                <div class="row">
	                                <div class="col-sm-4">
	                                <input type="text" placeholder="To Date" name="to_date" id="to_dates" class="form-control datepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />  
	                                </div>
                                </div>                                
                            </div>
                          <div class="form-group">
                          	<div class="row">
										<div class="col-md-12">
											<button type="submit" class="btn btn-info">Submit</button>
										</div>
                          	</div>
						  </div> 
                          </form>
                          </div>
                          
                           <div id="attendance_sub_3" style="display:none;"> 
                          <?php //echo form_open(base_url() . 'index.php?admin/attendance_list/all_attendance' , array('class' => 'form-horizontal validate'));?>	
                          <form action="" method="post" id="all_attendance" class="form-horizontal validate" >
                           <div class="form-group">
                                <!-- <label class="col-sm-3 control-label">From Date</label> -->
                                <div class="row">
	                                <div class="col-sm-4">
	                                <input type="text" placeholder="From Date" name="from_date" id="from_dateall" class="form-control datepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
	                                </div>
                                </div>                                
                            </div>
                            <div class="form-group">
                                <!-- <label class="col-sm-3 control-label">To Date</label> -->
                                <div class="row">
	                                <div class="col-sm-4">
	                                <input type="text" placeholder="To Date" name="to_date" id="to_dateall" class="form-control datepicker" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />  
	                                </div>
                                </div>                                
                            </div>
                          <div class="form-group">
                          	<div class="row">
										<div class="col-md-12">
											<button type="submit" class="btn btn-info">Submit</button>
										</div>
                          	</div>
						  </div> 
                          </form>
                           </div>
                          </div>
<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          
                 <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                   
                        <tr><td colspan="11" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="11" style="font-size:1.2em; text-align:center; font-weight:600;  color:#FFF;">Student Absent Listing</td></tr>
                         <tr bgcolor="#000000"><td colspan="11" style="font-size:1.0em; text-align:center; font-weight:600;  color:#FFF;"> <?php echo ucwords('Date : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.date("F d, Y",strtotime( $from_date)).' To '.date("F d, Y",strtotime( $to_date)).'</span>'); ?></td></tr>
                		
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; border-right:1px solid #EEE;   text-align:center;" >Roll no</th>
                            <th style="color:#FFF;  border-right:1px solid #EEE;   text-align:center;">Class Name</th>
                    		<th style="color:#FFF;  border-right:1px solid #EEE;   text-align:center;">Student Name</th>
                    		<th style="color:#FFF;  border-right:1px solid #EEE;  text-align:center;" >Absent Date</th>  
                              <th style="color:#FFF;  border-right:1px solid #EEE; text-align:center;" >Reason for Absence</th> 							
                            <th style="color:#FFF; border-right:1px solid #EEE;text-align:center;"  >Type of Leave</th> 
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						
						/* $this->db->join('student', 'student.student_id= attendance.student_id');
						 $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($from_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'"');
						$this->db->where('status',2);
						$attendance = $this->db->get('attendance')->result_array();*/
						//echo $this->db->last_query(); die;
						$attendance  = $this->db->query("SELECT * FROM attendance JOIN student ON student.student_id= attendance.student_id WHERE attendance.date BETWEEN '". date('Y-m-d', strtotime($from_date))."' and '". date('Y-m-d', strtotime($to_date))."' AND attendance.status= 2")->result_array();
						
						//echo $this->db->last_query(); die;
						$count = 1;foreach($attendance as $row_attendance):
						?>
                        <tr>
                            <td valign="middle" align="center"  style="font-size:13px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" ><?php echo $row_attendance['roll'];?></td>
                            <td valign="middle" align="center" style="font-size:13px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $row_attendance['attandence_class'];?></td>							
							<td valign="middle" align="center" style="font-size:13px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $row_attendance['name'].' '.$row_attendance['father_name'] ;?></td>
							<td valign="middle" align="center" style="font-size:13px; line-height:18px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" ><?php echo date("F d, Y",strtotime( $row_attendance['date']));?></td>							
                             <td valign="middle" align="center" style="font-size:13px; line-height:18px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row_attendance['description'];?></td>							
                            <td valign="middle" align="center" style="font-size:13px; line-height:18px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row_attendance['leave_type'];?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
					
                </table>
                 <?php 
				 if($attendance > 0){
				 echo form_open(base_url() . 'index.php?admin/attendance_pdf/all_attendance' , array('class' => 'form-horizontal validate'));?>	
                   <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
                  <input type="hidden" name="from_date" value="<?php echo $from_date; ?>" />
                  <input type="hidden" name="to_date" value="<?php echo $to_date; ?>" />
                 <div class="form-group">
                 	<div class="row">
										<div class="col-md-12">
											<button type="submit" class="btn btn-info">Export To Pdf</button>
										</div>
                 	</div>
						  </div> 
                          </form>
                 <?php } ?>
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>


                 <script type="text/javascript">
     $(function () {
		 
		  $("#class_vise").submit(function(){
			 var data = $("#class_vise").serialize();
			 
			 
			 var attendance_list = $("#attendance_list").val();
			 var from_date = $("#from_date").val();
			 var to_date = $("#to_date").val();
			 
			 if(attendance_list=="" || from_date=="" || to_date=="")
			 {
				return false;	 
			}
				
			
			//var data = encodeURIComponent(data);
			// alert(data);
			 showAjaxModal('<?php echo base_url();?>index.php?modal/popup2/attendance_class_wise_list/',data);
				return false;
			 
			 });
			 
			 $("#standard_wise").submit(function(){
				  var data = $("#standard_wise").serialize();
				  
				   var attendance_lists = $("#attendance_lists").val();
			 var from_dates = $("#from_dates").val();
			 var to_dates = $("#to_dates").val();
			 
				 if(attendance_lists=="" || from_dates=="" || to_dates=="")
				 {
					return false;	 
				 }
				
				 // alert(data);
				  showAjaxModal('<?php echo base_url();?>index.php?modal/popup2/attendance_standard_list/',data);
				  return false;
			 });
			 $("#all_attendance").submit(function(){
				  var data = $("#all_attendance").serialize();
				  var to_dateall = $("#to_dateall").val();
				  var from_dateall = $("#from_dateall").val();
				  
				 if(from_dateall=="" || to_dateall=="")
				 {
					return false;	 
				 }
				
				 // alert(data);
				  showAjaxModal('<?php echo base_url();?>index.php?modal/popup2/all_attendance_list/',data);
				  return false;
			 });
			 
		 
			 
		 

        });
		
		
	 $(function () {
            $("#attendance_list").change(function () {
					 if($("#attendance_list").val()=="class_wise_attendance"){
						  $("#attendance_sub_1").show();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						  $("#attendance").show();
						
					}
					else if($("#attendance_list").val()=="standard_attendance"){
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").show();
						  $("#attendance_sub_3").hide();
						  $("#attendance").show();
						
					}
					else if($("#attendance_list").val()=="all_attendance"){
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").show();
						  $("#attendance").show();
						 
					}
				});
        });
		
		 
		
		 
    </script>



<script type="text/javascript">
$('.datepicker').datepicker({
    format: "mm/dd/yyyy",
    autoclose: true,
}).on('changeDate', function (ev) {
    $(this).datepicker('hide');
});;
</script>