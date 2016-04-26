<style>
.modal-dialog{   width:50%; }
</style>
<div class="row" id="attendance">
					<div class="col-md-12">		
						<div id="attendance_sub_1"> 
                        
                          <form action="" method="post" id="staff_attend" class="form-horizontal validate" >
                          <div class="form-group"> 
                          <select name="month" style="width:30%;" class="form-control" 
                           data-validate="required" id="month" data-message-required="<?php echo get_phrase('value_required');?>" >
                          	  <option value="">Select Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
					</select>
                          </div>
                          <div class="form-group">
										<div class="col-sm-offset-3 col-sm-5">
											<button type="submit" class="btn btn-info">Submit</button>
										</div>
						  </div> 
                          </form>
                           </div>
                          	
					</div>
				</div>
              
<?php if(isset($month)){ ?>
<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
                <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                  
                        <tr><td colspan="4" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="5" style="font-size:1.2em; text-align:center; font-weight:600;  color:#FFF;">Staff Attendance Listing</td></tr>
                		<tr bgcolor="#000000" style="border-top:1px solid #EEE;">
                            <td colspan="5" style="font-size:1.0em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">
                            <?php 
							//echo date('F');
							
							
							
							
						if($month=="01")
						{
							$monthname = "January";	
						}
						if($month=="02")
						{
							$monthname = "February";	
						}
						if($month=="03")
						{
							$monthname = "March";	
						}
						if($month=="04")
						{
							$monthname = "April";	
						}
						if($month=="05")
						{
							$monthname = "May";	
						}
						if($month=="06")
						{
							$monthname = "June";	
						}
						if($month=="07")
						{
							$monthname = "July";	
						}
						if($month=="08")
						{
							$monthname = "August";	
						}
						if($month=="09")
						{
							$monthname = "September";	
						}
						if($month=="10")
						{
							$monthname = "October";	
						}
						if($month=="11")
						{
							$monthname = "November";	
						}
						if($month=="12")
						{
							$monthname = "December";	
						}
				echo ucwords("Month : <span style='text-align:right;color:#2092D0;font-size:1.2em;font-weight:600;'>".$monthname ."</span>"); ?>
                            </td>
                        </tr>
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; border-right:1px solid #EEE;   text-align:center;" >No</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE;   text-align:center;" >Absent Date</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center;" >Staff</th> 				
                            <th style="color:#FFF; border-right:1px solid #EEE;  text-align:center;">Reason for Absence</th> 							
                            <th style="color:#FFF; border-right:1px solid #EEE;text-align:center;" >Type of Leave</th> 
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						$array = array("attendance.status"=>2,"attendance.teacher_id !="=>0,'attendance.month'=>$month);
						$this->db->select('*');
						$this->db->from('attendance');
						$this->db->join('teacher', 'teacher.teacher_id = attendance.teacher_id');
						$this->db->where($array);
						$this->db->order_by("date",'ASC');
						$query = $this->db->get();
						$attendance =$query->result();
						$count = 1;
						
						foreach($attendance as $att_row):						
						?>
                        <tr>
                            <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" ><?php echo $count++;?></td>
							<td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"  ><?php echo date("F d, Y",strtotime( $att_row->date));?></td>
							<td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $att_row->name;?></td>
                            <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $att_row->description;?></td>
                               <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $att_row->leave_type;?></td>
                        </tr>
                       <?php 						
						endforeach;  
						
						?>	
						
                    </tbody>
                    
                    	
                </table>
                <?php 
				if(count($attendance) > 0){
				
				echo form_open(base_url() . 'index.php?admin/staff_attendence_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
									
									<div class="form-group">
                                    <input type="hidden" name="month" value="<?php echo $month; ?>" />
										<div class="col-sm-offset-3 col-sm-5">
											<button type="submit" class="btn btn-info">Export To Pdf</button>
										</div>
									</div> 
								</form>	
                                <?php } ?>
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>
<?php } ?>

<script type="text/javascript">
$(document).ready(function() {
	
	$("#staff_attend").submit(function(){
		var month = $("#month").val();
		var data = "month="+month;
		showAjaxModal('<?php echo base_url();?>index.php?modal/staffattendance/staff_attendence_list/',data);
				return false;
	});
    
});
</script>



