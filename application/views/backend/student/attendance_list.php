<div class="row" id="attendance_list">
					<div class="col-md-12">	
						<div class="tabs-vertical-env">
							<div class="tab-content">
								<?php echo form_open(base_url() . 'index.php?student/attendance' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
									<div class="form-group">
										<label class="col-sm-3 control-label">Month</label>
									</div>	
									<div class="clearfix">
										<select name="report_month" style="width:30%;" class="form-control" id="attendance_list1">
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
										<div class="col-md-12 text-left">
											<button type="submit" class="btn btn-info">Submit</button>
										</div>
									</div> 
								</form>	
							</div>		
						</div>
					</div>
				</div>
              <?php  if(isset($month)){?>
          <div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
                <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" 
                id="table_export">
                	<thead>                   		
                        <tr><td colspan="4" style="height:15px;"></td></tr>                        
                        <tr bgcolor="#000000"><td colspan="4" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Attendance Listing</td></tr>
                		<tr bgcolor="#000000"><td colspan="4" style="font-size:1.0em; text-align:center; font-weight:600;  color:#FFF;  padding:6px 0px;"> <?php  echo ucwords('Month : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.date('F', mktime(0, 0, 0, $month, 10)).'</span>'); ?></td></tr>
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; padding:6px 0px; text-align:center; border-right:1px solid #EEE;">No</th>                    	
                            <th style="color:#FFF; padding:6px 0px; text-align:center; border-right:1px solid #EEE;">Reason of Absentism</th>
                            <th style="color:#FFF; padding:6px 0px; text-align:center; border-right:1px solid #EEE;">Type of Leave</th>
                            <th style="color:#FFF; padding:6px 0px; text-align:center; border-right:1px solid #EEE;">Date</th>                       
						</tr>                       
					</thead>
                   <tbody>
                    	<?php                        
                        $std_id = $this->session->userdata('student_id');
						$this->db->order_by('attendance.date','asc');
                        $this->db->select('attendance.*');
                        $this->db->join('student','student.student_id = attendance.student_id');
						$this->db->join('class','class.name_numeric=attendance.attandence_class');
                        $this->db->where(array('attendance.student_id'=>$std_id,'attendance.month'=>$month,'status'=>'2'));
                        $attendances = $this->db->get('attendance')->result_array();
                        //print_r($attendances);
						if(!empty($attendances))
						{
							//echo "test if";
						}else{
							echo "<script>alert('Attendace is not exist');return false;</script>";
							die;													
						} 
						$count = 1;
                        foreach($attendances as $rows):
						?>
                        <tr>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $count++;?></td>                          <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $rows['description']; ?></td>
                             <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $rows['leave_type']; ?></td>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo date("F d, Y",strtotime($rows['date']));?></td>
                         
                        </tr>
                       <?php                       
                        endforeach;
                       ?>
                        <tr>
                        <td valign="middle" align="right" colspan="4" style="padding:12px 0px; border-top:2px solid #2092D0; font-size:10px;"><span style="color:#2092D0;">Generated By : </span> <?php echo $this->session->userdata('name');?> </td>
                        </tr>

                    </tbody>
                    
                    
                </table>
                  <?php echo form_open(base_url() . 'index.php?student/attendance_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
									<div class="form-group">
										<input type="hidden" name="report_month" value="<?php  echo $month; ?>" />
									</div>	
									<div class="form-group">
										<div class="col-md-12 text-center">
											<button type="submit" class="btn btn-info">Export To Pdf</button>
										</div>
									</div> 
								</form>
              
			</div>
            <!---TABLE LISTING ENDS-->
		</div>
	</div>
</div>
<?php }?>
                
<script type="text/javascript">
$('.datepicker').datepicker({
    format: "mm/dd/yyyy",
    autoclose: true,
}).on('changeDate', function (ev) {
    $(this).datepicker('hide');
});;
</script>