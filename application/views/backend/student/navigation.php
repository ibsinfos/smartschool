<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
               <?php $image_admin=$this->db->get_where('student', array('student_id'=>$this->session->userdata('student_id')))->row();
                if($image_admin->student_image !=""){?>
                  <img width="60" height="60" class="img-circle" src="<?php echo base_url(); ?>/uploads/student_image/<?php echo $image_admin->student_image; ?>">  
                <?php
                }else{?>
                  <img width="60" height="60" class="img-circle" src="<?php echo base_url(); ?>/uploads/user.jpg">    
               <?php }
               ?>
               
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
			   <span><?php echo $this->session->userdata('login_type');?></span>
		</div>
    </header>

    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
    <ul id="main-menu" class="">
	<?php
		 $display="";
		$run = "FIND_IN_SET('".$this->session->userdata('student_id')."', user_role)";
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
		  //die;
   
   		if(in_array($page_name,$final_module_assgin) || $page_name=='dashboard' ||$page_name=='manage_profile' || $page_name=='notification' || $page_name=='reports' ||  $page_name=='student_non_technical_list' || $page_name=='fees_listing_page' || $page_name=='holiday_list' || $page_name == 'share_materials_list' || $page_name=='attendance_list' || $page_name=='class_timetable' || $page_name=='sidebar_timetable_class_wise_list' || $page_name=='exam_timetable' || $page_name=='sidebar_exam_mark_list' || $page_name=='sidebar_class_wise_exam_list' ||$page_name=='exam_marks'||$page_name=='message' ){?>
                
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
                <span>My Attendance</span>
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

        
        <!-- Payment -->
        <li class="<?php if ($page_name == 'financial_structure' )echo 'opened active';?>" style="display:<?php if(in_array('financial_structure',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/financial_structure">
                <i class="entypo-graduation-cap"></i>
                <span>Payment</span>
            </a>
        </li>
        
        <!-- History -->
        <li class="<?php if ($page_name == 'history' )echo 'opened active';?>" style="display:<?php if(in_array('history',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/history">
                <i class="entypo-globe"></i>
                <span>History</span>
            </a>
        </li>
        
        <!-- Holiday -->
        <li class="<?php if ($page_name == 'holiday' )echo 'opened active';?>" style="display:<?php if(in_array('holiday',$final_module_assgin)){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/holiday">
                <i class="entypo-graduation-cap"></i>
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
        <li class="<?php if($page_name == 'student_non_technical_list' || $page_name == 'fees_listing_page' || $page_name == 'holiday_list' || $page_name == 'share_materials_list' || $page_name=='attendance_list' || $page_name=='class_timetable' || $page_name=='exam_timetable' || $page_name=='sidebar_class_wise_exam_list'||$page_name=='exam_marks' || $page_name=='sidebar_exam_mark_list' ) echo 'opened active';?>">
				<a href="#">
					<i class="fa fa-group"></i>
					<span>Reports</span>
				</a>
				<ul>
					<!-- Report Section -->
					
					<!-- All Report List Mayur Panchal  -->
					
					<li class="<?php if ($page_name == 'student_non_technical_list') echo 'active'; ?> ">
						<a href="<?php echo base_url(); ?>index.php?student/reports/non_technical">
							<i class="entypo-doc-text-inv"></i>
							<span><?php echo get_phrase('non-teaching_staff_listing'); ?></span>
						</a>
					</li>
					<li style="display:none;" class="<?php if ($page_name == 'fees_listing_page') echo 'active'; ?> ">
						<a href="<?php echo base_url(); ?>index.php?student/reports/fees_listing">
							<i class="entypo-doc-text-inv"></i>
							<span><?php echo get_phrase('fees_listing'); ?></span>
						</a>
					</li>
					<li class="<?php if ($page_name == 'holiday_list') echo 'active'; ?> ">
						<a href="<?php echo base_url(); ?>index.php?student/reports/holiday_list">
							<i class="entypo-doc-text-inv"></i>
							<span><?php echo get_phrase('holiday_list'); ?></span>
						</a>
					</li>
					<li class="<?php if ($page_name == 'attendance_list') echo 'active'; ?> ">
						<a href="<?php echo base_url(); ?>index.php?student/reports/attendance">
							<i class="entypo-doc-text-inv"></i>
							<span><?php echo get_phrase('Attendance'); ?></span>
						</a>
					</li>
					
					<li class="<?php if ($page_name == 'share_materials_list') echo 'active'; ?> ">
						<a href="<?php echo base_url(); ?>index.php?student/reports/study_materials">
							<i class="entypo-doc-text-inv"></i>
							<span><?php echo get_phrase('study_materials'); ?></span>
						</a>
					</li>
					
					<li class="<?php if ($page_name == 'class_timetable') echo 'active'; ?> ">
						<a href="<?php echo base_url(); ?>index.php?student/reports/class_timetable">
							<i class="entypo-doc-text-inv"></i>
							<span><?php echo get_phrase('Class Timetable'); ?></span>
						</a>
					</li>
					
					<li class="<?php if ($page_name == 'exam_timetable') echo 'active'; ?> ">
						<a href="<?php echo base_url(); ?>index.php?student/reports/exam_timetable">
							<i class="entypo-doc-text-inv"></i>
							<span><?php echo get_phrase('Exam Timetable'); ?></span>
						</a>
					</li>					
					
					<li class="<?php if ($page_name == 'exam_marks') echo 'active'; ?> ">
						<a href="<?php echo base_url(); ?>index.php?student/reports/exam_marks">
							<i class="entypo-doc-text-inv"></i>
							<span><?php echo get_phrase('Marks'); ?></span>
						</a>
					</li>
					<!--     -->
				</ul>
			</li>
	<?php }else			{
			$url=base_url().'index.php?student/dashboard';
			echo "<script>alert('You haven not permission of this module by admin'); window.location.href ='".$url."'</script>";}
		?>
    </ul>
</div>