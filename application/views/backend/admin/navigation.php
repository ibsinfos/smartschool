<?php $level =$this->session->userdata('level'); ?>

<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">		
            <a href="<?php echo base_url(); ?>">
               <?php $image_admin=$this->db->get_where('admin', array('admin_id'=>$this->session->userdata('admin_id')))->row();?>
               <img width="60" height="60" class="img-circle" src="<?php echo base_url(); ?>/uploads/admin_image/<?php echo $image_admin->admin_image; ?>">
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

    <div style=""></div>
    <ul id="main-menu" class="">
      
		<?php
		 $display="";
		$run = "FIND_IN_SET('".$this->session->userdata('admin_id')."', user_role)";
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
		if(in_array($page_name,$final_module_assgin) || $level ==1 || $page_name=='dashboard' ||$page_name=='manage_profile' || $page_name=='notification' || $page_name=='reports' || $page_name=='system_settings' || $page_name=='admin' || $page_name=='message'|| $page_name == 'reports' || $page_name=='sidebar_ind_student' || $page_name=='sidebar_non_teaching_list' || $page_name=='fees_listing_page' || $page_name=='sidebar_holiday_list' || $page_name=='sidebar_notification' || $page_name=='share_materials_list' || $page_name=='sidebar_staff_attendance_list' || $page_name=='group_list' || $page_name=='sidebar_attendance' ||  $page_name=='sidebar_all_attendance_list' || $page_name=='sidebar_attendance_standard_list' || $page_name=='sidebar_attendance_class_wise' ||  $page_name=='sidebar_timetable_class_wise_list' || $page_name=='sidebar_timetable_teacher_wise_list' || $page_name=='sidebar_timetable_list' || $page_name=='sidebar_exam_mark_list' || $page_name=='sidebar_class_wise_exam_list' || $page_name=='sidebar_subject_wise_top3_student_list' || $page_name=='sidebar_class_wise_top3_student_list' || $page_name=='sidebar_student_mark_list' || $page_name=='sidebar_teacher_list' ){
		?>
        <!-- Admin --> 
        <li class="<?php if ($page_name == 'admin') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/admin" style="display:<?php if(in_array('admin',$final_module_assgin)  || $level ==1 ){echo "block";}else{echo "none";} ?>">
                        <span><i class="entypo-user"></i>Sub Admin Management</span>
                    </a>
                </li>
        <!-- STUDENT -->
        <li class="<?php
        if ($page_name == 'student_management' ||
                $page_name == 'parent' ||
                $page_name == 'class' ||
				$page_name == 'staff' ||
				$page_name == 'subject' ||
				$page_name == 'exam' ||
				$page_name == 'mark' ||
				$page_name == 'assessment' ||
                $page_name == 'student_marksheet' ||
				$page_name == 'time_table' || 
				$page_name == 'academic_year' )
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="entypo-user"></i>
                <span>Profile & Listing</span>
            </a>
            <ul>
                <!-- STUDENT ADMISSION -->
                <li class="<?php if ($page_name == 'student_management') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_management" style="display:<?php if(in_array('student_management',$final_module_assgin)  || $level ==1 ){echo "block";}else{echo "none";} ?>">
                        <span><i class="entypo-user"></i>Student & Parent</span>
                    </a>
                </li>
				<!-- Parent Listing -->
				<li class="<?php if ($page_name == 'parent') echo 'active'; ?> " style="display:<?php if(in_array('parent',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
					<a href="<?php echo base_url(); ?>index.php?admin/parent">
						<i class="entypo-user"></i>
						<span>Parent Listing</span>
					</a>
				</li>
				<!-- Staff -->
				<li class="<?php if ($page_name == 'staff') echo 'active'; ?>" style="display:<?php if(in_array('staff',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
					<a href="<?php echo base_url(); ?>index.php?admin/staff">
						<i class="entypo-users"></i>
						<span>Staff</span>					</a>
				</li>
				<!-- Subject -->
				<li class="<?php if ($page_name == 'subject') echo 'active'; ?>"  style="display:<?php if(in_array('subject',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
					<a href="<?php echo base_url(); ?>index.php?admin/subject">
						<i class="entypo-book"></i>
						<span>Subject</span>
					</a>
				</li> 
				
				<!-- Classes -->
				<li class="<?php if ($page_name == 'class') echo 'active'; ?> "  style="display:<?php if(in_array('class',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
					<a href="<?php echo base_url(); ?>index.php?admin/classes">
						<i class="entypo-home"></i><span>Teacher-Class Association</span>
					</a>
				</li>
                
                <!-- Assessment -->
                <li class="<?php if ($page_name == 'assessment') echo 'active'; ?>"  style="display:<?php if(in_array('assessment',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/assessment">
                        <i class="entypo-hourglass"></i>
                        <span>Assessment</span>
                    </a>
                </li>
				  <!-- EXAMS -->
					 <li class="<?php if ($page_name == 'exam') echo 'active'; ?>"  style="display:<?php if(in_array('exam',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
						<a href="<?php echo base_url(); ?>index.php?admin/exam">
							<i class="entypo-vcard"></i>
							<span>Exams</span>
						</a>
					</li> 
                    
                    <!-- Mark -->   
                    <li class="<?php if ($page_name == 'mark') echo 'active'; ?>"  style="display:<?php if(in_array('mark',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/mark">
                            <i class="entypo-credit-card"></i>
                            <span>Marks</span>
                        </a>
                    </li>

					<!-- Academic Year -->
                    <li class="<?php if ($page_name == 'academic_year') echo 'active'; ?>"  style="display:<?php if(in_array('academic_year',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/academic_year">
                            <i class="entypo-archive"></i>
                            <span>Academic Year</span>
                        </a>
                    </li>
                    <!-- Time Table -->
                    <li class="<?php if ($page_name == 'time_table') echo 'active'; ?>"  style="display:<?php if(in_array('time_table',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/time_table">
                            <i class="entypo-target"></i>
                            <span>Time Table</span>
                        </a>
                    </li>


            </ul>
        </li>

		<li class="<?php
        if (    $page_name == 'holiday' ||
				$page_name == 'student_attendance' ||
				$page_name == 'teacher_attendance' ||
				$page_name == 'share_material'  ||
				$page_name == 'import' ||
                $page_name == 'grade'
               )
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span>Miscellaneous</span>
            </a>
            <ul>
                <!-- Holidays --> 
                <li class="<?php if ($page_name == 'holiday') echo 'active'; ?>"  style="display:<?php if(in_array('holiday',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/holiday">
                        <i class="entypo-globe"></i>
                        <span>Holiday</span>
                    </a>
                </li>
                <!-- STUDENT ATTENDANCE -->
                <li class="<?php if ($page_name == 'student_attendance') echo 'active'; ?>"  style="display:<?php if(in_array('student_attendance',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/student_attendance">
                        <i class="entypo-compass"></i>
                        <span>Student Attendance</span>
                    </a>
                </li>
                <!-- Staff ATTENDANCE --> 
                <li class="<?php if ($page_name == 'teacher_attendance') echo 'active'; ?>"  style="display:<?php if(in_array('teacher_attendance',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/teacher_attendance">
                        <i class="entypo-compass"></i>
                        <span>Staff Attendance</span>
                    </a>
                </li>
                <!-- Share Study Material -->
                <li class="<?php if ($page_name == 'share_material') echo 'active'; ?>"  style="display:<?php if(in_array('share_material',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/share_material">
                    <i class="entypo-map"></i><span>Share Study Material</span></a>        			                </li>
                
                <!-- Import Export  --> 
                <li class="<?php if ($page_name == 'import') echo 'active'; ?>"  style="display:<?php if(in_array('import',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/import">
                        <i class="entypo-upload"></i>
                        <span>Import</span>
                    </a>
                </li> 

                <!-- Grade  --> 
                <li class="<?php if ($page_name == 'grade') echo 'active'; ?>"  style="display:<?php if(in_array('grade',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/grade">
                        <i class="entypo-hourglass"></i>
                        <span>Grade</span>
                    </a>
                </li> 
             </ul>
         </li>
         <!-- TRANSPORT MANAGEMENT -->
         <li class="<?php if ($page_name == 'transport'|| $page_name == 'route' || $page_name == 'route_assign_student') echo 'opened active has-sub';?> ">
            <a href="#">
                <i class="entypo-rocket"></i>
                <span>Transport Management</span>
            </a>
            <ul>
                <!-- Manage Transport --> 
                <li class="<?php if ($page_name == 'transport') echo 'active'; ?>"  style="display:<?php if(in_array('transport',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/transport">
                        <i class="entypo-rocket"></i>
                        <span>Manage Transport</span>
                    </a>
                </li>
                <!-- Manage Route --> 
                <li class="<?php if ($page_name == 'route') echo 'active'; ?>"  style="display:<?php if(in_array('route',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/route">
                        <i class="entypo-cloud"></i>
                        <span>Manage Route</span>
                    </a>
                </li>
                <!-- Route Assign Student --> 
                <li class="<?php if ($page_name == 'route_assign_student') echo 'active'; ?>"  style="display:<?php if(in_array('route_assign_student',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/route_assign_student">
                        <i class="entypo-location"></i>
                        <span>Route Assign Student</span>
                    </a>
                </li>
            </ul>
         </li>

		 	<!-- USER & ROLE MANAGEMENT -->
		<li class="<?php
        if ($page_name == 'create_group' ||$page_name == 'list_group' ||$page_name == 'update_group' ||$page_name == 'assign_module'||$page_name == 'list_module'||$page_name == 'update_module')echo 'opened active has-sub';?> ">
            <a href="#">
                <i class="entypo-user-add"></i>
                <span>User & Role Management</span>
            </a>
            <ul>
          
 		
        <li class="<?php if ($page_name == 'create_group' || $page_name == 'list_group' || $page_name == 'update_group') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-users"></i>Group Managemant</span>
                    </a>
                    <ul>
                        <li class="<?php if ($page_name == 'create_group') echo 'active'; ?>"  style="display:<?php if(in_array('create_group',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/create_group">
                            <i class="entypo-users"></i>
                            <span>Create Group</span>
                        </a>
                   		 </li>
                          <li class="<?php if ($page_name == 'list_group') echo 'active'; ?>"  style="display:<?php if(in_array('list_group',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/list_group">
                            <i class="entypo-users"></i>
                            <span>List Group</span>
                        </a>
                   		 </li>
                         <li class="<?php if ($page_name == 'update_group') echo 'active'; ?>"  style="display:<?php if(in_array('update_group',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/update_group">
                            <i class="entypo-users"></i>
                            <span>Update Group</span>
                        </a>
                         </li>
                    </ul>
                </li>
         <li class="<?php if ($page_name == 'assign_module' || $page_name == 'list_module') echo 'opened active'; ?> ">
          <a href="#">
          <span><i class="entypo-resize-small"></i>Module Management</span>
          </a>
          <ul>
          <li class="<?php if ($page_name == 'assign_module') echo 'active'; ?>"  style="display:<?php if(in_array('assign_module',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?admin/assign_module">
                <i class="entypo-resize-small"></i>
                <span>Assign Module</span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'list_module') echo 'active'; ?>"  style="display:<?php if(in_array('list_module',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?admin/list_module">
                <i class="entypo-resize-small"></i>
                <span>List Module</span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'update_module') echo 'active'; ?>"  style="display:<?php if(in_array('update_module',$final_module_assgin) || $level ==1 ){echo "block";}else{echo "none";} ?>">
            <a href="<?php echo base_url(); ?>index.php?admin/update_module">
                <i class="entypo-resize-small"></i>
                <span>Update Module</span>
            </a>
        </li>
          </ul>
          </li>

            </ul>
         </li>

		 <li class="<?php if ($page_name == 'reports' || $page_name=='sidebar_ind_student' || $page_name=='sidebar_non_teaching_list' || $page_name=='fees_listing_page' || $page_name=='sidebar_holiday_list' || $page_name=='sidebar_notification' || $page_name=='share_materials_list' || $page_name=='sidebar_staff_attendance_list' || $page_name=='group_list' || $page_name=='sidebar_attendance' ||  $page_name=='sidebar_all_attendance_list' || $page_name=='sidebar_attendance_standard_list' || $page_name=='sidebar_attendance_class_wise' ||  $page_name=='sidebar_timetable_class_wise_list' || $page_name=='sidebar_timetable_teacher_wise_list' || $page_name=='sidebar_timetable_list' || $page_name=='sidebar_exam_mark_list' || $page_name=='sidebar_class_wise_exam_list' || $page_name=='sidebar_subject_wise_top3_student_list' || $page_name=='sidebar_class_wise_top3_student_list' || $page_name=='sidebar_student_mark_list' || $page_name=='sidebar_teacher_list')echo 'opened active has-sub';?> ">
            <a href="#">
                <i class="entypo-floppy"></i>
                <span>Reports</span>
            </a>
            <ul>
        <!-- Report Section -->
     
            <!-- All Report List Mayur Panchal  -->
            <li class="<?php if ($page_name == 'sidebar_ind_student') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/report_newlist/ind_student">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('individual_student_report'); ?></span>
            </a>
            </li>
               <li class="<?php if ($page_name == 'sidebar_non_teaching_list') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/report_newlist/non_teaching">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('non-teaching_staff_listing'); ?></span>
            </a>
            </li>
           <!-- <li class="<?php if ($page_name == 'fees_listing_page') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/report_newlist/fees_listing">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('fees_listing'); ?></span>
            </a>
            </li>-->
             <li class="<?php if ($page_name == 'sidebar_holiday_list') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/report_newlist/holiday_list">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('holiday_list'); ?></span>
            </a>
            </li>
            <li class="<?php if ($page_name == 'sidebar_notification') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/report_newlist/notification_list">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('notification_list'); ?></span>
            </a>
            </li>
            <li class="<?php if ($page_name == 'share_materials_list') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/report_newlist/study_materials">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('study_materials'); ?></span>
            </a>
            </li>
            <li class="<?php if ($page_name == 'sidebar_staff_attendance_list') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/report_newlist/staff_attendence">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('staff_attendence'); ?></span>
            </a>
            </li>
            <li class="<?php if ($page_name == 'group_list') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/report_newlist/group_list">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('group_listings'); ?></span>
            </a>
            </li>
            
            <li class="<?php if ($page_name == 'sidebar_attendance' || $page_name=='sidebar_all_attendance_list' || $page_name=='sidebar_attendance_standard_list' || $page_name=='sidebar_attendance_class_wise') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/report_newlist/attendance">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('attendance'); ?></span>
            </a>
            </li>
            <li class="<?php if ( $page_name=='sidebar_timetable_class_wise_list' || $page_name=='sidebar_timetable_teacher_wise_list' || $page_name=='sidebar_timetable_list') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/report_newlist/timetable">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('timetable'); ?></span>
            </a>
            </li>
             <li class="<?php if ( $page_name=='sidebar_exam_mark_list' || $page_name=='sidebar_class_wise_exam_list' ) echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/report_newlist/exam_mark">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('exams'); ?></span>
            </a>
            </li>
             <li class="<?php if ( $page_name=='sidebar_student_mark_list' || $page_name=='sidebar_class_wise_top3_student_list' || $page_name=='sidebar_subject_wise_top3_student_list') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/report_newlist/marks">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('Marks'); ?></span>
            </a>
            </li>
             <li class="<?php if ( $page_name=='sidebar_teacher_list' ) echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/report_newlist/teacher_list">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('Teachers'); ?></span>
            </a>
            </li>
           </ul>
        </li> 
		<!-- SETTINGS -->
        <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
             <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
                <span><i class="entypo-cog"></i>General Setting</span>
             </a>
        </li>
        <!-- SMS Management -->
       <li class="<?php if ($page_name == 'sms_management' || $page_name == 'sms_settings') echo 'opened active'; ?> ">
                   <a href="#">
                        <span><i class="entypo-export"></i>SMS Mamagement</span>
                    </a>
                    <ul>
                       <li class="<?php if ($page_name == 'sms_management') echo 'active'; ?> ">
            			 <a href="<?php echo base_url(); ?>index.php?admin/sms_management">
             			   <span><i class="entypo-mail"></i>Send SMS</span>
           				 </a>
       				   </li>
                       <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
            			 <a href="<?php echo base_url(); ?>index.php?admin/sms_settings">
             			   <span><i class="entypo-mail"></i>SMS Setting</span>
           				 </a>
       				   </li>
       </ul>
      </li>
		
        <!-- History  -->
 		<li class="<?php if ($page_name == 'history_student' || $page_name == 'history_staff_detail') echo 'opened active'; ?> ">
                   <a href="#">
                        <span><i class="entypo-export"></i>History</span>
                    </a>
                    <ul>
                        <li class="<?php if ($page_name == 'history_student') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?admin/history_student">
                            <i class="entypo-user"></i>
                            <span>Student History</span>
                        </a>
                      </li>
                       <li class="<?php if ($page_name == 'history_staff_detail') echo 'active'; ?> ">
             <a href="<?php echo base_url(); ?>index.php?admin/history_staff_detail">
                <span><i class="entypo-users"></i>Staff History</span>
             </a>
        </li>
       </ul>
      </li>
        
          <?php } else{
			$url=base_url().'index.php?student/dashboard';
			echo "<script>alert('You have not permission of this module by admin'); window.location.href ='".$url."'</script>";} 
		?>
    </ul>
</div>
