<?php if(!empty($students)){ ?>
				<table class="table table-bordered datatable" >
                    <thead>
                        <tr>
                            <th >No</th>
							 <th>Full Name</th>
                             <th>Attendance</th>
                            <th > Class</th>
                            <th>Class Teacher</th>
                            <th >Outstanding Fees</th>
                            <th>Parents Phone</th>
                            <th>Parents Email</th>
                            <th>Previous Behaviour</th>
                            <th>Current Behaviour</th>
                        </tr>
                    </thead>
					
                    <tbody>
                      <?php foreach($students as $row){
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

						   ?>
                        <tr>
                      <td><?php echo $row['student_id']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $attendance; ?></td>
                      <td><?php echo $row['class_id']; ?></td>
                      
                      <td><?php echo $teachers[0]['name']; ?></td>
                      <td></td>
                      <td><?php echo $parent[0]['phone']; ?></td>
                      <td><?php echo $parent[0]['parent_email']; ?></td>
                      <td><?php echo $behaviour[0]['behaviour']; ?></td>
                       <td><?php echo $behaviour[1]['behaviour']; ?></td>
                                
                                
                                
                            
                        </tr>
                        <?php } ?>
                      
                    </tbody>
                </table>
                <?php } ?>