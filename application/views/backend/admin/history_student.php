<?php   //Developed By Mayur Panchal 01-Mar-2016   ?>

<div class="row" id="history_student" >
  <div class="col-sm-12">
    <div class="tabs-vertical-env">
      <div class="tab-content"> <?php echo form_open(base_url() . 'index.php?history/student' , array('class' => 'form-horizontal form-groups-bordered validate')); ?>
        
          
          <div class="col-sm-2">

            <select name="academic_id" id="academic_id" class="form-control" style="width:100%;"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" onchange="getstudents(this.value);">
              <option value="">Select Academic Year</option>
              <?php 
								   $this->db->group_by('start_year,end_year');
								 $academic =  $this->db->get('academic_year')->result_array(); 
								 foreach($academic as $academy): ?>
              <option value="<?php echo $academy['start_year'].'/'.$academy['end_year']; ?>"><?php echo $academy['start_year'].' to '.$academy['end_year']; ?></option>
              <?php endforeach;
								 ?>
            </select>
        
        </div>
       
   
          <div class="col-sm-2">

            <select name="student_id" id="student_id" class="form-control" style="width:100%;"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
              <option value="">Select Student</option>
            </select>
       
        </div>
      
          <div class="col-sm-offset-1">
            <button type="submit" class="btn btn-info" id="getstudent_info">Submit</button>
          </div>
      
        </form>
      </div>
    </div>
  </div>
