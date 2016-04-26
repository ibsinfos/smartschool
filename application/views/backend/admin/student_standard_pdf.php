<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
                <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                    <tr>
                        <td valign="middle" align="left";><div><?php  $image = base_url().'/uploads/system_image/'.$this->session->userdata("admin_id").'.jpg'; ?>
						
						
                        <img src="<?php echo $image; ?>" width="80" height="70" /></div></td>
                    	<td valign="middle" align="center"><div style="font-size:1.8em; text-align:center; font-weight:600; color:#000;">Page Inc School</div></td>
                        <td valign="bottom" align="right" style="font-size:12px;"><div>Date : <?php echo date('jS M Y'); ?> </div></td>	 
						</tr>
                        <tr><td colspan="9" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="9" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">student Listing (From STD:<?php echo $std_name; ?>)</td></tr>
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; padding:6px 0px;" >No</th>
                    		<th style="color:#FFF; padding:6px 0px;" >Full Name</th>
                    		<th style="color:#FFF; padding:6px 0px;" >Attendance</th>
                    		<th style="color:#FFF; padding:6px 0px;" >Class Teacher</th> 							
                    		<th style="color:#FFF; padding:6px 0px;" >Outstanding Fees</th> 							
                    		<th style="color:#FFF; padding:6px 0px;" >Partents Phone</th> 							
                    		<th style="color:#FFF; padding:6px 0px;" >Parents Email</th> 							
                    		<th style="color:#FFF; padding:6px 0px;" >Prev Behaviour</th> 							
                    		<th style="color:#FFF; padding:6px 0px;" >Current Behaviour</th> 							
						</tr>
					</thead>
                    <tbody>
					<?php					
						$array = array("student.std_status"=>0,"student.class_id LIKE"=>'%'.$std_name.'%');
						$this->db->select('teacher.name AS teacher_name,student.name AS student_name,student.class_id AS student_class_id,payment.amount AS fees,parent.email AS parent_email,parent.phone AS parent_phone');
						$this->db->from('student');
						$this->db->where($array);
						$this->db->join('teacher_class_association', 'student.class_id = teacher_class_association.class_id');
						$this->db->join('teacher', 'teacher_class_association.teacher_id = teacher.teacher_id');
						$this->db->join('parent', 'parent.student_id = student.student_id');
						$this->db->join('payment', 'student.student_id = payment.student_id');						
						$query = $this->db->get();
						$student =$query->result_array();
						$count = 1;
						foreach($student as $std_row):	
						?>
                        <tr>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" ><?php echo $count++;?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"  ><?php echo $std_row['student_name'];?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"  >
								<?php									
										$abs = $this->db->get_where('attendance', array('status' => 2));
										$abs_count = $abs->num_rows();
										
									//$duration = $att_row['date'];
									$cy = date("Y");
									$from = strtotime('01-09-'. ($cy-1));
									$today = time();
									$difference = $today - $from;
									$count_day =  floor($difference / (60 * 60 * 24));
									$tt = ($count_day + 1) ;
									$pres = $tt -  $abs_count;
									if($pres == ''){
										echo  '-';
									} else {
										echo  $pres . "/" . $tt;
									}
								?>
							</td>						
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $std_row['teacher_name'];?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php 
							if($std_row['fees'] == ''){ echo '-'; }else { echo $std_row['fees']; }?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $std_row['parent_phone'];?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $std_row['parent_email'];?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" >
								<?php 
								    $this->db->where('student_id',$std_row['student_id']);
									$this->db->order_by("assessment_id", "desc");
									$this->db->limit(2,1);
									$ffff =$this->db->get('assessment')->row();
									//echo $this->db->last_query();
									//die;
									if($ffff->behaviour == ''){										
										echo '-';
									}else {
										echo $ffff->behaviour;
									}
								?>						
							</td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" >
								<?php
								    $this->db->where('student_id',$std_row['student_id']);
									$this->db->order_by("assessment_id", "desc");
									$this->db->limit(1);
									$assessment_list_cu=$this->db->get('assessment')->row();
									if($assessment_list_cu->behaviour == ''){										
										echo '-';
									}else {
										echo $assessment_list_cu->behaviour;
									}
								?>						
							</td>
                        </tr>
                        <?php 
						endforeach;
						?>
                    </tbody>
                     <tr>
                        <td valign="middle" align="right" colspan="9" style="padding:12px 0px; border-top:2px solid #2092D0; font-size:10px;"><span style="color:#2092D0;">Generated By : </span> <?php echo $this->session->userdata('name');?> </td>
                        </tr>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>