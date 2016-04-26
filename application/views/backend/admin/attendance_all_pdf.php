<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          
                 <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                   <tr>
                            <td colspan="6">
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
                        <tr><td colspan="6" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="6" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Student Absent Listing</td></tr>
                        
                         <tr bgcolor="#000000"><td colspan="11" style="font-size:1.0em; text-align:center; font-weight:600;  color:#FFF;  padding:6px 0px;"> <?php echo ucwords('Date : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.date("F d, Y",strtotime( $from_date)).' To '.date("F d, Y",strtotime( $to_date)).'</span>'); ?></td></tr>                       
                		
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; padding:6px 2px; border-top:1px solid #eee;" width="11%">Roll no</th>
                            <th style="color:#FFF; padding:6px 2px; border-top:1px solid #eee;" width="22%">Class Name</th>
                    		<th style="color:#FFF; padding:6px 2px; border-top:1px solid #eee;" width="22%">Student Name</th>
                    		<th style="color:#FFF; padding:6px 2px; border-top:1px solid #eee;" width="15%">Absent Date</th>  
                            <th style="color:#FFF;  border-right:1px solid #EEE; text-align:center; border-top:1px solid #eee;" width="15%"  >Reason for Absence</th> 							
                            <th style="color:#FFF; border-right:1px solid #EEE;text-align:center; border-top:1px solid #eee;" width="15%"  >Type of Leave</th>
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						
						 $this->db->join('student', 'student.student_id= attendance.student_id');
						 $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($from_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'"');
						$this->db->where('status',2);
						$attendance = $this->db->get('attendance')->result_array();
						//echo $this->db->last_query(); die;
						$count = 1;foreach($attendance as $row_attendance):
						?>
                        <tr>
                            <td valign="middle" align="center"  style="font-size:13px; padding:6px 6px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"  width="11%"><?php echo $row_attendance['roll'];?></td>							
                            <td valign="middle" align="center" style="font-size:13px; padding:6px 6px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"  width="22%" ><?php echo $row_attendance['attandence_class'];?></td>
							<td valign="middle" align="center" style="font-size:13px; padding:6px 6px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"  width="22%"><?php echo $row_attendance['name'].' '.$row_attendance['father_name'] ;?></td>
							<td valign="middle" align="center" style="font-size:13px; line-height:18px; padding:6px 6px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"  width="15%" ><?php echo date("F d, Y",strtotime( $row_attendance['date']));?></td>					
                            <td valign="middle" align="center" style="font-size:13px; line-height:18px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"  width="15%"><?php echo $row_attendance['description'];?></td>							
                            <td valign="middle" align="center" style="font-size:13px; line-height:18px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"  width="15%"><?php echo $row_attendance['leave_type'];?></td>		
                        </tr>
                        <?php endforeach;?>
                    </tbody>
					<tr>
                        <td valign="middle" align="right" colspan="6" style="padding:12px 0px; border-top:2px solid #2092D0; font-size:10px;"><span style="color:#2092D0;">Generated By : </span> <?php echo $this->session->userdata('name');?> </td> 
                        </tr>
                </table>
                
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>