</div>
<?php if(isset($basic_info)){ ?>
<table  class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export" >
  <thead>
    <tr>
      <td colspan="10" style="height:15px;"></td>
    </tr>
    <tr bgcolor="#000000">
      <td colspan="10" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Basic Detail</td>
    </tr>
  </thead>
  
  <?php $row  = $basic_info;	 
			$teacher =  $this->db->get_where("teacher_class_association",array("class_id"=>$row[0]['class_id'],""))->result_array();
			$teachers = $this->db->get_where("teacher",array("teacher_id"=>$teacher[0]['teacher_id']))->result_array();
			$parent = $this->db->get_where("parent",array("student_id"=>$row[0]['student_id']))->result_array();
				/* start assessment  */
				$this->db->select('*');
				$this->db->from('history_assessment');
				$array = array('class_id' => $row[0]['class_id'], 'student_id' => $row[0]['student_id'],'history_start'=>$row[0]['history_start'],'history_end'=>$row[0]['history_end']);
				
				$this->db->where($array);
				
				$this->db->order_by('assessment_id', 'DESC');
				$behaviour = $this->db->get()->result_array();
				
				$count = 1;
				/* end assessment  */
/* start attendence  */
				$attendance = $this->db->get_where("history_student_attendance",
				array("status"=>'2',
				'student_id'=>$row[0]['student_id'],
				"history_start"=>$row[0]['history_start'],
				"history_end"=>$row[0]['history_end']
				))->num_rows();
				
				$current_year  = date('Y');						
				$academic = $this->db->get_where("academic_year",array("start_year"=>$row[0]['history_start'],"end_year"=>$row[0]['history_end']))->result_array();
				$ac_date1 = date($academic[0]['start_date']);
				$ac_date2 = date($academic[0]['end_date']);		 
				$date1=date_create($ac_date1);
				if($row[0]['history_end']==$current_year || $row[0]['history_start']==$current_year)
				{
						$ac_date2 = date('Y-m-d');
				}
				else
				{
						$ac_date2 = $ac_date2;
				}
    		     $date2=date_create($ac_date2);
		
		
				 $diff=date_diff($date1,$date2);
				 $total_count=$diff->format("%a");
				 $present_count=($total_count)-($attendance);
				 $t=$present_count/$total_count*(100);
				 $num_of_percent =  number_format($t, 1, '.', '');
						   ?>

  <tbody>
   <tr>
              <th><b style="font-weight:900;">Student Detail</b></th>
              </tr>
                <tr>
              <td><b style="font-weight:900;">Name</b></td>
              <td><?php echo $row[0]['name']; ?></td>
              <td rowspan="3">
		  <?php   if(!empty($row[0]['student_image']))
		  		  {
						 $imgpath = getcwd().'/uploads/student_image/'.$row[0]['student_image'];
						
						if(file_exists($imgpath))
						{?>
                                <img src="<?php echo base_url().'uploads/student_image/'.$row[0]['student_image']; ?>" height="100" width="100" />
    			   <?php  }
				    } ?>
              </td>
            </tr>
            <tr>
              <td><b style="font-weight:900;">Birthday</b></td>
              <td><?php echo date("d-M-Y",strtotime($row[0]['birthday'])); ?></td>
            </tr>
            <tr>
              <td><b style="font-weight:900;">Class</b></td>
              <td><?php echo $row[0]['class_id']; ?></td>
            </tr>
            <tr>
              <td><b style="font-weight:900;"> Blood Group</b></td>
              <td><?php echo $row[0]['blood_group']; ?></td>
            </tr>
            <tr>
              <td><b style="font-weight:900;">Phone</b></td>
              <td><?php echo $row[0]['phone']; ?></td>
            </tr>
            <tr>
              <td><b style="font-weight:900;">Email</b></td>
              <td><?php echo $row[0]['email']; ?></td>
            </tr>
            <tr>
              <td><b style="font-weight:900;">Address</b></td>
              <td><?php echo wordwrap($row[0]['address'],40,"<br>\n"); ?></td>
            </tr>
            <tr>
              <td></td>
            </tr>
             <tr>
              <th><b style="font-weight:900;">Parent Detail</b></th>
              </tr>
            <tr>
              <td>Father Name : <?php echo $row[0]['father_name']; ?></td>
            
            </tr>
            <tr>  <td><?php echo "Mother Name : ".$row[0]['mother_name']; ?></td></tr>
            <tr>
              <td>Contact No : <?php if(!empty($parent)){  echo $parent[0]['phone']; } ?></td>

            </tr>
            <tr>
              <td> Email : <?php if(!empty($parent)){  echo $parent[0]['parent_email']; } ?></td>
             
            </tr>
            
  </tbody>
</table>
    <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
      <thead>
        <tr>
          <td colspan="10" style="height:15px;"></td>
        </tr>
        <tr bgcolor="#000000">
          <td colspan="10" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Assessments Detail</td>
        </tr>
        <tr style="background:#2092D0;">
          <th style=" color:#FFF;border-right:1px solid #EEE;text-align:center;">Behavior</th>
          <th style=" color:#FFF;border-right:1px solid #EEE;text-align:center;">Date</th>
          <th style=" color:#FFF;border-right:1px solid #EEE;text-align:center;">Academic Year</th>
      </thead>
      <tbody>
        <?php foreach($behaviour as $assess): 
                            ?>
        <tr >
          <td style=" color:#000; border-right:1px solid #000; text-align:center;"><?php echo wordwrap($assess['behaviour'],100,"<br>\n");  ?></td>
          <td style=" color:#000;border-right:1px solid #000;text-align:center;"><?php echo date("d-M-Y",strtotime($assess['created_date'])); ?></td>
          <td style=" color:#000;border-right:1px solid #000; text-align:center;"><?php echo $assess['history_start'].' to '.$assess['history_end']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
<?php
				$attendances = $this->db->get_where("history_student_attendance",
								array("status"=>'2',
								'student_id'=>$row[0]['student_id'],
								"history_start"=>$row[0]['history_start'],
								"history_end"=>$row[0]['history_end']))->result_array();
						
						 ?>
            <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
              <thead>
                <tr>
                  <td colspan="10" style="height:15px;"></td>
                </tr>
                <tr bgcolor="#000000">
                  <td colspan="10" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Attendance Details</td>
                </tr>
                <tr bgcolor="#000000">
                  <td colspan="10" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;"><strong>Total Attendance : <?php echo $total_count; ?></strong><br />
                    <strong>Total Attendance in % : <?php echo $num_of_percent.' %';  ?></strong></td>
                </tr>
                <tr style="background:#2092D0;">
                  <th style=" color:#FFF;border-right:1px solid #EEE;text-align:center;">Absent Date</th>
                  <th style=" color:#FFF;border-right:1px solid #EEE;text-align:center;">Reason for Absence</th>
                  <th style=" color:#FFF;border-right:1px solid #EEE;text-align:center;">Type of Leave</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($attendances as $attend): ?>
                <tr >
                  <td style=" color:#000;text-align:center; border-right:1px solid #000;"><?php echo date("d-M-Y",strtotime($attend['date'])); ?></td>
                  <td style=" color:#000;text-align:center; border-right:1px solid #000;"><?php echo $attend['description']; ?></td>
                  <td style=" color:#000;text-align:center; border-right:1px solid #000;"><?php echo $attend['leave_type']; ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
              <thead>
                <tr>
                  <td colspan="10" style="height:15px;"></td>
                </tr>
                <tr bgcolor="#000000">
                  <td colspan="10" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Exams & Marks Detail</td>
                </tr>
              </thead>
              <tbody>
                <?php 
                                
                                    
                                    
                                    $this->db->group_by('name');
                                    $uexam = $this->db->get_where("history_exam",array("history_start"=>$row[0]['history_start'],"history_end"=>$row[0]['history_end']))->result_array();
                                    
                                     ?>
                <tr style="background:#000;">
                  <th style="color:#FFF; text-align:center; border-right:1px solid #EEE;"><strong>Subject</strong></th>
                  <th style="color:#FFF; text-align:center; border-right:1px solid #EEE;"><strong>Mark</strong></th>
                  <th style="color:#FFF; text-align:center; border-right:1px solid #EEE;"><strong>Date</strong></th>
                  <th style="color:#FFF; text-align:center; border-right:1px solid #EEE;"><strong>Time</strong></th>
                  <th style="color:#FFF; text-align:center; border-right:1px solid #EEE;"><strong>Year</strong></th>
                </tr>
                <?php 
                       $total_mark = 0;
                       $out_of_marks = 0;
                       foreach ($uexam as $dexam):
                       $this->db->select('history_mark.subject_id,
					   history_mark.exam_id,
					   history_mark.mark_obtained,
					   history_exam.out_of_marks,
					   history_exam.time_start,
					   history_exam.time_end,
					   history_exam.name,
					   history_exam.date,
					   history_mark.year');
                       $this->db->group_by("history_mark.subject_id,history_mark.exam_id");
                       $this->db->join('history_exam','history_mark.exam_id=history_exam.name');
                       $exams = $this->db->get_where("history_mark",
					   array("history_mark.student_id"=>$row[0]['student_id'],
					   "history_mark.class_id"=>$row[0]['class_id'],
					   "history_exam.history_start"=>$row[0]['history_start'],
					   "history_exam.history_end"=>$row[0]['history_end'],
					   'history_mark.exam_id'=>$dexam['name']))->result_array();
                                    
                                     if(!empty($exams)) {?>
                <tr bgcolor="#2092D0">
                  <td colspan="10" style="font-size:1.2em;margin-left:10px; text-align:left; font-weight:600; padding:6px 0px; color:#FFF;">Exam Name :
                    <?php  echo $dexam['name']; ?></td>
                </tr>
                <?php 
                                
                                      ?>
                <?php
                                    
                                    
                                     foreach($exams as $mark):
                                        $total_mark = $total_mark +=$mark['mark_obtained']; 
                                        $out_of_marks = $out_of_marks +=$mark['out_of_marks']; 
                                     ?>
                <tr>
                  <th style="text-align:center; border-right:1px solid #000;"><?php echo $mark['subject_id']; ?></th>
                  <th style="text-align:center; border-right:1px solid #000;"><?php echo $mark['mark_obtained']; ?></th>
                  <th style="text-align:center; border-right:1px solid #000;"><?php echo date("d-M-Y", strtotime($mark['date']));  ?></th>
                  <th style="text-align:center; border-right:1px solid #000;"><?php echo $mark['time_start'].' to '.$mark['time_end']; ?></th>
                  <th style="text-align:center; border-right:1px solid #000;"><?php echo $mark['year']; ?></th>
                </tr>
                <?php 
                                
                                    endforeach; ?>
                <?php 
                                ?>
                <tr>
                
                  <th ><strong>Total Mark : <?php echo $total_mark; ?></strong></th>
                  <th><strong>Out Of marks : <?php echo $out_of_marks; ?></strong></th>
                  <th><strong>Percentage :
                    <?php  $percentage = ($total_mark*100)/$out_of_marks;
                                $percentage = number_format($percentage, 2, '.', ',');
                                echo $percentage.' %';
                                 ?>
                    </strong></th>
                </tr>
                <?php 
                                     }
                                     $total_mark = 0;
                                     $out_of_marks = 0;
                                    endforeach; ?>
              </tbody>
            </table>
<?php } ?>
<script type="text/javascript">
                        function getstudents(years)
						{
							var dataString =  "years="+years;
							$.ajax({
								type:"POST",
								url:"<?php echo base_url(); ?>index.php?admin/gethistorystudent",
								data : dataString,
								success: function(response){
										$("#student_id").html(response);
									}
								
								});
							
						}
                        </script> 
