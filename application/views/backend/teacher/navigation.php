<div class="sidebar-menu">
    <header class="logo-env" >
        <!-- logo -->
       <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
               <?php $image_admin=$this->db->get_where('teacher', array('teacher_id'=>$this->session->userdata('teacher_id')))->row();
               if($image_admin->staff_image !=""){?>
                <img width="60" height="60" class="img-circle" src="<?php echo base_url(); ?>/uploads/teacher_image/<?php echo $image_admin->staff_image; ?>">
               <?php }else{
               ?>
               <img width="60" height="60" class="img-circle" src="<?php echo base_url(); ?>/uploads/user.jpg">
               <?php }?>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>
        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
        <div class="user_name">
				<strong><?php echo $image_admin->name; ?></strong>
			   <span><?php if ($this->session->userdata('teaching_type')==2){echo $image_admin->designation;}else{ echo $this->session->userdata('login_type');}?></span>
		</div>
    </header>

    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
    <ul id="main-menu" class="">
	<?php
		 $display="";
		$run = "FIND_IN_SET('".$this->session->userdata('teacher_id')."', user_role)";
		$this->db->where($run);
		$this->db->where('user_type',$this->session->userdata('user_type'));
		$user_role_query=$this->db->get('group')->result_array();
		foreach($user_role_query as $user_role_row):
		$module_role_query = $this->db->get_where('assign_module' , array('group_id' => $user_role_row['group_id']))->row();
		$assign_module_id=explode(',',$module_role_query->module_id);
		foreach($assign_module_id as $assign_module_id_row)
		{
			 $module_role_query_final = $this->db->get_where('modules' , array('module_id' => $assign_module_id_row))->result_array();
			 foreach($module_role_query_final as $module_role_query_row)
			 {	
				$final_module_assgin[] = $module_role_query_row['module_name_file'];
			 }
		}
		endforeach;
		//print_r($user_role_query);
			if(in_array($page_name,$final_module_assgin) || $page_name=='dashboard' ||$page_name=='manage_profile' || $page_name=='notification' || $page_name=='reports' || $page_name == 'sidebar_ind_student'  || $page_name=='parent_list' || $page_name=='non_teaching_list' || $page_name=='teacher_list' || $page_name == 'subject_wise_teacher' || $page_name=='class_wise_teacher' || $page_name=='standard_wise_teacher'  || $page_name=='all_teacher_list'  || $page_name=='teacher_timetable' || $page_name=='attendance_class_wise' || $page_name=='staff_attendence_list' || $page_name=='sidebar_holiday_list' || $page_name=='share_materials_list'|| $page_name=='exam_mark_list'|| $page_name=='class_wise_exam_list' || $page_name=='student_mark_list' || $page_name=='class_wise_top3_student_list' || $page_name=='subject_wise_top3_student_list'  || $page_name=='message')
			{	
			?>
         <!-- TEACHER -->
        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> " style="display:<?php if(in_array('teacher',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/teacher_list">
                <i class="entypo-users"></i>
                <span>Teacher</span>
            </a>
        </li>
        
		<!-- Assessment -->
        <li class="<?php if ($page_name == 'assessment') echo 'active'; ?>" style="display:<?php if(in_array('assessment',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/assessment">
                <i class="entypo-hourglass"></i>
                <span>Assessment</span>
            </a>
        </li>
        
        <!-- STUDENT ATTENDANCE -->
        <li class="<?php if ($page_name == 'student_attendance') echo 'active'; ?>" style="display:<?php if(in_array('student_attendance',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_attendance">
                <i class="entypo-compass"></i>
                <span>Student Attendance</span>
            </a>
        </li>
        
		<!-- SUBJECT -->
        <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> " style="display:<?php if(in_array('subject',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/subject">
                <i class="entypo-book"></i>
                <span>Subject</span>
            </a>
        </li>
        
         <!-- Time Table -->
        <li class="<?php if ($page_name == 'time_table') echo 'active'; ?>" style="display:<?php if(in_array('time_table',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/time_table">
                <i class="entypo-target"></i>
                <span>Time Table</span>
            </a>
        </li>
        
        <!-- Share Study Material -->
        <li class="<?php if ($page_name == 'share_material') echo 'active'; ?>" style="display:<?php if(in_array('share_material',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/share_material">
                <i class="entypo-map"></i>
                <span>Share Study Material</span>
            </a>
        </li>
        
		<!-- EXAMS -->
        <li class="<?php if ($page_name == 'exam' )echo 'opened active';?>" style="display:<?php if(in_array('exam',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/exam">
                <i class="entypo-vcard"></i>
                <span>Exam</span>
            </a>
        </li>
        
        <!-- Mark -->
        <li class="<?php if ($page_name == 'mark' )echo 'opened active';?>" style="display:<?php if(in_array('mark',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/mark">
                <i class="entypo-credit-card"></i>
                <span>Mark</span>
            </a>
        </li>
        
        <!-- Payment 
        <li class="<?php if ($page_name == 'financial_structure' )echo 'opened active';?>" style="display:<?php if(in_array('financial_structure',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/financial_structure">
                <i class="entypo-graduation-cap"></i>
                <span>Payment</span>
            </a>
        </li>-->
        
        <!-- History -->
        <li class="<?php if ($page_name == 'history' )echo 'opened active';?>" style="display:<?php if(in_array('history',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/history">
                <i class="entypo-graduation-cap"></i>
                <span>History</span>
            </a>
        </li>
        
        <!-- Holiday -->
        <li class="<?php if ($page_name == 'holiday' )echo 'opened active';?>" style="display:<?php if(in_array('holiday',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/holiday">
                <i class="entypo-globe"></i>
                <span>Holiday</span>
            </a>
        </li>

		<!-- Parents -->
        <li class="<?php if ($page_name == 'parent' )echo 'opened active';?>" style="display:<?php if(in_array('parent',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/parent">
                <i class="entypo-user"></i>
                <span>Parent</span>
            </a>
        </li>
        
        <li class="<?php if( $page_name == 'sidebar_ind_student' || $page_name=='parent_list'  || $page_name=='non_teaching_list'  || $page_name=='teacher_list' || $page_name == 'subject_wise_teacher' || $page_name=='class_wise_teacher' || $page_name=='standard_wise_teacher'  || $page_name=='all_teacher_list'  || $page_name=='teacher_timetable' || $page_name=='attendance_class_wise' || $page_name=='staff_attendance_list' || $page_name=='staff_attendence_list' || $page_name=='sidebar_holiday_list' || $page_name=='share_materials_list' || $page_name=='student_mark_list' || $page_name=='class_wise_top3_student_list' || $page_name=='subject_wise_top3_student_list' || $page_name=='exam_mark_list'|| $page_name=='class_wise_exam_list' ) echo 'opened active';?>">
            <a href="#">
                <i class="fa fa-group"></i>
                <span>Reports</span>
            </a>
            <ul>
        <!-- Report Section -->
     
            <!-- All Report List Mayur Panchal  -->
          
               <li class="<?php if ($page_name == 'sidebar_ind_student') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?teacher/reports/ind_student">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('individual_student_report'); ?></span>
            </a>
            </li>
            <li class="<?php if ($page_name == 'parent_list') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?teacher/reports/parent_list">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('parent_list'); ?></span>
            </a>
            </li>
             <li class="<?php if ($page_name == 'non_teaching_list') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?teacher/reports/non_teaching_list">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('Non-Teaching Staff Listing'); ?></span>
            </a>
            </li>
               <li class="<?php if ($page_name == 'teacher_list'  || $page_name == 'subject_wise_teacher' ||  $page_name=='class_wise_teacher' || $page_name=='standard_wise_teacher' || $page_name=='all_teacher_list') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?teacher/reports/teacher_lists">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('teacher_list'); ?></span>
            </a>
            </li>
            
              <li class="<?php if ($page_name == 'teacher_timetable') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?teacher/reports/timetable">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('timetable'); ?></span>
            </a>
            </li>
            <li class="<?php if ($page_name == 'attendance_class_wise' || $page_name=='staff_attendence_list') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?teacher/reports/attendance">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('attendance'); ?></span>
            </a>
            </li>
            <li class="<?php if ($page_name == 'sidebar_holiday_list' ) echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?teacher/reports/holiday">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('holiday'); ?></span>
            </a>
            </li>
            <li class="<?php if ($page_name == 'share_materials_list' ) echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?teacher/reports/study_materials">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('study_materials'); ?></span>
            </a>
            </li>
			<li class="<?php if ($page_name == 'exam_list'  || $page_name == 'class_wise_exam' ||  $page_name=='exam_mark_list'|| $page_name=='class_wise_exam_list' ) echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?teacher/reports/exam_list">
                <i class="entypo-doc-text-inv"></i>
                <span>Exam</span>
            </a>
            </li>
            <li class="<?php if ($page_name == 'marks'  || $page_name == 'class_wise_exam' || $page_name=='class_wise_top3_student_list' || $page_name=='subject_wise_top3_student_list') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?teacher/reports/marks">
                <i class="entypo-doc-text-inv"></i>
                <span>Mark</span>
            </a>
            </li>	
            <!--     -->
           </ul>
        </li>
		<?php }else{
			$url=base_url().'index.php?student/dashboard';
			echo "<script>alert('You haven not permission of this module by admin'); window.location.href ='".$url."'</script>";}
		?>
    </ul>
</div>