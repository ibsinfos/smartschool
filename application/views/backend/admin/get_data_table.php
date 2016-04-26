

<?php if($_POST['list'] =='student'){?> 
<form action="<?php echo  base_url().'index.php?admin/delete_all_students'; ?>" method="post">
<table class="table table-bordered datatable" id="table_export" >
                    <thead>
                        <tr>
                            <th width="80"><div>Login Id</div></th>
                            <th><div>All Class</div></th>
                            <th width="80"><div>Photo</div></th>
                            <th><div>Student Name</div></th>
                            <th class="span3"><div>Address</div></th>
                            <th><div>Email</div></th>
                            <th><div>Options</div></th>
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php 
                        $count = 1;
                        $year_start_date=$this->session->userdata('start_date');
                        $year_end_date=$this->session->userdata('end_date');
                        if($_POST['class_id']==0)
                        {   
                            $this->db->select('student_id,class_id,student_image,name,address,email'); 
                            $students=$this->db->get_where('student',array('std_status'=>0,'curr_date >='=>$year_start_date,'curr_date <='=>$year_end_date))->result_array();               
                        }
                        else
                        {
                            $this->db->select('student_id,class_id,student_image,name,address,email'); 
                            $students=$this->db->get_where('student',array('class_id' => $_POST['class_id'],'std_status'=>0,'curr_date >='=>$year_start_date,'curr_date <='=>$year_end_date))->result_array();                
                            
                        }
                                        
                            foreach($students as $row):
                                $sections = $this->db->get_where('class',array('class_id' => $row['class_id']))->result_array();
                                foreach($sections as $rowclass):
                        ?>
                        <tr>
                        
                            <td><?php echo $row['student_id'];?></td>   
                            <td><?php echo $row['class_id'];?></td> 
                            <td><?php if($row['student_image']!=''){ ?>
                            <img src=" <?php echo base_url();?>uploads/student_image/<?php echo $row['student_image'];?>" class="img-circle" width="30" />
                            <?php }else{ ?>
                            <img src="<?php echo base_url();?>uploads/user.jpg" class="img-circle" width="30" />
                            <?php }?>
                            </td>
                            
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['address'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td>
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        <!-- STUDENT EDITING LINK -->
                                        <li>
                                            <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_edit/<?php echo $row['student_id'];?>');">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
                                                </a>
                                        </li>
                                        <li class="divider"></li>
                                        
                                        <!-- STUDENT DELETION LINK 
                                        <li>
                                            <a href="javascript:void(0);" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/student/delete/<?php echo $row['student_id'];?>');">
                                                <i class="entypo-trash"></i>
                                                    <?php echo get_phrase('delete');?>
                                                </a>
                                        </li>-->
                                    </ul>
                                </div>
                                
                            </td>
                        </tr>
                        <?php endforeach; 
                        endforeach;?>
                        
                    </tbody>
                </table>
                
                </form>
                
                <script>
 jQuery(document).ready(function() {
      jQuery("#deletesall").click(function(){
        var student_length =  $(".checkbox1:checked").length;
        
           if(student_length < 1)
            {
                 alert('Please select at least one!');
                return false;    
            }
              
            var r = confirm("Do you want to delete selected data?");
                                
                                if (r == true) {
                                    
                                } else {
                                
                                   return false;
                                }       
                                });
  jQuery('#selecctall').click(function(event) {  
 
   if(this.checked) { 
    jQuery('.checkbox1').each(function() { 
     this.checked = true;          
    });
    }else{
    jQuery('.checkbox1').each(function() { 
     this.checked = false;               
    });         
   }
  });
  
  jQuery(".checkbox1").click(function(){
   if($(".checkbox1").length == $(".checkbox1:checked").length) {
    jQuery("#selecctall").prop("checked",true);
    } else {
    jQuery("#selecctall").prop("checked",false);
   }
   
  }); 
  
 });
</script>
                <?php }?>
                <?php if($_POST['list'] =='parent'){?> 
                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><div>Photo</div></th>
                            <th><div>Father's Name</div></th>
                            <th><div>Mother's Name</div></th>
                            <th><div>Class</div></th>
                            <th><div>Student Name</div></th>
                            <th><div>Email</div></th>                           
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                            $year_start_date=$this->session->userdata('start_date');
                            $year_end_date=$this->session->userdata('end_date');

                            if($_POST['student_id']==0)
                            {
                                $parent_list=$this->db->get_where('parent',array('created_date >='=>$year_start_date,'created_date <='=>$year_end_date))->result_array();
                            }
                            if($_POST['student_id'] != "" && $_POST['student_id']!=0 )
                            {
                                 $parent_list=$this->db->get_where('parent' , array('student_id' => $_POST['student_id'],'created_date >='=>$year_start_date,'created_date <='=>$year_end_date) )->result_array();
                            }
                            foreach($parent_list as $row):
                            ?>
                        <tr>
                            <td><?php echo $count++;?></td> 
                            <td><?php if($row['parent_image']!=''){ ?>
                            <img src=" <?php echo base_url();?>uploads/parent_image/<?php echo $row['parent_image'];?>" class="img-circle" width="30" />
                            <?php }else{ ?>
                            <img src="<?php echo base_url();?>uploads/user.jpg" class="img-circle" width="30" />
                            <?php }?>
                            </td>                          
                            <td><?php echo $row['name'];?></td> 
                            <td><?php echo $row['mother_name'];?></td> 
                            <td><?php echo $row['class_id'];?></td>                         
                            <td><?php 
                    $edit_data=$this->db->get_where('student' , array('student_id' => $row['student_id']) )->result_array();
                            foreach ($edit_data as $srow):              
                            
                                echo $srow['name'];
                            endforeach;
                            
                            ?></td>                          
                            <td><?php echo $row['parent_email'];?></td>
                            <td>                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        
                                        <!-- teacher EDITING LINK -->
                                        <li>
                                            <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_parent_edit/<?php echo $row['parent_id'];?>');">
                                                <i class="entypo-pencil"></i><?php echo get_phrase('edit');?>
                                            </a>
                                        </li>
                                        <!--<li class="divider"></li>-->
                                        
                                        <!-- teacher DELETION LINK -->
                                            <!--<li>
                                            <a href="javascript:void(0);" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/parent/delete/<?php echo $row['parent_id'];?>');">
                                                <i class="entypo-trash"></i>
                                                    <?php echo get_phrase('delete');?>
                                                </a>
                                        </li>-->
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php  endforeach;?>  
                    </tbody>
                </table>
                 <?php } if($_POST['list'] =='assessment'){?>
                 <table class="table table-bordered datatable" id="table_export_assessment" >
                 <thead>
                  <?php
                        $year_start_date=$this->session->userdata('start_date');
                        $year_end_date=$this->session->userdata('end_date');
                        $this->db->join('student', 'student.student_id = assessment.student_id');
                        $this->db->where('assessment.student_id',$_POST['student_id']);
                        $this->db->where('assessment.created_date >=',$year_start_date);
                        $this->db->where('assessment.created_date <=',$year_end_date);
                        $this->db->order_by("assessment_id", "desc");
                        $this->db->limit(2);
                        $assessment_list1=$this->db->get('assessment')->row();  ?>
                        <tr>
                            <th width="80"><div>Class</div></th>
                            <td style="background-color:#FFF;"><?php echo $assessment_list1->class_id;?></td>
                         </tr>
                          <tr>    <th style="background-color: rgb(255, 255, 255); border-right: medium none;"><div></div></th>
                            <th width="" style="background-color: rgb(255, 255, 255); border: medium none ! important;"><div></div></th>
                        </tr>
                         <tr>
                            <th width="100"><div>Student</div></th>
                            <td style="background-color:#FFF;"><?php echo $assessment_list1->name;?></td>
                         </tr>
                         <tr>    <th style="background-color: rgb(255, 255, 255); border-right: medium none;"><div></div></th>
                            <th width="" style="background-color: rgb(255, 255, 255); border: medium none ! important;"><div></div></th>
                        </tr>
                    </thead>
                    <thead>
                    <tr>    <th><div>Behaviour</div></th>
                            <th width="150"><div>Date</div></th>
                            <th width="80"><div>Action</div></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                                $this->db->join('student', 'student.student_id = assessment.student_id');
                                $this->db->where('assessment.student_id',$_POST['student_id']);
                                $this->db->order_by("assessment_id", "desc");
                                $this->db->limit(2);
                                $assessment_list=$this->db->get('assessment')->result_array();
                    $count=1;   
                    foreach($assessment_list as $row): ?>
                    <tr>
                        <td><?php echo $row['behaviour'];?></td>
                        <td><?php echo date("F d, Y h:i", strtotime($row['created_date']));?></td>
                        <td><?php if($count==1){  ?>
                            <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">                                        
                                    <!-- teacher EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_assessment/<?php echo $row['assessment_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                            Edit
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                        
                                    <!-- teacher DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/assessment/delete/<?php echo $row['assessment_id'];?>');">
                                            <i class="entypo-trash"></i>
                                            Remove                                                      
                                            </a>
                                    </li>
                                    </ul>
                                </div>
                             <?php } ?>
                        </td>
                    </tr>
                    <?php $count++;  endforeach; ?>
                    </tbody>
                </table>
                  <?php }
                  if($list =='exam_result'){
                    $this->db->select('mark.*,exam.out_of_marks');
                    $this->db->join('exam','exam.subject_id=mark.subject_name');
                    $mark=$this->db->get_where('mark' , array('mark.student_id' => $student_name,'mark.exam_id' => $exam_name))->result_array();
                    $get_exam_name=$this->db->get_where('exam' , array('exam_id' => $exam_name))->row();
                    if(count($mark) > 0)
                    {    
                    ?>
                <label>Class:</label>
                <label><?php echo $mark[0]['class_id']; ?></label><br/>
                <label>Exam:</label>
                <label><?php echo $exam_name; ?></label>

                <?php echo form_open(base_url() . 'index.php?admin/mark/do_update' , array('class' => 'form-horizontal validate','id'=>'change_mark_form','enctype' => 'multipart/form-data'));?>
                <table  class="table table-bordered datatable" id="table_export_exam_result">
                    <thead>
                        <tr>
                            <th><div>Subject</div></th>
                            <th><div>Mark obtained</div></th>
                            <th><div>Total Marks</div></th>
                            <th><div>Grade</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($mark as $row):?>
                        <tr>
                        <td><?php echo $row['subject_id'];?></td>
                        <td>
                            <div class="col-sm-6">
                            <input type="text" value="<?php echo $row['mark_obtained']?>" name="mark_obtained[]" id="mark_obtained" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"></div>
                            <input type="hidden" value="<?php echo $row['mark_id']?>" name="mark_id[]" id="mark_id">                              
                            </td>
                            <td><?php echo $row['out_of_marks'];?></td>
                            <td><?php 
                                $grade=$this->db->get_where('grade',array('from_mark <='=>$row['mark_obtained'],'to_mark>='=>$row['mark_obtained']))->row();
                                    echo $grade->grade_name;
                                ?></td>
                        </tr> 
                        <?php endforeach;?>
                        <tr>    
                            <?php 
                                $this->db->select_min('to_mark');
                                $grade_second_minimum=$this->db->get_where('grade',array())->row();
                            ?>
                            <td><label style="font-weight:900;float:right;">Total:- </label></td><td><label style="font-weight:900;"><?php 
                             $this->db->select_sum('mark_obtained');
                             $mark_total=$this->db->get_where('mark',
                             array('mark.student_id' => $student_name,'mark.exam_id' => $exam_name))->result_array();  
                             echo $mark_total[0][mark_obtained];
                             ?></label></td> 

                            <?php 
                            $this->db->select_sum('out_of_marks');
                            $this->db->join('exam','exam.subject_id=mark.subject_name');
                            $mark_out_of=$this->db->get_where('mark' , array('mark.student_id' => $student_name,'mark.exam_id' => $exam_name))->result_array();
                            ?>    
                            <td><label style="font-weight:900;"><?php echo $mark_out_of[0][out_of_marks]; ?></label>
                            </td>    
                            
                            <?php
                            $this->db->select('mark.subject_name');
                            $count_subject=$this->db->get_where('mark' , array('mark.student_id' => $student_name,'mark.exam_id' => $exam_name))->num_rows(); ?>    
                            <td><label style="font-weight:900;">Final Grade:-</label><label>
                            <?php $final_avg_mark=$mark_total[0][mark_obtained]/$count_subject;
                            $final_grade=$this->db->get_where('grade',array('from_mark <='=>$final_avg_mark,'to_mark>='=>$final_avg_mark))->row();
                           if($row['mark_obtained']<=$grade_second_minimum->to_mark)
                           {
                             echo "None";
                           }
                           else 
                           {
                             echo $final_grade->grade_name;
                           } 
                           ?>

                            </label>
                             <br/>      
                            <label style="font-weight:900;">Result:-</label>
                            <label><?php if($row['mark_obtained']<=$grade_second_minimum->to_mark){echo "Failed";}else{echo"Pass";} ?></label>
                            </td>

                        </tr>
                        <tr>
                            <td colspan="4" align="center" ><button type="submit" class="btn btn-info">Save</button></td>
                        </tr>
                    </tbody>
                </table>
                 </form> 
                 <?php }else{?><table id="table_export" class="table table-bordered datatable dataTable" aria-describedby="table_export_info"><tr><td>No Marks Available</td></tr></table> <?php } ?>  
               <?php } if($_POST['list'] =='subject'){?>
              <div class="ajax-content-container">
                <form action="<?php echo  base_url().'index.php?admin/delete_all_subject'; ?>" method="post">
                <table class="table table-bordered datatable" id="table_export">                    
                    <thead>
                        <tr>
                         <th>Select All<input type="checkbox" id="selecctall" name="class_ids"  /></th>
                            <th><div>Class</div></th>
                            <th><div><?php echo get_phrase('subject_name');?></div></th>
                            <th><div><?php echo get_phrase('teacher');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $count = 1;                     
                            $subject=$this->db->get_where('subject',array('class_id'=>$_POST['class_id']))->result_array();
                                foreach($subject as $row):?>
                        <tr>
                        <td><input type="checkbox" name="delete_id[]" value="<?php echo $row['subject_id'];?>" class="checkbox1" /></td>
                            <td><?php echo $row['class_id'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?>&nbsp;<?php                       
                                $teacher=$this->db->get_where('teacher',array('teaching_type'=>1,'teacher_id'=>$row['teacher_id']) )->row();        
                                if($teacher != ""){ ?>
                                <a href="download.php?file_name=<?php echo $this->crud_model->get_teacher_name_by_id('teacher',$row['teacher_id']);?>" class="links"><i class="fa fa-download"></i></a> 
                                <?php } ?>
                            </td>
                            <td>
                            <?php $get_subject=$this->db->get_where('exam',array('subject_id'=>$row['subject_id']))->num_rows(); 
                            if($get_subject>0){
                            }else{
                            ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_subject/<?php echo $row['subject_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/subject/delete/<?php echo $row['subject_id'];?>/<?php echo $row['class_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                Remove
                                            </a>
                                    </li>
                                </ul>
                            </div>
                            <?php }?>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                 <table>
                <tr><td><input type="submit" name="delete_all" class="btn btn-info"  id="deletesall"    value="Remove All"  /></td></tr>
                </table>
                </form>
                </div>
                <?php } if($_POST['list'] =='teacher_class_assoication'){?>
                <form action="<?php echo base_url().'index.php?admin/delete_all_association'; ?>" method="post">         
                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                         <th>Select All<input type="checkbox" id="selecctall" name="class_ids"  />                      
                         </th>
                            <th><div>#</div></th>
                            <th><div>Class Name</div></th>
                            <th><div>Teacher</div></th>                         
                            <th><div>Options</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $year_start_date=$this->session->userdata('start_date');
                        $year_end_date=$this->session->userdata('end_date');     
                        if($_POST['class_id']==0)
                        {
                            $class=$this->db->get_where('teacher_class_association',array('created_date >='=>$year_start_date,'created_date <='=>$year_end_date))->result_array();    
                        }else{ 
                        $class=$this->db->get_where('teacher_class_association',array('class_id'=>$_POST['class_id'],'created_date >='=>$year_start_date,'created_date <='=>$year_end_date))->result_array(); }   
                         foreach($class as $row):?>
                        <tr>
                          <td><input type="checkbox" name="delete_id[]" value="<?php echo $row['tca_id'];?>" class="checkbox1" /></td>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['class_id'];?></td>                             
                            <td><?php 
                                echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?>&nbsp;<?php                             
                                /*if(!empty($this->crud_model->get_teacher_name_by_id('teacher',$row['teacher_id']))){ ?>
                                <a href="download.php?file_name=<?php echo $this->crud_model->get_teacher_name_by_id('teacher',$row['teacher_id']);?>" class="links"><i class="fa fa-download"></i></a> 
                                <?php }*/   ?>
                            </td>
                            <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                   <!-- <li>
                                        <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_class/<?php echo $row['tca_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>-->
                                    
                                    <!-- DELETION LINK -->
                                    <?php $class = $this->db->get_where('student' , array('class_id' => $row['name_numeric']))->result_array();  
                                   if(count($class)=="")
                                   {
                                    ?>
                                    <li>
                                        <a href="javascript:void(0);" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/classes/delete/<?php echo $row['class_id'];?>');">
                                            <i class="entypo-trash"></i>
                                               Remove
                                            </a>
                                    </li>
                                    <?php } else{?>
                                        <?php }?>
                                </ul>
                            </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <table>
                <tr><td><input type="submit" name="delete_all"  id="deletesall"  class="btn btn-info"  value="Remove All"  /></td></tr>
                </table>
                </form> 
                <?php } ?>
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->    
                  
<script type="text/javascript">

    jQuery(document).ready(function($)
    {   
        var datatable = $("#table_export").dataTable({"oLanguage": { "sSearch": "Filter" } });
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        }); 
    });
    jQuery(document).ready(function($)
    {   
        var datatable = $("#table_export_assessment").dataTable({bFilter: false, bInfo: false,"bPaginate": false});
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        }); 
    });
        
</script>                