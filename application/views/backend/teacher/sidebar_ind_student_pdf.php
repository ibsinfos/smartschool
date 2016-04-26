<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
             <table  class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export" >
                    <thead>
                   <tr>
                            <td colspan="3">
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
                        <tr><td colspan="3" style="height:15px;"></td></tr>
                        <tr><td colspan="3" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="3" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Individual Student Report</td></tr>
                        
                        </thead>
                         <tbody>
                         <?php 
						$result = $this->db->get_where("student",array("student_id"=>$student_id,"class_id"=>$class_id))->result_array();
		
						
		//$page_data['page_name']  = 'ind_student';
        //$page_data['page_title'] = get_phrase('individual_student_report');
		$students = $result;
	
		//$student_name = $student_name;
						 
						 foreach($students as $row){
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
$this->db->limit('1');
$behaviour = $this->db->get()->result_array();
$count = 1;
$date1=date_create("2015-09-01");
        $getdate = date("Y-m-d");
        $date2=date_create($getdate);
	      $diff=date_diff($date1,$date2);
         $total_count=$diff->format("%a");
 $present_count=($total_count)-($attendance);
          $t=$present_count/$total_count*(100);
        $num_of_percent =  number_format($t, 1, '.', '');
						   ?>
                           
                       
                    <tr>
                        <td style="padding:6px 3px;" ><b style="font-weight:900; ">Name</b></td><td><?php echo $row['name']; ?></td>
                        <td style="margin-top:10px; padding:6px 3px;" rowspan="3">
                        <?php $imgpath = FCPATH.'/uploads/student_image/'.$row['student_image'];
						if(file_exists($imgpath))
						{
						?>
                        <img style="margin-top:10px;" src="<?php echo base_url().'uploads/student_image/'.$row['student_image']; ?>" height="100" width="100" />
                        <?php } ?>
                        </td>
                    </tr>
                        <tr><td style="padding:6px 3px;"><b style="font-weight:900;">Birthday</b></td><td><?php echo date("F d, Y",strtotime($row['birthday'])); ?></td></tr>
                        <tr><td style="padding:6px 3px;" ><b style="font-weight:900;">Class</b></td><td><?php echo $row['class_id']; ?></td></tr>
                        <tr><td style="padding:6px 3px;"><b style="font-weight:900;"> Blood Group</b></td><td><?php echo $row['blood_group']; ?></td></tr>
                        <tr><td style="padding:6px 3px;"><b style="font-weight:900;">Phone</b></td><td><?php echo $row['phone']; ?></td></tr>
                        <tr><td style="padding:6px 3px;"><b style="font-weight:900;">Email</b></td><td><?php echo $row['email']; ?></td></tr>
                        <tr><td style="padding:6px 3px;"><b style="font-weight:900;">Address</b></td><td><?php echo wordwrap($row['address'],40,"<br>\n"); ?></td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td style="padding:6px 3px;"><b style="font-weight:900;">Parents Details</b></td><td><?php echo "Father :".$row['father_name']." Mother Name:".$row['mother_name']; ?></td></tr>
                        <tr><td style="padding:6px 3px;"> <b style="font-weight:900;">Parents contact no</b></td><td><?php if(!empty($parent)){  echo $parent[0]['phone']; } ?></td></tr>
                        <tr><td style="padding:6px 3px;"><b style="font-weight:900;">Parents Email id</b></td><td><?php if(!empty($parent)){  echo $parent[0]['parent_email']; } ?></td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td style="padding:6px 3px;"><b style="font-weight:900;">Total Attendance</b></td><td><?php echo $total_count; ?></td></tr>
                        <tr><td style="padding:6px 3px;"><b style="font-weight:900;">Total Attendance % :</b></td><td><?php echo $num_of_percent.'%'; ?></td></tr>
                        <tr><td style="padding:6px 3px;"><b style="font-weight:900;">Fees</b></td><td><?php //echo $row['name']; ?></td></tr>
                        <tr><td style="padding:6px 3px;"><b style="font-weight:900;">Assessments</b></td><td><?php if(!empty($behaviour[0]['behaviour'])){ echo wordwrap($behaviour[0]['behaviour'],100,"<br>\n"); } ?></td></tr>
                                  
                        
                        <?php } ?>
                        <tr>                        
                        <td valign="middle" align="right" colspan="3"  style="padding:12px 0px; border-top:2px solid #2092D0; font-size:10px;"><span style="color:#2092D0;">Generated By : </span> <?php echo $this->session->userdata('name');?> </td> 
                        </tr>
                        </tbody>
                        </table>
            
            	</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>

