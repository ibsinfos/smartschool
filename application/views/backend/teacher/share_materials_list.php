<style>
.modal-dialog{   width:50%; }
</style>

<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
                <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>                   
                        <tr><td colspan="5" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="5" style="font-size:1.2em; text-align:center; font-weight:600;  color:#FFF;">Study Materials Uploaded Listing</td></tr>                		
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; border-right:1px solid #EEE; padding:6px 3px;  text-align:center;" width="20%" >No</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; padding:6px 3px;  text-align:center;" width="20%">Class Name</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; padding:6px 3px;  text-align:center;" width="20%">Subjects</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE; padding:6px 3px;  text-align:center;" width="20%">Topic Name</th> 							
                    		<th style="color:#FFF; border-right:1px solid #EEE;  padding:6px 3px;  text-align:center;" width="20%">File Name</th> 							
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						$teacher_id = $this->session->userdata('teacher_id');
						/*$this->db->select('class_id');
						$this->db->order_by('class_id','asc');
						$this->db->limit('1');
						$class = $this->db->get_where("teacher_class_association",array('teacher_id'=>$teacher_id))->result_array();
						
						$class_id = $class[0]['class_id'];
						$share_material = $this->db->get_where('share_material',array("class_id",$class_id))->result_array();*/
						$share_material =$this->db->query("SELECT share_material.class_id,subject.name,share_material.topic_name,share_material.m_filename FROM teacher_class_association JOIN share_material ON teacher_class_association.class_id=share_material.class_id JOIN subject ON subject.subject_id=share_material.subject_id WHERE teacher_class_association.teacher_id='".$teacher_id ."'
")->result_array();
						
						
						$count = 1;
						
						foreach($share_material as $sm_row):						
						?>
                        <tr>
                            <td align="center" style="font-size:12px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE; padding:6px 3px;" width="20%"><?php echo $count++;?></td>
							<td align="center" style="font-size:12px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;  padding:6px 3px;" width="20%" >
								<?php echo $sm_row['class_id'];  //$class_name		=	$this->db->get_where('class' , array('class_id' => $sm_row['class_id']) )->result_array(); 
								//foreach(@$class_name as $cname): ?>
								<?php //echo $class_id; //echo $cname['name_numeric'];?>
								<?php //endforeach; ?>
							</td>
							<td align="center" style="font-size:12px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;  padding:6px 3px;" width="20%">
								<?php echo $sm_row['name']; //$sub_name		=	$this->db->get_where('class' , array('class_id' => $sm_row['subject_id']) )->result_array(); 
								//foreach(@$sub_name as $sname): ?>
								<?php // echo $sname['name'];?>
								<?php // endforeach; ?>
							</td>
							<td align="center" style="font-size:12px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;  padding:6px 3px;" width="20%">
								<?php echo $sm_row['topic_name'];?>
							</td>
							<td align="center" style="font-size:12px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;  padding:6px 3px;" width="20%">
								<a href="<?php echo base_url();?>/material_download.php?file_name=<?php echo $sm_row['m_filename'];?>" class="links"><?php //echo base_url().'/material_download.php?file_name=' ?><?php echo $sm_row['m_filename']; ?></a>
							</td>
                        </tr>
                        <?php 						
						endforeach;  
						?>
                    </tbody>
                    	
                </table>
                <?php
				if(count($share_material) > 0){
				 echo form_open(base_url() . 'index.php?teacher/share_materials_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
										
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-5">
											<button type="submit" class="btn btn-info">Export To Pdf</button>
										</div>
									</div> 
								</form>
                                
                                <?php } ?>	
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>



