<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          
                 <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                    <tr>
                            <td colspan="5">
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
                        <tr><td colspan="5" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="5" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Class Wise Time Table</td></tr>
                        <tr bgcolor="#000000"><td colspan="5" style="font-size:1.1em; text-align:center; font-weight:600; padding:6px 2px;  color:#FFF;">  <?php
						
$monthName = date("F", mktime(0, 0, 0, $month, 10));
//echo $monthName; //output: May
// 

	 echo ucwords('Class Name : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.$class_id.'</span> Month : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.$monthName.'</span>
	  Week : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.$week.'</span>'); ?></td></tr>
                		
                		
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; padding:6px 6px;" >Date</th>
                    		<th style="color:#FFF; padding:6px 6px;" >Day</th>
                    		<th style="color:#FFF; padding:6px 6px;" >Subject</th>  
                            <th style="color:#FFF; padding:6px 6px;" >Teacher</th> 
                            <th style="color:#FFF; padding:6px 6px;" >Time</th>   
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						$this->db->select('date,day,month,week,subject.name as subject_name,teacher.name as teacher_name,time_start,time_end,time_table.subject_id,time_table.teacher_id,time_table.class_id');
						$this->db->join('subject', 'subject.subject_id = time_table.subject_id');
						$this->db->join('teacher', 'teacher.teacher_id = time_table.teacher_id');
						$this->db->where('time_table.class_id', $class_id);
						$this->db->where('time_table.month', $month);
						$this->db->where('time_table.week', $week);
						$timetable = $this->db->get('time_table')->result_array();
						//echo $this->db->last_query(); die;
						$count = 1;foreach($timetable as $row_timetable):
						
						?>
                        <tr>
                            <td valign="middle" align="center"  style="font-size:13px; padding:6px 6px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" ><?php echo date("F d, Y",strtotime( $row_timetable['date']));?></td>							
							<td valign="middle" align="center" style="font-size:13px; padding:6px 6px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $row_timetable['day'];?></td>
							<td valign="middle" align="center" style="font-size:13px; line-height:18px; padding:6px 6px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" ><?php echo $row_timetable['subject_name'];?></td>			
                            <td valign="middle" align="center" style="font-size:13px; line-height:18px; padding:6px 6px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" ><?php echo $row_timetable['teacher_name'];?></td>			
                            <td valign="middle" align="center" style="font-size:13px; line-height:18px; padding:6px 6px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" ><?php echo $row_timetable['time_start'].'  TO  '.$row_timetable['time_end'];?></td>							
                        </tr>
                        <?php endforeach;?>
                    </tbody>
					<tr>
                        <td valign="middle" align="right" colspan="5" style="padding:10px 2px; font-size:9px;"><span style="color:#2092D0;">Generated By : </span> <?php echo $this->session->userdata('name');?> </td> 
                        </tr>
                </table>
                
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>
