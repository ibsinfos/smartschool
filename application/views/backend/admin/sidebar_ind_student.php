<div class="row" id="ind_student" >
					<div class="col-md-12">	
						<div class="tabs-vertical-env">
							<div class="tab-content">
								<?php echo form_open(base_url() . 'index.php?admin/individual_student' , array('class' => 'form-horizontal form-groups-bordered validate')); ?>
                              
									 <div class="form-group">
                    <label class="col-sm-1 control-label">Class</label>
                    <div class="col-sm-2">
                      <select name="class_id" id="class_ids" class="form-control" style="width:100%;" onchange="return getstudent(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                        <option value="">Select Class</option>
            <?php 
										
										
										$student_classes = $this->db->get('class')->result_array();
										foreach($student_classes as $row):
										?>
            <option value="<?php echo $row['name_numeric'];?>"><?php echo $row['name_numeric'];?></option>
            <?php
										endforeach;
										?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-1 control-label">Students</label>
        <div class="col-sm-2">
          <select name="student_id" id="student_id" class="form-control" style="width:100%;"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
            <option value="">Select Student</option>
           
          </select>
        </div>
      </div>
      
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-5">
											<button type="submit" class="btn btn-info" id="getstudent_info">Submit</button>
										</div>
									</div> 
								</form>	
							</div>		
						</div>
					</div>
				</div>
                 <?php
				
				
				 
				 ?>
					
            <?php  
			// $student_name = $student_name;	
		if(isset($student_id))
		{
			
		
		$result = $this->db->get_where("student",array("student_id"=>$student_id,"class_id"=>$class_id))->result_array();
		
		//$page_data['page_name']  = 'ind_student';
        //$page_data['page_title'] = get_phrase('individual_student_report');
		$students = $result;
		
		
	
		$student_name = $student_name;
		?>
                    
                    
					 
				<?php	
				  if(isset($student_id)){ ?>
				
                <table  class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export" >
                    <thead>
                        <tr><td colspan="10" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="10" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Individual Student Report</td></tr>
                        
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
                           
                       
                        <tr><td><b style="font-weight:900;">Name</b></td><td><?php echo $row['name']; ?></td><td rowspan="3"><?php //if(is_dir(base_url().'uploads/student_image/'.$row['student_image'])){
						 $imgpath = FCPATH.'/uploads/student_image/'.$row['student_image'];
						if($row['student_image'] != "")
						{
						?>
                        <img src="<?php echo base_url().'uploads/student_image/'.$row['student_image']; ?>" height="100" width="100" /><?php  }else{?><img src="<?php echo base_url().'uploads/user.jpg' ?>" height="100" width="100" /> <?php } ?></td></tr>
                        <tr><td><b style="font-weight:900;">Birthday</b></td><td><?php echo date("F d, Y",strtotime( $row['birthday'])); ?></td></tr>
                        <tr><td><b style="font-weight:900;">Class</b></td><td><?php echo $row['class_id']; ?></td></tr>
                        <tr><td><b style="font-weight:900;"> Blood Group</b></td><td><?php echo $row['blood_group']; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Phone</b></td><td><?php echo $row['phone']; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Email</b></td><td><?php echo $row['email']; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Address</b></td><td><?php echo wordwrap($row['address'],40,"<br>\n"); ?></td></tr>
                        
                        <tr><td></td></tr>
                          <tr><td></td></tr>
                        <tr><td><b style="font-weight:900;">Parents Details</b></td><td><?php echo "Father Name : ".$row['father_name']." <br /> Mother Name : ".$row['mother_name']; ?></td></tr>
                        <tr><td><b style="font-weight:900;"> Parents Contact No</b></td><td><?php if(!empty($parent)){  echo $parent[0]['phone']; } ?></td></tr>
                        <tr><td><b style="font-weight:900;">Parents Email Id</b></td><td><?php if(!empty($parent)){  echo $parent[0]['parent_email']; } ?></td></tr>
                      <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td><b style="font-weight:900;">Total Attendance</b></td><td><?php echo $total_count; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Total Attendance % :</b></td><td><?php echo $num_of_percent.'%'; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Fees</b></td><td><?php //echo $row['name']; ?></td></tr>
                          <tr><td><b style="font-weight:900;">Recent Assessment</b></td><td><?php echo wordwrap($behaviour[0]['behaviour'],100,"<br>\n") ?></td></tr>
                                  
                        
                        <?php } ?>
                        </tbody>
                        </table>
                
                <!--
				<table  class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export" >
                    <thead>
                        <tr><td colspan="10" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="10" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Individual Student Report</td></tr>

                        <tr bgcolor="#2092D0" >
                            <th style="color:#FFF; border-right:1px solid #EEE; padding:6px 0px;  text-align:center" >No</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; padding:6px 0px; text-align:center" > Name</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; padding:6px 0px; text-align:center" >Attendance</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE; padding:6px 0px; text-align:center" >Class</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE; padding:6px 0px; text-align:center" >C. Teacher</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE; padding:6px 0px; text-align:center" >Fees</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE; padding:6px 0px text-align:center;" >Partents Phone</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE; padding:6px 0px; text-align:center" >Parents Email</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE; padding:6px 0px; text-align:center" >Prev Behaviour</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE; padding:6px 0px; text-align:center" >Current Behaviour</th> 
                        </tr>
                    </thead>
					
                    <tbody>
                 <?php   if(!empty($students)){ ?>
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
$count = 1;

 		
						   ?>
                        <tr>
                      <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $count++;?></td>
                      <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['name']; ?></td>
                       <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"  >
                            <?php echo $attendance; ?></td>
                     
                      <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['class_id']; ?></td>
                       <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $teachers[0]['name']; ?></td>
                      	<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php //echo $std_row['fees'];?></td>
                      <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $parent[0]['phone']; ?></td>
                       <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" ><?php echo $parent[0]['parent_email']; ?></td>
                      <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $behaviour[1]['behaviour']; ?></td>
                       <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $behaviour[0]['behaviour']; ?></td>
                                
                                
                                
                            
                        </tr>
                        <?php } ?>
                          <?php } ?>
                     
            <?php } ?>
            
                    </tbody>
                </table>-->
                	
                       <?php
					    if(isset($students)){
					    echo form_open(base_url() . 'index.php?admin/sidebar_ind_student_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
									<div class="form-group">
										
										<div class="col-sm-5">
											 <input type="hidden" class="form-control" name="class_id" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $class_id; ?>"/>
                                              <input type="hidden" class="form-control" name="student_id" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $student_id; ?>"/>
										</div>
									</div>	
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-5">
											<button type="submit" class="btn btn-info">Export To Pdf</button>
										</div>
									</div> 
								</form>	
              
            <?php } 
		}?>
			
            <script >
			function getstudent()
			{
				var class_id = $("#class_ids").val();
				//alert(class_id);
			$.ajax({
            url: '<?php echo base_url();?>index.php?admin/getstudents/' + class_id,
            success: function(response)
            {
				//alert(response);
				jQuery('#student_id').html(response);
	        }
			});
	
           
				
				
			}
            </script>
          