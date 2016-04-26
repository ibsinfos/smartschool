<style>
.modal-dialog{
width:50%;
	
	}
.modal-body{ width:100%; }
.modal-body{ overflow-y:scroll; }
</style>
<div class="row" id="ind_student" >
					<div class="col-md-12">	
						<div class="tabs-vertical-env">
							<div class="tab-content">
								<?php //echo form_open(base_url() . 'index.php?admin/searchstudent' , array('class' => 'form-horizontal form-groups-bordered validate')); ?>
                                
                                <form action="" id="getdata"  method="post"  class="form-horizontal form-groups-bordered validate" >
                                 <div class="form-group">
                    <label class="col-sm-1 control-label">Class</label>
                    <div class="col-sm-3">
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
        <div class="col-sm-3">
          <select name="student_id" id="student_id" class="form-control" style="width:100%;"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
            <option value="">Select Student</option>
           
          </select>
        </div>
      </div>
									<!--<div class="form-group">
										<label class="col-sm-3 control-label">Student Name</label>
										<div class="col-sm-5">
											 <input type="text" class="form-control" name="student_name" data-validate="required" id="student_name" data-message-required="<?php //echo get_phrase('value_required');?>"/>
										</div>
									</div>	-->
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-5">
											<button type="submit" class="btn btn-info" id="getstudent_info">Submit</button>
										</div>
									</div> 
								</form>	
							</div>		
						</div>
					</div>
				</div>
                 <?php
				
				 if(isset($param2) && !empty($param2))
				 { 
				 
				 ?>
					
            <?php  
			 $student_name = $param2;	
		
		$this->db->like('name',$student_name); 
		$result = $this->db->get("student")->result_array();
		//$page_data['page_name']  = 'ind_student';
        //$page_data['page_title'] = get_phrase('individual_student_report');
		$students = $result;
		
		$student_name = $student_name;
		?>
                    
                    
					 
				<?php	 }
				  if(isset($students)){ ?>
				
				<table  class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export" >
                    <thead>
                        <tr><td colspan="10" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="10" style="font-size:1.2em; text-align:center; font-weight:600;  color:#FFF;">Staff student Listing</td></tr>

                        <tr bgcolor="#2092D0" >
                            <th  style="color:#FFF;  border-right:1px solid #EEE; text-align:center;" >No</th>
							 <th style="color:#FFF;   border-right:1px solid #EEE; text-align:center;">Full Name</th>
                            <th style="color:#FFF;   border-right:1px solid #EEE; text-align:center;"> Class</th>
                            <th style="color:#FFF;   border-right:1px solid #EEE; text-align:center;">Parents Phone</th>
                          
                            <th style="color:#FFF;  border-right:1px solid #EEE; text-align:center;">Previous Behaviour</th>
                            <th style="color:#FFF;   border-right:1px solid #EEE; text-align:center;">Current Behaviour</th>
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
                      <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $count++;?></td>
                      <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['name']; ?></td>
                     
                      <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['class_id']; ?></td>
                      
                      <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $parent[0]['phone']; ?></td>
                      <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $behaviour[0]['behaviour']; ?></td>
                       <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $behaviour[1]['behaviour']; ?></td>
                                
                                
                                
                            
                        </tr>
                        <?php } ?>
                          <?php } ?>
                     
            <?php } ?>
            
                    </tbody>
                </table>
                	
                       <?php
					    if(isset($students)){
					    echo form_open(base_url() . 'index.php?admin/ind_student_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
									<div class="form-group">
										
										<div class="col-sm-5">
											 <input type="hidden" class="form-control" name="student_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $student_name; ?>"/>
										</div>
									</div>	
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-5">
											<button type="submit" class="btn btn-info">Export To Pdf</button>
										</div>
									</div> 
								</form>	
                                
              
            <?php } ?>
			
            <script type="text/javascript">
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
			$(document).ready(function() {
				
				$("#getdata").submit(function(){
					var class_id = $("#class_ids").val();
					var student_id = $("#student_id").val();
					var dataString = "class_id="+class_id+"&student_id="+student_id;
					if(dataString=="")
					{
						return false;	
					}
					
					
				showAjaxModal('<?php echo base_url();?>index.php?modal/ind_student/individual_student_list',dataString);
				return false;	
				});
                
            });
			
            </script>