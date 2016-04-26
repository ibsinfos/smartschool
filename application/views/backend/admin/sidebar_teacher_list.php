<div class="row" style="clear:both;">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
                <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                  
                        <tr><td colspan="4" style="height:15px;"></td></tr>
                      
                        <tr bgcolor="#000000"><td colspan="6" style="font-size:1.2em; text-align:center; font-weight:600;  color:#FFF;"> <span style="text-align:right;color:#2092D0;font-size:1.2em;font-weight:600;">Teachers</span></td></tr>
                		
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF;  text-align:center;" width="20%">No</th>
                    		<th style="color:#FFF;   text-align:center;" width="20%">Teacher Name</th>
                    		<th style="color:#FFF;  text-align:center;" width="20%">Class</th>
                            <th style="color:#FFF;  text-align:center;" width="20%">Subject</th> 							
                            <th style="color:#FFF;  text-align:center;" width="20%">Phone</th> 							
                            <th style="color:#FFF;  text-align:center;" width="20%">Email</th> 							
                            
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						
						
					
					$teacher = $this->db->get_where("teacher",array("teaching_type"=>1))->result_array();
					$count = 1;
					foreach($teacher as $rowteacher):
					    $this->db->join('teacher', 'teacher.teacher_id=teacher_class_association.teacher_id');
						$this->db->where("teacher.teacher_id",$rowteacher['teacher_id']);
    					$class = $this->db->get("teacher_class_association")->result_array();
						//echo $this->db->last_query(); die;
						//print_r($class);
						
						foreach($class as $row_class):
						$class_id[] = $row_class['class_id'];
						
						endforeach;
						$all_class = implode(',',$class_id);
						$this->db->select('subject.name');
						 $this->db->join('teacher', 'teacher.teacher_id=subject.teacher_id');
						$this->db->where("teacher.teacher_id",$rowteacher['teacher_id']);
    					$subject = $this->db->get("subject")->result_array();
						
						foreach($subject as $row_sub):
							$subjects[] = $row_sub['name'];
							
						endforeach;
						$all_sub = implode(',',$subjects);
						
						
						
						
							//$classe = implode(',',$classes);
							
							?>
                        <tr>
                        <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="10%"><?php echo $count; 
						$count++;?></td>
                            <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="10%"><?php echo $rowteacher['name'];?></td>
                            <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="10%"><?php echo $all_class;?></td>
                              <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="10%"><?php echo  $all_sub; ?></td>
                               <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="10%"><?php echo $rowteacher['phone'];?></td>
                              <td align="center" style="font-size:11px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="10%"><?php echo  $rowteacher['email']; ?></td>
                           
							
                        </tr>
                        <?php 
						$all_class = '';
						
						$class_id = '';
						$all_sub = '';
						$subjects = '';
						endforeach; ?>
                     
                    </tbody>
                    	
                </table>
                
			</div>
            	<?php
				if($teacher > 0)
				{
				 echo form_open(base_url() . 'index.php?admin/sidebar_teacher_pdf' , array('class' => 'form-horizontal validate'));?>
                 <div class="form-group">
                             <div class="col-sm-6">
                               <button type="submit" class="btn btn-info">Export To Pdf</button>
                             </div>
                             </div>   
                    </form>
                 <?php } ?>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>