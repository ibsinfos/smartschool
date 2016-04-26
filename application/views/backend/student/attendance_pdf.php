
<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          <?php  if(isset($month)){ ?>
                <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                   <tr>
                            <td colspan="4">
                                <table width="100%">
                                    <tr>
                                        <td width="33.33%"  valign="middle" align="left";><div><?php  $image = base_url().'/uploads/system_image/1.jpg'; ?>
                                        <img src="<?php echo $image; ?>" width="80" height="70" /></div></td>
                                        <td width="33.33%" valign="middle" align="center"><div style="font-size:1.8em; text-align:center; font-weight:600; color:#000;">Page Inc School</div></td>
                                        <td width="33.33%" valign="bottom" align="right" style="font-size:12px;"><div>Date : <?php echo date('jS M Y'); ?> </div></td>     
                                    </tr>
                                </table>
                            </td>
                    </tr>
                        <tr><td colspan="4" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="4" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Attendance Listing</td></tr>
                		<tr bgcolor="#000000"><td colspan="4" style="font-size:1.0em; text-align:center; font-weight:600;  color:#FFF;  padding:6px 0px;"> <?php  echo ucwords('Month : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.date('F', mktime(0, 0, 0, $month, 10)).'</span>'); ?></td></tr>
                      <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; padding:6px 0px; text-align:center; border-right:1px solid #EEE; width:5%; ">No</th>                    		
                            <th style="color:#FFF; padding:6px 0px; text-align:center; border-right:1px solid #EEE; width:35%;">Reason for Absence</th>
                            <th style="color:#FFF; padding:6px 0px; text-align:center; border-right:1px solid #EEE; width:35%;">Type of Leave</th>
                            <th style="color:#FFF; padding:6px 0px; text-align:center; border-right:1px solid #EEE; width:25%;">Date</th>
             
						</tr>
                       
					</thead>
                    <tbody>
                    	<?php 
                       
                        $std_id = $this->session->userdata('student_id');
                        //echo $monthname;
						$this->db->order_by('attendance.date','asc');
                        $this->db->select('attendance.*');
                        $this->db->join('student','student.student_id = attendance.student_id');
                        $this->db->where(array('attendance.student_id'=>$std_id,'attendance.month'=>$month));
                        //$this->db->group_by('attendance.month');
                       // $this->db->order_by('attendance.month', 'ASC');
                        //$this->db->group_by('attendance.teacher_id');
                        $attendances = $this->db->get('attendance')->result_array();
						
                        $count = 1;
                        
                        foreach($attendances as $rows):?>
                        <tr>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;width:5%;"><?php echo $count++;?></td>                                                   
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;width:35%;"><?php echo $rows['description']; ?></td>
                             <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;width:35%;"><?php echo $rows['leave_type']; ?></td>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;width:25%;"><?php echo $rows['date']?></td>                        
                        </tr>
                       <?php                       
                        endforeach;
                       ?>   
                    </tbody>
                </table>
                <?php } ?>
                    </tbody>
                    
                     <tr align="right">
                        <td valign="middle" align="right" colspan="4" style="padding:12px 0px; border-top:2px solid #2092D0; font-size:10px; width:100%;"><span style="color:#2092D0;">Generated By : </span> <?php echo $this->session->userdata('name');?> </td>
                     </tr>

                </table>
                
			</div>
            <!---TABLE LISTING ENDS-->
		</div>
	</div>
</div>



