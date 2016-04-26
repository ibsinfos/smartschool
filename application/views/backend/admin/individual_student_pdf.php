<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
                 <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:12px; letter-spacing:0.5;" id="table_export">
                	<thead>
                    <tr>
                        <td valign="middle" align="left" colspan="3">
                        <div>
						<?php  $image = base_url().'/uploads/system_image/1.jpg'; ?>
                        <img src="<?php echo $image; ?>" width="80" height="70" />
                        </div>
                        </td>
                    	<td valign="middle" align="center" colspan="5" style="font-size:1.8em; text-align:center; font-weight:600; color:#000;">Page Inc School</td>
                        <td valign="bottom" align="right" colspan="3" style="font-size:12px;">Date : <?php echo date('jS M Y'); ?></td>	 
						</tr> <tr><td colspan="10" style="height:15px;"></td></tr>
                        
                        <tr bgcolor="#000000"><td colspan="10" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Individual student Listing</td></tr>
                		
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; padding:6px 0px;" >No</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; padding:6px 0px;" >Name</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; padding:6px 0px;" >Attendance</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; padding:6px 0px;" >Class</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; padding:6px 0px;" >C. Teacher</th> 							
                    		<th style="color:#FFF;  border-right:1px solid #EEE; text-align:center;padding:6px 0px;" >Fees</th> 							
                    		<th style="color:#FFF;  border-right:1px solid #EEE; text-align:center;padding:6px 0px;" >Partents Phone</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; padding:6px 0px;" >Parents Email</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; padding:6px 0px;" >Prev Behaviour</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; padding:6px 0px;" >Current Behaviour</th> 							
						</tr>
					</thead>
                   		 <tbody>
					<?php
						$this->db->like('name',$student_name); 
		$students = $this->db->get("student")->result_array();
				//	$students = $this->db->get_where('student' , array('name' => $student_name))->result_array();
				
					 foreach($students as $row):
						 $teacher =  $this->db->get_where("teacher_class_association",array("class_id"=>$row['class_id'],""))->result_array();
						 $teachers = $this->db->get_where("teacher",array("teacher_id"=>$teacher[0]['teacher_id']))->result_array();
						 $attendance = $this->db->get_where("attendance",array("status"=>'2','student_id'=>$row['student_id']))->num_rows();
				$parent = $this->db->get_where("parent",array("student_id"=>$row['student_id']))->result_array();
						 $parent = $this->db->get_where("parent",array("student_id"=>$row['student_id']))->result_array();
$this->db->select('*');
$this->db->from('assessment');
$array = array('class_id' => $row['class_id'], 'student_id' => $row['student_id']);

$this->db->where($array);

$this->db->order_by('assessment_id', 'DESC');
$this->db->limit('2');
$behaviour = $this->db->get()->result_array();
$count = 1;
						if(count($students) > 0){
					/*$s_name = $this->db->get_where('student' , array('name' => $student_name))->result_array();
					foreach($s_name as $s_row):
						$array = array("student.std_status"=>0,"student.student_id"=>$s_row['student_id']);												
						$this->db->select('teacher.name AS teacher_name,student.name AS student_name,student.class_id AS student_class_id,payment.amount AS fees,parent.email AS parent_email,parent.phone AS parent_phone');    
						$this->db->from('student');
						$this->db->where($array);
						$this->db->join('teacher_class_association', 'student.class_id = teacher_class_association.class_id');
						$this->db->join('teacher', 'teacher_class_association.teacher_id = teacher.teacher_id');
						$this->db->join('parent', 'parent.student_id = student.student_id');
						$this->db->join('payment', 'student.student_id = payment.student_id');						
						$query = $this->db->get();
						$student =$query->result_array();
						//echo $this->db->last_query();
						//die;
						$count = 1;
						if(count($student) > 0){
						foreach($student as $std_row):	*/
						
						?>
                        <tr>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" ><?php echo $count++;?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"  ><?php echo $row['name']; ?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"  >
                            <?php echo $attendance; ?>
								<?php									
										/*$abs = $this->db->get_where('attendance', array('status' => 2));
										$abs_count = $abs->num_rows();
										
									//$duration = $att_row['date'];
									$from = strtotime('01-09-2015');
									$today = time();
									$difference = $today - $from;
									$count_day =  floor($difference / (60 * 60 * 24));
									$tt = ($count_day + 1) ;
									$pres = $tt -  $abs_count;
									echo  $pres . "/" . $tt;*/
								?>
							</td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $row['class_id']; ?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $teachers[0]['name']; ?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php //echo $std_row['fees'];?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $parent[0]['phone']; ?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $parent[0]['parent_email']; ?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" >
								<?php 
								/*	$this->db->order_by("assessment_id", "desc");
									$this->db->limit(2,1);
									$ffff =$this->db->get('assessment')->row();
									//echo $this->db->last_query();
									//die;
									echo $ffff->behaviour;*/
									
								?>	
                                <?php echo $behaviour[0]['behaviour']; ?>					
							</td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" >
								<?php
								/*	$this->db->order_by("assessment_id", "desc");
									$this->db->limit(1);
									$assessment_list_cu=$this->db->get('assessment')->row();
									echo $assessment_list_cu->behaviour;*/
									
								?>
                                <?php echo $behaviour[1]['behaviour']; ?>						
							</td>
                        </tr>					
						<?php 						
					
						}
						else
						{
						?>
						<tr><td align="left" style="font-size:11px; padding:6px 0px;" colspan="3">*No record found..</td></tr>
						<?php 
						}
						endforeach;
						?>
                    </tbody>
                    
                     <tr>
                        <td valign="middle" align="right" colspan="10" style="padding:12px 0px; border-top:2px solid #2092D0; font-size:10px;"><span style="color:#2092D0;">Generated By : </span> <?php echo $this->session->userdata('name');?> </td>
                        </tr>
                    	
                </table>
                
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>