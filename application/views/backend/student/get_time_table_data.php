<div class="panel-group joined" id="accordion-test-2">
                	<?php 
					$toggle = true;
					$get_student=$this->db->get_where('student' , array('student_id' =>$this->session->userdata('student_id')))->row();
					if($_POST['month'] != "" && $_POST['week'] != ""){
						$array=array('class_id'=>$get_student->class_id,'month'=>$_POST['month'],'week'=>$_POST['week']);}
			  		else{
						$classes=array();
					}
					$this->db->distinct();
					$this->db->select('class_id');
					$this->db->from('time_table');
					$this->db->where($array);
					$query = $this->db->get();
					$classes=$query->result_array();
					if(count($classes)>0)
					{	
					foreach($classes as $row):
						?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                		<h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" 
                                    href="#collapse<?php echo $row['class_id'];?>">
                                        <i class="entypo-rss"></i> Class <?php echo $row['class_id'];?>
                                    </a>
                                    </h4>
                                </div>
                
                                <div id="collapse<?php echo $row['class_id'];?>" class="panel-collapse collapse <?php if($toggle){echo 'in';$toggle=false;}?>">
                                    <div class="panel-body">
                                        <table cellpadding="0" cellspacing="0" border="0"  class="table table-bordered">
                                            <tbody>
                                                <?php 
                                                for($d=1;$d<=6;$d++):
                                                	 if($d==1)$day='Monday';
                                                else if($d==2)$day='Tuesday';
                                                else if($d==3)$day='Wednesday';
                                                else if($d==4)$day='Thursday';
                                                else if($d==5)$day='Friday';
                                                else if($d==6)$day='Saturday';
                                                ?>
                                                <tr class="gradeA">
                                                    <td width="100"><?php echo strtoupper($day);?></td>
                                                    <td>
                                                    	<?php
						$array=array('class_id'=>$get_student->class_id,'month'=>$_POST['month'],'week'=>$_POST['week'],'day'=>$day);
														$this->db->select('*');
														$this->db->from('time_table');
														$this->db->where($array);
														$query = $this->db->get();
														$routines =$query->result_array();
														//echo $this->db->last_query();
														foreach($routines as $row2):
														?>
														<div class="btn-group">
															<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            	<?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?>
																<?php echo '('.$row2['time_start'].'-'.$row2['time_end'].')';
																 echo "<br/>";
							 echo date("F d, Y", strtotime($row2['date']))."  ";
							 $this->db->where('teacher_id',$row2['teacher_id']);
							 $teacher_query=$this->db->get('teacher');
							 $get_teacher_name=$teacher_query->row();
							 echo $get_teacher_name->name;
							 ?>															  			
                                                            	
                                                            </button>
															
														</div>
														<?php endforeach;?>

                                                    </td>
                                                </tr>
                                                <?php endfor;?>
                                                
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                            </div>
						<?php
					endforeach;
					}
					else{?>
					<div>No Data available</div>

					<?php }	
					?>
  				</div>