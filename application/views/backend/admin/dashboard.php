<div class="row">
	<div class="col-md-12">
    	<div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        
                    </div>
                    <div class="panel-body">

                <div class="gallery-env">
				<div class="row">
               <div class="col-sm-4"  >
               <?php //if() 
			   $short1 =	$this->db->get_where("saved_reports",array("report_id"=>"1"))->result_array();
			   //echo $short1[0]['teacher_list'];
			   
			   if($short1[0]['ind_student']=="" && $short1[0]['non_teaching_list']=="" && $short1[0]['fees_listing_page']=="" && $short1[0]['holiday_list']=="" && $short1[0]['notification_list']=="" && $short1[0]['share_materials_list']=="" && $short1[0]['staff_attendence_list']==""  && $short1[0]['group_list']==""  && $short1[0]['attendance_view']=="" && $short1[0]['timetable_list']=="" && $short1[0]['exam_mark_list']=="" && $short1[0]['teacher_list']=="" && $short1[0]['marks_list']==""){
				   $short_class = 'active';
				   $main_class = 'active';
				   }
				   else{
					  $short_class = 'inactive'; 
					  $main_class = 'inactive';
					   }
			   ?>
                <div class="box-content  dashboard-box">
                <h4 id="shortcut1" class="<?php echo $short_class; ?>">Shortcut 1</h4>
                    <div class="form-group <?php echo $main_class; ?>" id="report_maindiv1">
                        <label class="col-sm-6 control-label"></label>
                        <div class="">
                         <select name="report_list" style="width:100%;" class="form-control" data-validate="required" id="report_list1" data-message-required="<?php echo get_phrase('value_required');?>"  >
                                <option value="">Select Report</option>
                                <option value="ind_student">Individual Student Report</option>
                                <option value="non_teaching_list">Non-Teaching Staff Listing</option>
                                <option value="fees_listing_page">Fees Listing</option>
                                <option value="holiday_list">Holiday List</option>
                                <option value="notification_list">Notification List</option>				
                                <option value="share_materials_list">Study Materials Uploaded</option>				
                                <option value="staff_attendence_list">Staff Attendance</option>				
                                <option value="teacher_list">Teacher List</option>
                                <option value="group_list">Group Listings</option>
                                <option value="attendance_view">Attendance</option>
                                <option value="timetable_list">Timetable</option>
                                <option value="exam_mark_list">Exams</option>
                                 <option value="marks_list">Marks</option>	
                                 				
                            </select>	
                        </div>
                    </div>	
               <?php $report1 =  $this->db->get_where("saved_reports",array("report_id"=>"1"))->result_array(); ?>
                <div id="saved_item1" style="clear:both">
                <?php
				 if($short1[0]['ind_student']=="" && $short1[0]['non_teaching_list']=="" && $short1[0]['fees_listing_page']=="" && $short1[0]['holiday_list']=="" && $short1[0]['notification_list']=="" && $short1[0]['share_materials_list']=="" && $short1[0]['staff_attendence_list']==""  && $short1[0]['group_list']==""  && $short1[0]['attendance_view']=="" && $short1[0]['timetable_list']=="" && $short1[0]['exam_mark_list']=="" && $short1[0]['teacher_list']=="" && $short1[0]['marks_list']==""){
				   $add_class = 'inactive';
				   
				   }
				   else{
					 $add_class = 'inactive';
					   }
					   ?>
				<a href="javascript:void(0);" id="link_shortcut" class="<?php echo $add_class; ?>">Add Shortcut</a>
			
			<?php	 foreach($report1 as $row): 
				
				?>
                <?php if($row['ind_student']=="1"){ ?>
                <?php $ind_class="active"; ?>
                <?php }else{
					$ind_class = 'inactive';
					} ?>
                <div id="ind_student1" class="<?php echo $ind_class; ?>">
				  <a onclick="showpopup(this);"  class="title" id="ind_student" href="javascript:void(0);">Individual Student Report</a>
         	      <a onclick="showdropdown(this);" class="btn" id="ind_student1" >
				  <i class="entypo-pencil"></i>Change</a>
                  <a onclick="delete_reportlist(this);" class="btn" id="ind_student" href="javascript:void(0);">
                  <i class="entypo-trash"></i>Remove</a>
                   
                  </div>
                
                
				 <?php if($row['non_teaching_list']=="1"){ ?>
                   <?php $non_class="active"; ?>
                <?php }else{
					$non_class = 'inactive';
					} 
					?>
                  <div id="non_teaching_list1" class="<?php echo $non_class; ?>">
					<a onclick="showpopup(this);" class="title" id="non_teaching_list"  href="javascript:void(0);">Non-Teaching Staff Listing</a>
                    <a onclick="showdropdown(this);" class="btn" id="non_teaching_list1"   href="javascript:void(0);">
                    <i class="entypo-pencil"></i>Change</a>
                    <a onclick="delete_reportlist(this);" class="btn" id="non_teaching_list" href="javascript:void(0);">
                    <i class="entypo-trash"></i>Remove</a>
                     
                    </div>
                
              
				<?php if($row['fees_listing_page']=='1'){ ?>
                  <?php $fee_class="active"; ?>
                <?php }else{
					$fee_class = 'inactive';
					} ?>
                <div id="fees_listing_page1" class="<?php echo $fee_class; ?>">
				<a onclick="showpopup(this);" class="title" id="fees_listing_page" href="javascript:void(0);">Fees Listing</a>	                
                <a onclick="showdropdown(this);" class="btn" id="fees_listing_page1" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist(this);" class="btn" id="fees_listing_page" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                <?php if($row['holiday_list']=='1'){ ?>
                 <?php $holy_class="active"; ?>
                <?php }else{
					$holy_class = 'inactive';
					 } ?>
                <div id="holiday_list1" class="<?php echo $holy_class; ?>">
				<a onclick="showpopup(this);" class="title" id="holiday_list" href="javascript:void(0);">Holiday List</a>	                
                <a onclick="showdropdown(this);" class="btn" id="holiday_list1" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist(this);" class="btn" id="holiday_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
               <?php if($row['notification_list']=='1'){ ?>
               <?php $notify_class   = "active"; }else{?>
               <?php $notify_class   = "inactive"; ?>
               <?php } ?>
				 <div id="notification_list1" class="<?php echo $notify_class; ?>">
				<a onclick="showpopup(this);" class="title" id="notification_list" href="javascript:void(0);">Notification List</a>	                
                <a onclick="showdropdown(this);" class="btn" id="notification_list1" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist(this);" class="btn" id="notification_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                 <?php if($row['share_materials_list']=='1'){ ?>
               <?php $share_class   = "active"; }else{?>
               <?php $share_class   = "inactive"; ?>
               <?php } ?>
				 <div id="share_materials_list1" class="<?php echo $share_class; ?>">
				<a onclick="showpopup(this);" class="title" id="share_materials_list" href="javascript:void(0);">Study Materials Uploaded</a>	                
                <a onclick="showdropdown(this);" class="btn" id="share_materials_list1" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist(this);" class="btn" id="share_materials_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                
                </div>
                
                  <?php if($row['staff_attendence_list']=='1'){ ?>
               <?php $staff_class   = "active"; }else{?>
               <?php $staff_class   = "inactive"; ?>
               <?php } ?>
				 <div id="staff_attendence_list1" class="<?php echo $staff_class; ?>">
				<a onclick="showpopup(this);" class="title" id="staff_attendence_list" href="javascript:void(0);">Staff Attendance</a>                <a onclick="showdropdown(this);" class="btn" id="staff_attendence_list1" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist(this);" class="btn" id="staff_attendence_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                  
                  
                </div>
                 <?php if($row['teacher_list']=='1'){ ?>
               <?php $teach_class   = "active"; }else{?>
               <?php $teach_class   = "inactive"; ?>
               <?php } ?>
				 <div id="teacher_list1" class="<?php echo $teach_class; ?>">
				<a onclick="showpopup(this);" class="title" id="teacher_list" href="javascript:void(0);">Teacher List</a>                <a onclick="showdropdown(this);" class="btn" id="teacher_list1" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist(this);" class="btn" id="teacher_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                  
                  
                </div>
                 
                 
                 <?php if($row['group_list']=='1'){ ?>
               <?php $group_class   = "active"; }else{?>
               <?php $group_class   = "inactive"; ?>
               <?php } ?>
				 <div id="group_list1" class="<?php echo $group_class; ?>">
				<a onclick="showpopup(this);" id="group_list" class="title" href="javascript:void(0);">Group Listings</a>                <a onclick="showdropdown(this);" class="btn" id="group_list1" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist(this);" class="btn"  id="group_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
               
                </div>
                 
                  <?php if($row['attendance_view']=='1'){ ?>
                   
               <?php $attend_class   = "active"; }else{?>
               <?php $attend_class   = "inactive"; ?>
               <?php } ?>
				 <div id="attendance_view1" class="<?php echo $attend_class; ?>">
				<a onclick="showpopup(this);" class="title" id="attendance_view" href="javascript:void(0);">Attendance</a>                <a onclick="showdropdown(this);" class="btn" id="attendance_view1" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist(this);" class="btn" id="attendance_view" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>  
                <br /> 
                </div>
               
                 <?php if($row['timetable_list']=='1'){ ?>
                
               <?php $time_class   = "active"; }else{?>
               <?php $time_class   = "inactive"; ?>
               <?php } ?>
				 <div id="timetable_list1" class="<?php echo $time_class; ?>">
				<a onclick="showpopup(this);" class="title" id="timetable_list" href="javascript:void(0);">Timetable</a>                <a onclick="showdropdown(this);" class="btn" id="timetable_list1" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist(this);"  class="btn" id="timetable_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                
                </div>
             
                 <?php if($row['exam_mark_list']=='1'){ ?>
                   
               <?php $mark_class   = "active"; }else{?>
               <?php $mark_class   = "inactive"; ?>
               <?php } ?>
				 <div id="exam_mark_list1" class="<?php echo $mark_class; ?>">
				<a onclick="showpopup(this);" class="title" id="exam_mark_list" href="javascript:void(0);">Exams</a>                <a onclick="showdropdown(this);" class="btn" id="exam_mark_list1" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist(this);" class="btn" id="exam_mark_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                  <?php if($row['marks_list']=='1'){ ?>
                   
               <?php $marks_class   = "active"; }else{?>
               <?php $marks_class   = "inactive"; ?>
               <?php } ?>
				 <div id="marks_list1" class="<?php echo $marks_class; ?>">
				<a onclick="showpopup(this);" class="title" id="marks_list" href="javascript:void(0);">Marks</a>                <a onclick="showdropdown(this);" class="btn" id="marks_list1" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist(this);" class="btn" id="marks_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
               
                
                
				<?php endforeach; ?>
              
                
                </div>	
                </div>
                </div>
               <!--    #shortcut 2  --> 
                
               <div class="col-sm-4"  >
                 <?php //if() 
			   $short2 =	$this->db->get_where("saved_reports",array("report_id"=>"2"))->result_array();
			   
			   if($short2[0]['ind_student']=="" && $short2[0]['non_teaching_list']=="" && $short2[0]['fees_listing_page']=="" && $short2[0]['holiday_list']=="" && $short2[0]['notification_list']=="" && $short2[0]['share_materials_list']=="" && $short2[0]['staff_attendence_list']==""  && $short2[0]['group_list']==""  && $short2[0]['attendance_view']=="" && $short2[0]['timetable_list']=="" && $short2[0]['exam_mark_list']=="" && $short2[0]['teacher_list']=="" && $short2[0]['marks_list']==""){
				   $short2_class = 'active';
				   $main2_class = 'active';
				   }
				   else{
					  $short2_class = 'inactive'; 
					  $main2_class = 'inactive';
					   }
			   ?>
                <div class="box-content  dashboard-box">
               
                    <h4 id="shortcut2" class="<?php echo $short2_class; ?>">Shortcut 2</h4>
                    <div class="form-group <?php echo $main2_class; ?>" id="report_maindiv2">
                        <label class="col-sm-6 control-label"></label>
                        <div class="">
                         <select name="report_list" style="width:100%;" class="form-control" data-validate="required" id="report_list2" data-message-required="<?php echo get_phrase('value_required');?>"  >
                                <option value="">Select Report</option>
                                <option value="ind_student">Individual Student Report</option>
                                <option value="non_teaching_list">Non-Teaching Staff Listing</option>
                                <option value="fees_listing_page">Fees Listing</option>
                                <option value="holiday_list">Holiday List</option>
                                <option value="notification_list">Notification List</option>				
                                <option value="share_materials_list">Study Materials Uploaded</option>				
                                <option value="staff_attendence_list">Staff Attendance</option>
                                <option value="teacher_list">Teacher List</option>				
                                <option value="group_list">Group Listings</option>
                                <option value="attendance_view">Attendance</option>
                                <option value="timetable_list">Timetable</option>
                                <option value="exam_mark_list">Exams</option>	
                                <option value="marks_list">Marks</option>			
                            </select>	
                        </div>
                    </div>	
               <?php $report2 =  $this->db->get_where("saved_reports",array("report_id"=>"2"))->result_array(); ?>
                <div id="saved_item2" style="clear:both">
                <?php
				 if($short2[0]['ind_student']=="" && $short2[0]['non_teaching_list']=="" && $short2[0]['fees_listing_page']=="" && $short2[0]['holiday_list']=="" && $short2[0]['notification_list']=="" && $short2[0]['share_materials_list']=="" && $short2[0]['staff_attendence_list']==""  && $short2[0]['group_list']==""  && $short2[0]['attendance_view']=="" && $short2[0]['timetable_list']=="" && $short2[0]['exam_mark_list']=="" && $short2[0]['teacher_list']=="" && $short2[0]['marks_list']==""){
				   $add_class2 = 'inactive';
				   
				   }
				   else{
					 $add_class2 = 'inactive';
					   }
					   ?>
				<a href="javascript:void(0);" id="link_shortcut2" class="<?php echo $add_class2; ?>">Add Shortcut</a>
			
			<?php	 foreach($report2 as $row): 
				
				?>
                <?php if($row['ind_student']=="1"){ ?>
                <?php $ind_class2 ="active"; ?>
                <?php }else{
					$ind_class2 = 'inactive';
					} ?>
                <div id="ind_student2" class="<?php echo $ind_class2; ?>">
				  <a onclick="showpopup(this);" class="title" id="ind_student" href="javascript:void(0);">Individual Student Report</a>
         	      <a onclick="showdropdown2(this);" class="btn" id="ind_student2" >
				  <i class="entypo-pencil"></i>Change</a>
                  <a onclick="delete_reportlist2(this);" class="btn" id="ind_student" href="javascript:void(0);">
                  <i class="entypo-trash"></i>Remove</a>
                   
                  </div>
                
                
				 <?php if($row['non_teaching_list']=="1"){ ?>
                   <?php $non_class2="active"; ?>
                <?php }else{
					$non_class2 = 'inactive';
					} 
					?>
                  <div id="non_teaching_list2" class="<?php echo $non_class2; ?>">
					<a onclick="showpopup(this);" class="title" id="non_teaching_list"  href="javascript:void(0);">Non-Teaching Staff Listing</a>
                    <a onclick="showdropdown2(this);" class="btn" id="non_teaching_list2"   href="javascript:void(0);">
                    <i class="entypo-pencil"></i>Change</a>
                    <a onclick="delete_reportlist2(this);" class="btn" id="non_teaching_list" href="javascript:void(0);">
                    <i class="entypo-trash"></i>Remove</a>
                     
                    </div>
                
              
				<?php if($row['fees_listing_page']=='1'){ ?>
                  <?php $fee_class2="active"; ?>
                <?php }else{
					$fee_class2 = 'inactive';
					} ?>
                <div id="fees_listing_page2" class="<?php echo $fee_class2; ?>">
				<a onclick="showpopup(this);" class="title" id="fees_listing_page" href="javascript:void(0);">Fees Listing</a>	                
                <a onclick="showdropdown2(this);" class="btn" id="fees_listing_page2" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist2(this);" class="btn" id="fees_listing_page" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                <?php if($row['holiday_list']=='1'){ ?>
                 <?php $holy_class2="active"; ?>
                <?php }else{
					$holy_class2 = 'inactive';
					 } ?>
                <div id="holiday_list2" class="<?php echo $holy_class2; ?>">
				<a onclick="showpopup(this);" class="title" id="holiday_list" href="javascript:void(0);">Holiday List</a>	                
                <a onclick="showdropdown2(this);" class="btn" id="holiday_list2" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist2(this);" class="btn" id="holiday_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
               <?php if($row['notification_list']=='1'){ ?>
               <?php $notify_class2   = "active"; }else{?>
               <?php $notify_class2   = "inactive"; ?>
               <?php } ?>
				 <div id="notification_list2" class="<?php echo $notify_class2; ?>">
				<a onclick="showpopup(this);" class="title" id="notification_list" href="javascript:void(0);">Notification List</a>	                
                <a onclick="showdropdown2(this);" class="btn" id="notification_list2" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist2(this);" class="btn" id="notification_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                 <?php if($row['share_materials_list']=='1'){ ?>
               <?php $share_class2   = "active"; }else{?>
               <?php $share_class2   = "inactive"; ?>
               <?php } ?>
				 <div id="share_materials_list2" class="<?php echo $share_class2; ?>">
				<a onclick="showpopup(this);"  class="title" id="share_materials_list" href="javascript:void(0);">Study Materials Uploaded</a>	                
                <a onclick="showdropdown2(this);" class="btn" id="share_materials_list2" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist2(this);" class="btn" id="share_materials_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                
                </div>
                
                  <?php if($row['staff_attendence_list']=='1'){ ?>
               <?php $staff_class2   = "active"; }else{?>
               <?php $staff_class2   = "inactive"; ?>
               <?php } ?>
				 <div id="staff_attendence_list2" class="<?php echo $staff_class2; ?>">
				<a onclick="showpopup(this);" class="title" id="staff_attendence_list" href="javascript:void(0);">Staff Attendance</a>                <a onclick="showdropdown2(this);" class="btn" id="staff_attendence_list2" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist2(this);" class="btn" id="staff_attendence_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                  
                </div>
                
                 <?php if($row['teacher_list']=='1'){ ?>
               <?php $teach_class2   = "active"; }else{?>
               <?php $teach_class2   = "inactive"; ?>
               <?php } ?>
				 <div id="teacher_list2" class="<?php echo $teach_class2; ?>">
				<a onclick="showpopup(this);" class="title" id="teacher_list" href="javascript:void(0);">Teacher List</a>                <a onclick="showdropdown2(this);" class="btn" id="teacher_list2" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist2(this);" class="btn" id="teacher_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                  
                  
                </div>
                 
                 <?php if($row['group_list']=='1'){ ?>
               <?php $group_class2   = "active"; }else{?>
               <?php $group_class2   = "inactive"; ?>
               <?php } ?>
				 <div id="group_list2" class="<?php echo $group_class2; ?>">
					<a onclick="showpopup(this);" class="title" id="group_list" href="javascript:void(0);">Group Listings</a>    	            <a onclick="showdropdown2(this);" class="btn" id="group_list2" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist2(this);" class="btn" id="group_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
               
                </div>
                 
                  <?php if($row['attendance_view']=='1'){ ?>
                   
               <?php $attend_class2   = "active"; }else{?>
               <?php $attend_class2   = "inactive"; ?>
               <?php } ?>
				 <div id="attendance_view2" class="<?php echo $attend_class2; ?>">
				<a onclick="showpopup(this);" class="title" id="attendance_view" href="javascript:void(0);">Attendance</a>                <a onclick="showdropdown2(this);" class="btn" id="attendance_view2" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist2(this);" class="btn" id="attendance_view" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>  
                <br /> 
                </div>
               
                 <?php if($row['timetable_list']=='1'){ ?>
                
               <?php $time_class2   = "active"; }else{?>
               <?php $time_class2   = "inactive"; ?>
               <?php } ?>
				 <div id="timetable_list2" class="<?php echo $time_class2; ?>">
				<a onclick="showpopup(this);" class="title" id="timetable_list" href="javascript:void(0);">Timetable</a>                		<a onclick="showdropdown2(this);" class="btn" id="timetable_list2" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist2(this);" class="btn" id="timetable_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                
                </div>
             
                 <?php if($row['exam_mark_list']=='1'){ ?>
                   
               <?php $mark_class2   = "active"; }else{?>
               <?php $mark_class2   = "inactive"; ?>
               <?php } ?>
				 <div id="exam_mark_list2" class="<?php echo $mark_class2; ?>">
				<a onclick="showpopup(this);" class="title" id="exam_mark_list" href="javascript:void(0);">Exams</a>                <a onclick="showdropdown2(this);" class="btn" id="exam_mark_list2" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist2(this);" class="btn" id="exam_mark_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
               <?php if($row['marks_list']=='1'){ ?>
                   
               <?php $marks_class2   = "active"; }else{?>
               <?php $marks_class2   = "inactive"; ?>
               <?php } ?>
				 <div id="marks_list2" class="<?php echo $marks_class2; ?>">
				<a onclick="showpopup(this);" class="title" id="marks_list" href="javascript:void(0);">Marks</a>                <a onclick="showdropdown2(this);" class="btn" id="marks_list2" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist2(this);" class="btn" id="marks_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
               
                
                
				<?php endforeach; ?>
              
                
                </div>
                </div>
             
                </div>
                
                <!--    end shortcut2  -->
                
               <!--    #shortcut3   --> 
               <div class="col-sm-4"  >
                 <?php //if() 
			   $short3 =	$this->db->get_where("saved_reports",array("report_id"=>"3"))->result_array();
			   
			   if($short3[0]['ind_student']=="" && $short3[0]['non_teaching_list']=="" && $short3[0]['fees_listing_page']=="" && $short3[0]['holiday_list']=="" && $short3[0]['notification_list']=="" && $short3[0]['share_materials_list']=="" && $short3[0]['staff_attendence_list']==""  && $short3[0]['group_list']==""  && $short3[0]['attendance_view']=="" && $short3[0]['timetable_list']=="" && $short3[0]['exam_mark_list']=="" && $short3[0]['marks_list']==""){
				   $short3_class = 'active';
				   $main3_class = 'active';
				   }
				   else{
					  $short3_class = 'inactive'; 
					  $main3_class = 'inactive';
					   }
			   ?>
                <div class="box-content dashboard-box">
               
                    <h4 id="shortcut3" class="<?php echo $short3_class; ?>">Shortcut 3</h4>
                    <div class="form-group <?php echo $main3_class; ?>" id="report_maindiv3">
                        <label class="col-sm-6 control-label"></label>
                        <div class="">
                         <select name="report_list3" style="width:100%;" class="form-control" data-validate="required" id="report_list3" data-message-required="<?php echo get_phrase('value_required');?>"  >
                                <option value="">Select Report</option>
                                <option value="ind_student">Individual Student Report</option>
                                <option value="non_teaching_list">Non-Teaching Staff Listing</option>
                                <option value="fees_listing_page">Fees Listing</option>
                                <option value="holiday_list">Holiday List</option>
                                <option value="notification_list">Notification List</option>				
                                <option value="share_materials_list">Study Materials Uploaded</option>				
                                <option value="staff_attendence_list">Staff Attendance</option>	
                                <option value="teacher_list">Teacher List</option>			
                                <option value="group_list">Group Listings</option>
                                <option value="attendance_view">Attendance</option>
                                <option value="timetable_list">Timetable</option>
                                <option value="exam_mark_list">Exams</option>
                                <option value="marks_list">Marks</option>				
                            </select>	
                        </div>
                    </div>	
               <?php $report3 =  $this->db->get_where("saved_reports",array("report_id"=>"3"))->result_array(); ?>
                <div id="saved_item3" style="clear:both">
                <?php
				 if($short3[0]['ind_student']=="" && $short3[0]['non_teaching_list']=="" && $short3[0]['fees_listing_page']=="" && $short3[0]['holiday_list']=="" && $short3[0]['notification_list']=="" && $short3[0]['share_materials_list']=="" && $short3[0]['staff_attendence_list']==""  && $short3[0]['group_list']==""  && $short3[0]['attendance_view']=="" && $short3[0]['timetable_list']=="" && $short3[0]['exam_mark_list']=="" && $short3[0]['teacher_list']=="" && $short3[0]['marks_list']==""){
				   $add_class3 = 'inactive';
				   
				   }
				   else{
					 $add_class3 = 'inactive';
					   }
					   ?>
				<a href="javascript:void(0);"  id="link_shortcut3" class="<?php echo $add_class3; ?>">Add Shortcut</a>
			
			<?php	 foreach($report3 as $row): 
				
				?>
                <?php if($row['ind_student']=="1"){ ?>
                <?php $ind_class3 ="active"; ?>
                <?php }else{
					$ind_class3 = 'inactive';
					} ?>
                <div id="ind_student3" class="<?php echo $ind_class3; ?>">
				  <a onclick="showpopup(this);"  class="title" id="ind_student" href="javascript:void(0);">Individual Student Report</a>
         	      <a onclick="showdropdown3(this);"  class="btn" id="ind_student3" href="javascript:void(0);" >
				  <i class="entypo-pencil"></i>Change</a>
                  <a onclick="delete_reportlist3(this);"  class="btn" id="ind_student" href="javascript:void(0);">
                  <i class="entypo-trash"></i>Remove</a>
                   
                  </div>
                
                
				 <?php if($row['non_teaching_list']=="1"){ ?>
                   <?php $non_class3="active"; ?>
                <?php }else{
					$non_class3 = 'inactive';
					} 
					?>
                  <div id="non_teaching_list3" class="<?php echo $non_class3; ?>">
					<a onclick="showpopup(this);" class="title" id="non_teaching_list"  href="javascript:void(0);">Non-Teaching Staff Listing</a>
                    <a onclick="showdropdown3(this);"  class="btn" id="non_teaching_list3"   href="javascript:void(0);">
                    <i class="entypo-pencil"></i>Change</a>
                    <a onclick="delete_reportlist3(this);"  class="btn" id="non_teaching_list" href="javascript:void(0);">
                    <i class="entypo-trash"></i>Remove</a>
                     
                    </div>
                
              
				<?php if($row['fees_listing_page']=='1'){ ?>
                  <?php $fee_class3="active"; ?>
                <?php }else{
					$fee_class3 = 'inactive';
					} ?>
                <div id="fees_listing_page3" class="<?php echo $fee_class3; ?>">
				<a onclick="showpopup(this);" class="title" id="fees_listing_page" href="javascript:void(0);">Fees Listing</a>	                
                <a onclick="showdropdown3(this);"  class="btn" id="fees_listing_page3" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist3(this);"  class="btn" id="fees_listing_page" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                <?php if($row['holiday_list']=='1'){ ?>
                 <?php $holy_class3="active"; ?>
                <?php }else{
					$holy_class3 = 'inactive';
					 } ?>
                <div id="holiday_list3" class="<?php echo $holy_class3; ?>">
				<a onclick="showpopup(this);" class="title" id="holiday_list" href="javascript:void(0);">Holiday List</a>	                
                <a onclick="showdropdown3(this);"  class="btn" id="holiday_list3" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist3(this);"  class="btn" id="holiday_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
               <?php if($row['notification_list']=='1'){ ?>
               <?php $notify_class3   = "active"; }else{?>
               <?php $notify_class3   = "inactive"; ?>
               <?php } ?>
				 <div id="notification_list3" class="<?php echo $notify_class3; ?>">
				<a onclick="showpopup(this);" class="title" id="notification_list" href="javascript:void(0);">Notification List</a>	                
                <a onclick="showdropdown3(this);"  class="btn" id="notification_list3" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist3(this);"  class="btn" id="notification_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                 <?php if($row['share_materials_list']=='1'){ ?>
               <?php $share_class3   = "active"; }else{?>
               <?php $share_class3   = "inactive"; ?>
               <?php } ?>
				 <div id="share_materials_list3" class="<?php echo $share_class3; ?>">
				<a onclick="showpopup(this);"   class="title" id="share_materials_list" href="javascript:void(0);">Study Materials Uploaded</a>	                
                <a onclick="showdropdown3(this);"  class="btn" id="share_materials_list3" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist3(this);"  class="btn" id="share_materials_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                
                </div>
                
                  <?php if($row['staff_attendence_list']=='1'){ ?>
               <?php $staff_class3   = "active"; }else{?>
               <?php $staff_class3   = "inactive"; ?>
               <?php } ?>
				 <div id="staff_attendence_list3" class="<?php echo $staff_class3; ?>">
				<a onclick="showpopup(this);" class="title" id="staff_attendence_list" href="javascript:void(0);">Staff Attendance</a>                <a onclick="showdropdown3(this);"  class="btn" id="staff_attendence_list3" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist3(this);"  class="btn" id="staff_attendence_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                  
                </div>
                
                 <?php if($row['teacher_list']=='1'){ ?>
               <?php $teach_class3   = "active"; }else{?>
               <?php $teach_class3   = "inactive"; ?>
               <?php } ?>
				 <div id="teacher_list3" class="<?php echo $teach_class3; ?>">
				<a onclick="showpopup(this);" class="title" id="teacher_list" href="javascript:void(0);">Teacher List</a>                <a onclick="showdropdown3(this);" class="btn" id="teacher_list3" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist3(this);" class="btn" id="teacher_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                  
                  
                </div>
                 
                 <?php if($row['group_list']=='1'){ ?>
               <?php $group_class3   = "active"; }else{?>
               <?php $group_class3   = "inactive"; ?>
               <?php } ?>
				 <div id="group_list3" class="<?php echo $group_class3; ?>">
					<a onclick="showpopup(this);" class="title" id="group_list" href="javascript:void(0);">Group Listings</a>    	            <a onclick="showdropdown3(this);"  class="btn" id="group_list3" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist3(this);"  class="btn" id="group_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
               
                </div>
                 
                  <?php if($row['attendance_view']=='1'){ ?>
                   
               <?php $attend_class3   = "active"; }else{?>
               <?php $attend_class3   = "inactive"; ?>
               <?php } ?>
				 <div id="attendance_view3" class="<?php echo $attend_class3; ?>">
				<a onclick="showpopup(this);" class="title" id="attendance_view" href="javascript:void(0);">Attendance</a>                <a onclick="showdropdown3(this);"  class="btn" id="attendance_view3" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist3(this);"  class="btn" id="attendance_view" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>  
                <br /> 
                </div>
               
                 <?php if($row['timetable_list']=='1'){ ?>
                
               <?php $time_class3   = "active"; }else{?>
               <?php $time_class3   = "inactive"; ?>
               <?php } ?>
				 <div id="timetable_list3" class="<?php echo $time_class3; ?>">
				<a onclick="showpopup(this);"  class="title" id="timetable_list" href="javascript:void(0);">Timetable</a>           
                 <a onclick="showdropdown3(this);" id="timetable_list3" class="btn" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist3(this);"  class="btn" id="timetable_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                
                </div>
             
                 <?php if($row['exam_mark_list']=='1'){ ?>
                   
               <?php $mark_class3   = "active"; }else{?>
               <?php $mark_class3   = "inactive"; ?>
               <?php } ?>
				 <div id="exam_mark_list3" class="<?php echo $mark_class3; ?>">
				<a onclick="showpopup(this);" class="title" id="exam_mark_list" href="javascript:void(0);">Exams</a>                <a onclick="showdropdown3(this);"  class="btn" id="exam_mark_list3" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist3(this);"  class="btn" id="exam_mark_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
               
                  <?php if($row['marks_list']=='1'){ ?>
                   
               <?php $marks_class3   = "active"; }else{?>
               <?php $marks_class3   = "inactive"; ?>
               <?php } ?>
				 <div id="marks_list3" class="<?php echo $marks_class3; ?>">
				<a onclick="showpopup(this);" class="title" id="marks_list" href="javascript:void(0);">Marks</a>                <a onclick="showdropdown3(this);" class="btn" id="marks_list3" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist3(this);" class="btn" id="marks_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
				<?php endforeach; ?>
              
                
                </div>
                </div>
             
                </div>
                
                <!--  end shortcut3   -->
                </div>
                <div class="row">
                
                <!--            #shortcut 4       --->
                
                <div class="col-sm-4"  >
                 <?php //if() 
			   $short4 =	$this->db->get_where("saved_reports",array("report_id"=>"4"))->result_array();
			   
			   if($short4[0]['ind_student']=="" && $short4[0]['non_teaching_list']=="" && $short4[0]['fees_listing_page']=="" && $short4[0]['holiday_list']=="" && $short4[0]['notification_list']=="" && $short4[0]['share_materials_list']=="" && $short4[0]['staff_attendence_list']==""  && $short4[0]['group_list']==""  && $short4[0]['attendance_view']=="" && $short4[0]['timetable_list']=="" && $short4[0]['exam_mark_list']=="" && $short4[0]['teacher_list']=="" && $short4[0]['marks_list']==""){
				   $short4_class = 'active';
				   $main4_class = 'active';
				   }
				   else{
					  $short4_class = 'inactive'; 
					  $main4_class = 'inactive';
					   }
			   ?>
                <div class="box-content dashboard-box">
               
                    <h4 id="shortcut4" class="<?php echo $short4_class; ?>">Shortcut 4</h4>
                    <div class="form-group <?php echo $main4_class; ?>" id="report_maindiv4">
                        <label class="col-sm-6 control-label"></label>
                        <div class="">
                         <select name="report_list4" style="width:100%;" class="form-control" data-validate="required" id="report_list4" data-message-required="<?php echo get_phrase('value_required');?>"  >
                                <option value="">Select Report</option>
                                <option value="ind_student">Individual Student Report</option>
                                <option value="non_teaching_list">Non-Teaching Staff Listing</option>
                                <option value="fees_listing_page">Fees Listing</option>
                                <option value="holiday_list">Holiday List</option>
                                <option value="notification_list">Notification List</option>				
                                <option value="share_materials_list">Study Materials Uploaded</option>				
                                <option value="staff_attendence_list">Staff Attendance</option>	
                                <option value="teacher_list">Teacher List</option>			
                                <option value="group_list">Group Listings</option>
                                <option value="attendance_view">Attendance</option>
                                <option value="timetable_list">Timetable</option>
                                <option value="exam_mark_list">Exams</option>	
                                  <option value="marks_list">Marks</option>							
                            </select>	
                        </div>
                    </div>	
               <?php $report4 =  $this->db->get_where("saved_reports",array("report_id"=>"4"))->result_array(); ?>
                <div id="saved_item4" style="clear:both">
                <?php
				 if($short4[0]['ind_student']=="" && $short4[0]['non_teaching_list']=="" && $short4[0]['fees_listing_page']=="" && $short4[0]['holiday_list']=="" && $short4[0]['notification_list']=="" && $short4[0]['share_materials_list']=="" && $short4[0]['staff_attendence_list']==""  && $short4[0]['group_list']==""  && $short4[0]['attendance_view']=="" && $short4[0]['timetable_list']=="" && $short4[0]['exam_mark_list']=="" && $short4[0]['teacher_list']=="" && $short4[0]['marks_list']){
				   $add_class4 = 'inactive';
				   
				   }
				   else{
					 $add_class4 = 'inactive';
					   }
					   ?>
				<a href="javascript:void(0);" id="link_shortcut4" class="<?php echo $add_class4; ?>">Add Shortcut</a>
			
			<?php	 foreach($report4 as $row): 
				
				?>
                <?php if($row['ind_student']=="1"){ ?>
                <?php $ind_class4 ="active"; ?>
                <?php }else{
					$ind_class4 = 'inactive';
					} ?>
                <div id="ind_student4" class="<?php echo $ind_class4; ?>">
				  <a onclick="showpopup(this);" class="title" id="ind_student" href="javascript:void(0);">Individual Student Report</a>
         	      <a onclick="showdropdown4(this);"  class="btn" id="ind_student4" >
				  <i class="entypo-pencil"></i>Change</a>
                  <a onclick="delete_reportlist4(this);"  class="btn" id="ind_student" href="javascript:void(0);">
                  <i class="entypo-trash"></i>Remove</a>
                   
                  </div>
                
                
				 <?php if($row['non_teaching_list']=="1"){ ?>
                   <?php $non_class4="active"; ?>
                <?php }else{
					$non_class4 = 'inactive';
					} 
					?>
                  <div id="non_teaching_list4" class="<?php echo $non_class4; ?>">
					<a onclick="showpopup(this);" class="title" id="non_teaching_list"  href="javascript:void(0);">Non-Teaching Staff Listing</a>
                    <a onclick="showdropdown4(this);"  class="btn" id="non_teaching_list4"   href="javascript:void(0);">
                    <i class="entypo-pencil"></i>Change</a>
                    <a onclick="delete_reportlist4(this);"  class="btn" id="non_teaching_list" href="javascript:void(0);">
                    <i class="entypo-trash"></i>Remove</a>
                     
                    </div>
                
              
				<?php if($row['fees_listing_page']=='1'){ ?>
                  <?php $fee_class4="active"; ?>
                <?php }else{
					$fee_class4 = 'inactive';
					} ?>
                <div id="fees_listing_page4" class="<?php echo $fee_class4; ?>">
				<a onclick="showpopup(this);" class="title" id="fees_listing_page" href="javascript:void(0);">Fees Listing</a>	                
                <a onclick="showdropdown4(this);"  class="btn" id="fees_listing_page4" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist4(this);"  class="btn" id="fees_listing_page" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                <?php if($row['holiday_list']=='1'){ ?>
                 <?php $holy_class4="active"; ?>
                <?php }else{
					$holy_class4 = 'inactive';
					 } ?>
                <div id="holiday_list4" class="<?php echo $holy_class4; ?>">
				<a onclick="showpopup(this);" class="title" id="holiday_list" href="javascript:void(0);">Holiday List</a>	                
                <a onclick="showdropdown4(this);"  class="btn" id="holiday_list4" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist4(this);"  class="btn" id="holiday_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
               <?php if($row['notification_list']=='1'){ ?>
               <?php $notify_class4   = "active"; }else{?>
               <?php $notify_class4   = "inactive"; ?>
               <?php } ?>
				 <div id="notification_list4" class="<?php echo $notify_class4; ?>">
				<a onclick="showpopup(this);" class="title" id="notification_list" href="javascript:void(0);">Notification List</a>	                
                <a onclick="showdropdown4(this);"  class="btn" id="notification_list4" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist4(this);"  class="btn" id="notification_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                 <?php if($row['share_materials_list']=='1'){ ?>
               <?php $share_class4   = "active"; }else{?>
               <?php $share_class4   = "inactive"; ?>
               <?php } ?>
				 <div id="share_materials_list4" class="<?php echo $share_class4; ?>">
				<a onclick="showpopup(this);" class="title" id="share_materials_list" href="javascript:void(0);">Study Materials Uploaded</a>	                
                <a onclick="showdropdown4(this);"  class="btn" id="share_materials_list4" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist4(this);"  class="btn" id="share_materials_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                
                </div>
                
                  <?php if($row['staff_attendence_list']=='1'){ ?>
               <?php $staff_class4   = "active"; }else{?>
               <?php $staff_class4   = "inactive"; ?>
               <?php } ?>
				 <div id="staff_attendence_list4" class="<?php echo $staff_class4; ?>">
				<a onclick="showpopup(this);" class="title" id="staff_attendence_list" href="javascript:void(0);">Staff Attendance</a>                <a onclick="showdropdown4(this);"  class="btn" id="staff_attendence_list4" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist4(this);"  class="btn" id="staff_attendence_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>                  
                </div>
                 
                  <?php if($row['teacher_list']=='1'){ ?>
               <?php $teach_class4   = "active"; }else{?>
               <?php $teach_class4   = "inactive"; ?>
               <?php } ?>
				 <div id="teacher_list4" class="<?php echo $teach_class4; ?>">
				<a onclick="showpopup(this);" class="title" id="teacher_list" href="javascript:void(0);">Teacher List</a>                <a onclick="showdropdown4(this);" class="btn" id="teacher_list4" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist4(this);" class="btn" id="teacher_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                  
                  
                </div>
                 
                 <?php if($row['group_list']=='1'){ ?>
               <?php $group_class4   = "active"; }else{?>
               <?php $group_class4   = "inactive"; ?>
               <?php } ?>
				 <div id="group_list4" class="<?php echo $group_class4; ?>">
					<a onclick="showpopup(this);" class="title" id="group_list" href="javascript:void(0);">Group Listings</a>    	            <a onclick="showdropdown4(this);"  class="btn" id="group_list4" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist4(this);"  class="btn"  id="group_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>               
                </div>
                 
                  <?php if($row['attendance_view']=='1'){ ?>
                   
               <?php $attend_class4   = "active"; }else{?>
               <?php $attend_class4   = "inactive"; ?>
               <?php } ?>
				 <div id="attendance_view4" class="<?php echo $attend_class4; ?>">
				<a onclick="showpopup(this);" class="title" id="attendance_view" href="javascript:void(0);">Attendance</a>                <a onclick="showdropdown4(this);"  class="btn" id="attendance_view4" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist4(this);"  class="btn" id="attendance_view" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>  
                <br /> 
                </div>
               
                 <?php if($row['timetable_list']=='1'){ ?>
                
               <?php $time_class4   = "active"; }else{?>
               <?php $time_class4   = "inactive"; ?>
               <?php } ?>
				 <div id="timetable_list4" class="<?php echo $time_class4; ?>">
				<a onclick="showpopup(this);" class="title" id="timetable_list" href="javascript:void(0);">Timetable</a>                	<a onclick="showdropdown4(this);"  class="btn"  id="timetable_list4" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist4(this);"  class="btn" id="timetable_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>                
                </div>
             
                 <?php if($row['exam_mark_list']=='1'){ ?>
                   
               <?php $mark_class4   = "active"; }else{?>
               <?php $mark_class4   = "inactive"; ?>
               <?php } ?>
				 <div id="exam_mark_list4" class="<?php echo $mark_class4; ?>">
				<a onclick="showpopup(this);" class="title" id="exam_mark_list" href="javascript:void(0);">Exams</a>                <a onclick="showdropdown4(this);"  class="btn" id="exam_mark_list4" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist4(this);"  class="btn" id="exam_mark_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                 <?php if($row['marks_list']=='1'){ ?>
                   
               <?php $marks_class4   = "active"; }else{?>
               <?php $marks_class4   = "inactive"; ?>
               <?php } ?>
				 <div id="marks_list4" class="<?php echo $marks_class4; ?>">
				<a onclick="showpopup(this);" class="title" id="marks_list" href="javascript:void(0);">Marks</a>                <a onclick="showdropdown4(this);" class="btn" id="marks_list4" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist4(this);" class="btn" id="marks_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
               	<?php endforeach; ?>
              
                
                </div>
                </div>
             
                </div>
                
                
                <!--   end shortcut 4    -->
                
                <!--   Start Shortcut 5   -->
                <div class="col-sm-4"  >
                 <?php //if() 
			   $short5 =	$this->db->get_where("saved_reports",array("report_id"=>"5"))->result_array();
			   
			   if($short5[0]['ind_student']=="" && $short5[0]['non_teaching_list']=="" && $short5[0]['fees_listing_page']=="" && $short5[0]['holiday_list']=="" && $short5[0]['notification_list']=="" && $short5[0]['share_materials_list']=="" && $short5[0]['staff_attendence_list']==""  && $short5[0]['group_list']==""  && $short5[0]['attendance_view']=="" && $short5[0]['timetable_list']=="" && $short5[0]['exam_mark_list']=="" && $short5[0]['teacher_list']=="" && $short5[0]['marks_list']==""){
				   $short5_class = 'active';
				   $main5_class = 'active';
				   }
				   else{
					  $short5_class = 'inactive'; 
					  $main5_class = 'inactive';
					   }
			   ?>
                <div class="box-content dashboard-box">
               
                    <h4 id="shortcut5" class="<?php echo $short5_class; ?>">Shortcut 5</h4>
                    <div class="form-group <?php echo $main5_class; ?>" id="report_maindiv5">
                        <label class="col-sm-6 control-label"></label>
                        <div class="">
                         <select name="report_list5" style="width:100%;" class="form-control" data-validate="required" id="report_list5" data-message-required="<?php echo get_phrase('value_required');?>"  >
                                <option value="">Select Report</option>
                                <option value="ind_student">Individual Student Report</option>
                                <option value="non_teaching_list">Non-Teaching Staff Listing</option>
                                <option value="fees_listing_page">Fees Listing</option>
                                <option value="holiday_list">Holiday List</option>
                                <option value="notification_list">Notification List</option>				
                                <option value="share_materials_list">Study Materials Uploaded</option>				
                                <option value="staff_attendence_list">Staff Attendance</option>
                                <option value="teacher_list">Teacher List</option>				
                                <option value="group_list">Group Listings</option>
                                <option value="attendance_view">Attendance</option>
                                <option value="timetable_list">Timetable</option>
                                <option value="exam_mark_list">Exams</option>	
                                  <option value="marks_list">Marks</option>							
                            </select>	
                        </div>
                    </div>	
               <?php $report5 =  $this->db->get_where("saved_reports",array("report_id"=>"5"))->result_array(); ?>
                <div id="saved_item5" style="clear:both">
                <?php
				 if($short5[0]['ind_student']=="" && $short5[0]['non_teaching_list']=="" && $short5[0]['fees_listing_page']=="" && $short5[0]['holiday_list']=="" && $short5[0]['notification_list']=="" && $short5[0]['share_materials_list']=="" && $short5[0]['staff_attendence_list']==""  && $short5[0]['group_list']==""  && $short5[0]['attendance_view']=="" && $short5[0]['timetable_list']=="" && $short5[0]['exam_mark_list']==""  && $short5[0]['teacher_list']=="" && $short5[0]['marks_list']==""){
				   $add_class5 = 'inactive';
				   
				   }
				   else{
					 $add_class5 = 'inactive';
					   }
					   ?>
				<a href="javascript:void(0);" id="link_shortcut5" class="<?php echo $add_class5; ?>">Add Shortcut</a>
			
			<?php	 foreach($report5 as $row): 
				
				?>
                <?php if($row['ind_student']=="1"){ ?>
                <?php $ind_class5 ="active"; ?>
                <?php }else{
					$ind_class5 = 'inactive';
					} ?>
                <div id="ind_student5" class="<?php echo $ind_class5; ?>">
				  <a onclick="showpopup(this);" class="title" id="ind_student" href="javascript:void(0);">Individual Student Report</a>
         	      <a onclick="showdropdown5(this);"  class="btn" id="ind_student5" >
				  <i class="entypo-pencil"></i>Change</a>
                  <a onclick="delete_reportlist5(this);"  class="btn" id="ind_student" href="javascript:void(0);">
                  <i class="entypo-trash"></i>Remove</a>                   
                  </div>
                
                
				 <?php if($row['non_teaching_list']=="1"){ ?>
                   <?php $non_class5="active"; ?>
                <?php }else{
					$non_class5 = 'inactive';
					} 
					?>
                  <div id="non_teaching_list5" class="<?php echo $non_class5; ?>">
					<a onclick="showpopup(this);" class="title" id="non_teaching_list"  href="javascript:void(0);">Non-Teaching Staff Listing</a>
                    <a onclick="showdropdown5(this);"  class="btn" id="non_teaching_list5"   href="javascript:void(0);">
                    <i class="entypo-pencil"></i>Change</a>
                    <a onclick="delete_reportlist5(this);"  class="btn" id="non_teaching_list" href="javascript:void(0);">
                    <i class="entypo-trash"></i>Remove</a>
                     
                    </div>
                
              
				<?php if($row['fees_listing_page']=='1'){ ?>
                  <?php $fee_class5="active"; ?>
                <?php }else{
					$fee_class5 = 'inactive';
					} ?>
                <div id="fees_listing_page5" class="<?php echo $fee_class5; ?>">
				<a onclick="showpopup(this);" class="title" id="fees_listing_page" href="javascript:void(0);">Fees Listing</a>	                
                <a onclick="showdropdown5(this);"  class="btn" id="fees_listing_page5" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist5(this);"  class="btn" id="fees_listing_page" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                <?php if($row['holiday_list']=='1'){ ?>
                 <?php $holy_class5="active"; ?>
                <?php }else{
					$holy_class5 = 'inactive';
					 } ?>
                <div id="holiday_list5" class="<?php echo $holy_class5; ?>">
				<a onclick="showpopup(this);" class="title" id="holiday_list" href="javascript:void(0);">Holiday List</a>	                
                <a onclick="showdropdown5(this);"  class="btn" id="holiday_list5" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist5(this);"  class="btn" id="holiday_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
               <?php if($row['notification_list']=='1'){ ?>
               <?php $notify_class5   = "active"; }else{?>
               <?php $notify_class5   = "inactive"; ?>
               <?php } ?>
				 <div id="notification_list5" class="<?php echo $notify_class5; ?>">
				<a onclick="showpopup(this);" class="title" id="notification_list" href="javascript:void(0);">Notification List</a>	                
                <a onclick="showdropdown5(this);"  class="btn" id="notification_list5" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist5(this);"  class="btn" id="notification_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                 <?php if($row['share_materials_list']=='1'){ ?>
               <?php $share_class5   = "active"; }else{?>
               <?php $share_class5   = "inactive"; ?>
               <?php } ?>
				 <div id="share_materials_list5" class="<?php echo $share_class5; ?>">
				<a onclick="showpopup(this);"  class="title" id="share_materials_list" href="javascript:void(0);">Study Materials Uploaded</a>	                
                <a onclick="showdropdown5(this);"  class="btn" id="share_materials_list5" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist5(this);"  class="btn" id="share_materials_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                
                </div>
                
                  <?php if($row['staff_attendence_list']=='1'){ ?>
               <?php $staff_class5   = "active"; }else{?>
               <?php $staff_class5   = "inactive"; ?>
               <?php } ?>
				 <div id="staff_attendence_list5" class="<?php echo $staff_class5; ?>">
				<a onclick="showpopup(this);" class="title" id="staff_attendence_list" href="javascript:void(0);">Staff Attendance</a>                <a onclick="showdropdown5(this);"  class="btn" id="staff_attendence_list5" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist5(this);"  class="btn" id="staff_attendence_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>                  
                </div>
                
                 <?php if($row['teacher_list']=='1'){ ?>
               <?php $teach_class5   = "active"; }else{?>
               <?php $teach_class5   = "inactive"; ?>
               <?php } ?>
				 <div id="teacher_list5" class="<?php echo $teach_class5; ?>">
				<a onclick="showpopup(this);" class="title" id="teacher_list" href="javascript:void(0);">Teacher List</a>                <a onclick="showdropdown5(this);" class="btn" id="teacher_list5" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist5(this);" class="btn" id="teacher_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                  
                  
                </div>
                 
                 <?php if($row['group_list']=='1'){ ?>
               <?php $group_class5   = "active"; }else{?>
               <?php $group_class5   = "inactive"; ?>
               <?php } ?>
				 <div id="group_list5" class="<?php echo $group_class5; ?>">
					<a onclick="showpopup(this);" class="title" id="group_list" href="javascript:void(0);">Group Listings</a>    	            <a onclick="showdropdown5(this);"  class="btn" id="group_list5" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist5(this);"  class="btn" id="group_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>               
                </div>
                 
                  <?php if($row['attendance_view']=='1'){ ?>
                   
               <?php $attend_class5   = "active"; }else{?>
               <?php $attend_class5   = "inactive"; ?>
               <?php } ?>
				 <div id="attendance_view5" class="<?php echo $attend_class5; ?>">
				<a onclick="showpopup(this);" class="title" id="attendance_view" href="javascript:void(0);">Attendance</a>                <a onclick="showdropdown5(this);"  class="btn" id="attendance_view5" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist5(this);"  class="btn" id="attendance_view" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>  
                <br /> 
                </div>
               
                 <?php if($row['timetable_list']=='1'){ ?>
                
               <?php $time_class5   = "active"; }else{?>
               <?php $time_class5   = "inactive"; ?>
               <?php } ?>
				 <div id="timetable_list5" class="<?php echo $time_class5; ?>">
				<a onclick="showpopup(this);" class="title" id="timetable_list" href="javascript:void(0);">Timetable</a>                	<a onclick="showdropdown5(this);"  class="btn" id="timetable_list5" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist5(this);"  class="btn" id="timetable_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>                
                </div>
             
                 <?php if($row['exam_mark_list']=='1'){ ?>
                   
               <?php $mark_class5   = "active"; }else{?>
               <?php $mark_class5   = "inactive"; ?>
               <?php } ?>
				 <div id="exam_mark_list5" class="<?php echo $mark_class5; ?>">
				<a onclick="showpopup(this);" class="title" id="exam_mark_list" href="javascript:void(0);">Exams</a>                <a onclick="showdropdown5(this);"  class="btn" id="exam_mark_list5" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist5(this);"  class="btn" id="exam_mark_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                  <?php if($row['marks_list']=='1'){ ?>
                   
               <?php $marks_class5   = "active"; }else{?>
               <?php $marks_class5   = "inactive"; ?>
               <?php } ?>
				 <div id="marks_list5" class="<?php echo $marks_class5; ?>">
				<a onclick="showpopup(this);" class="title" id="marks_list" href="javascript:void(0);">Marks</a>                <a onclick="showdropdown5(this);" class="btn" id="marks_list5" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist5(this);" class="btn" id="marks_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
               	<?php endforeach; ?>
              
                
                </div>
                </div>
             
                </div>
                <!--     Endshortcut5    -->
                
               <!--   Start Shortcut 6   -->
               <div class="col-sm-4"  >
                 <?php //if() 
			   $short6 =	$this->db->get_where("saved_reports",array("report_id"=>"6"))->result_array();
			   
			   if($short6[0]['ind_student']=="" && $short6[0]['non_teaching_list']=="" && $short6[0]['fees_listing_page']=="" && $short6[0]['holiday_list']=="" && $short6[0]['notification_list']=="" && $short6[0]['share_materials_list']=="" && $short6[0]['staff_attendence_list']==""  && $short6[0]['group_list']==""  && $short6[0]['attendance_view']=="" && $short6[0]['timetable_list']=="" && $short6[0]['exam_mark_list']==""  && $short6[0]['teacher_list']=="" && $short6[0]['marks_list']==""){
				   $short6_class = 'active';
				   $main6_class = 'active';
				   }
				   else{
					  $short6_class = 'inactive'; 
					  $main6_class = 'inactive';
					   }
			   ?>
                <div class="box-content dashboard-box">
               
                    <h4 id="shortcut6" class="<?php echo $short6_class; ?>">Shortcut 6</h4>
                    <div class="form-group <?php echo $main6_class; ?>" id="report_maindiv6">
                        <label class="col-sm-6 control-label"></label>
                        <div class="">
                         <select name="report_list6" style="width:100%;" class="form-control" data-validate="required" id="report_list6" data-message-required="<?php echo get_phrase('value_required');?>"  >
                                <option value="">Select Report</option>
                                <option value="ind_student">Individual Student Report</option>
                                <option value="non_teaching_list">Non-Teaching Staff Listing</option>
                                <option value="fees_listing_page">Fees Listing</option>
                                <option value="holiday_list">Holiday List</option>
                                <option value="notification_list">Notification List</option>				
                                <option value="share_materials_list">Study Materials Uploaded</option>				
                                <option value="staff_attendence_list">Staff Attendance</option>	
                                <option value="teacher_list">Teacher List</option>			
                                <option value="group_list">Group Listings</option>
                                <option value="attendance_view">Attendance</option>
                                <option value="timetable_list">Timetable</option>
                                <option value="exam_mark_list">Exams</option>
                                 <option value="marks_list">Marks</option>				
                            </select>	
                        </div>
                    </div>	
               <?php $report6 =  $this->db->get_where("saved_reports",array("report_id"=>"6"))->result_array(); ?>
                <div id="saved_item6" style="clear:both">
                <?php
				 if($short6[0]['ind_student']=="" && $short6[0]['non_teaching_list']=="" && $short6[0]['fees_listing_page']=="" && $short6[0]['holiday_list']=="" && $short6[0]['notification_list']=="" && $short6[0]['share_materials_list']=="" && $short6[0]['staff_attendence_list']==""  && $short6[0]['group_list']==""  && $short6[0]['attendance_view']=="" && $short6[0]['timetable_list']=="" && $short6[0]['exam_mark_list']==""  && $short6[0]['teacher_list']=="" && $short6[0]['marks_list']==""){
				   $add_class6 = 'inactive';
				   
				   }
				   else{
					 $add_class6 = 'inactive';
					   }
					   ?>
				<a href="javascript:void(0);" id="link_shortcut6" class="<?php echo $add_class6; ?>">Add Shortcut</a>
			
			<?php	 foreach($report6 as $row): 
				
				?>
                <?php if($row['ind_student']=="1"){ ?>
                <?php $ind_class6 ="active"; ?>
                <?php }else{
					$ind_class6 = 'inactive';
					} ?>
                <div id="ind_student6" class="<?php echo $ind_class6; ?>">
				  <a onclick="showpopup(this);" class="title" id="ind_student" href="javascript:void(0);">Individual Student Report</a>
         	      <a onclick="showdropdown6(this);"  class="btn" id="ind_student6" >
				  <i class="entypo-pencil"></i>Change</a>
                  <a onclick="delete_reportlist6(this);"  class="btn" id="ind_student" href="javascript:void(0);">
                  <i class="entypo-trash"></i>Remove</a>                   
                  </div>
                
                
				 <?php if($row['non_teaching_list']=="1"){ ?>
                   <?php $non_class6="active"; ?>
                <?php }else{
					$non_class6 = 'inactive';
					} 
					?>
                  <div id="non_teaching_list6" class="<?php echo $non_class6; ?>">
					<a onclick="showpopup(this);" class="title" id="non_teaching_list"  href="javascript:void(0);">Non-Teaching Staff Listing</a>
                    <a onclick="showdropdown6(this);"  class="btn" id="non_teaching_list6"   href="javascript:void(0);">
                    <i class="entypo-pencil"></i>Change</a>
                    <a onclick="delete_reportlist6(this);"  class="btn" id="non_teaching_list" href="javascript:void(0);">
                    <i class="entypo-trash"></i>Remove</a>
                     
                    </div>
                
              
				<?php if($row['fees_listing_page']=='1'){ ?>
                  <?php $fee_class6="active"; ?>
                <?php }else{
					$fee_class6 = 'inactive';
					} ?>
                <div id="fees_listing_page6" class="<?php echo $fee_class6; ?>">
				<a onclick="showpopup(this);"  class="title" id="fees_listing_page" href="javascript:void(0);">Fees Listing</a>	                
                <a onclick="showdropdown6(this);"  class="btn" id="fees_listing_page6" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist6(this);"  class="btn" id="fees_listing_page" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                <?php if($row['holiday_list']=='1'){ ?>
                 <?php $holy_class6="active"; ?>
                <?php }else{
					$holy_class6 = 'inactive';
					 } ?>
                <div id="holiday_list6" class="<?php echo $holy_class6; ?>">
				<a onclick="showpopup(this);" class="title" id="holiday_list" href="javascript:void(0);">Holiday List</a>	                
                <a onclick="showdropdown6(this);"  class="btn" id="holiday_list6" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist6(this);"  class="btn" id="holiday_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
               <?php if($row['notification_list']=='1'){ ?>
               <?php $notify_class6   = "active"; }else{?>
               <?php $notify_class6   = "inactive"; ?>
               <?php } ?>
				 <div id="notification_list6" class="<?php echo $notify_class6; ?>">
				<a onclick="showpopup(this);" class="title" id="notification_list" href="javascript:void(0);">Notification List</a>	                
                <a onclick="showdropdown6(this);"  class="btn" id="notification_list6" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist6(this);"  class="btn" id="notification_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                 <?php if($row['share_materials_list']=='1'){ ?>
               <?php $share_class6   = "active"; }else{?>
               <?php $share_class6   = "inactive"; ?>
               <?php } ?>
				 <div id="share_materials_list6" class="<?php echo $share_class6; ?>">
				<a onclick="showpopup(this);" class="title" id="share_materials_list" href="javascript:void(0);">Study Materials Uploaded</a>	                
                <a onclick="showdropdown6(this);"  class="btn" id="share_materials_list6" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist6(this);"  class="btn" id="share_materials_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                
                </div>
                
                  <?php if($row['staff_attendence_list']=='1'){ ?>
               <?php $staff_class6   = "active"; }else{?>
               <?php $staff_class6   = "inactive"; ?>
               <?php } ?>
				 <div id="staff_attendence_list6" class="<?php echo $staff_class6; ?>">
				<a onclick="showpopup(this);" class="title" id="staff_attendence_list" href="javascript:void(0);">Staff Attendance</a>                <a onclick="showdropdown6(this);"  class="btn" id="staff_attendence_list6" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist6(this);"  class="btn" id="staff_attendence_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>                  
                </div>
                   <?php if($row['teacher_list']=='1'){ ?>
               <?php $teach_class6   = "active"; }else{?>
               <?php $teach_class6   = "inactive"; ?>
               <?php } ?>
				 <div id="teacher_list6" class="<?php echo $teach_class6; ?>">
				<a onclick="showpopup(this);" class="title" id="teacher_list" href="javascript:void(0);">Teacher List</a>                <a onclick="showdropdown6(this);" class="btn" id="teacher_list6" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist6(this);" class="btn" id="teacher_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                  
                  
                </div>
                 
                 <?php if($row['group_list']=='1'){ ?>
               <?php $group_class6   = "active"; }else{?>
               <?php $group_class6   = "inactive"; ?>
               <?php } ?>
				 <div id="group_list6" class="<?php echo $group_class6; ?>">
					<a onclick="showpopup(this);" class="title" id="group_list" href="javascript:void(0);">Group Listings</a>    	            <a onclick="showdropdown6(this);"  class="btn" id="group_list6" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist6(this);"  class="btn" id="group_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>               
                </div>
                 
                  <?php if($row['attendance_view']=='1'){ ?>
                   
               <?php $attend_class6   = "active"; }else{?>
               <?php $attend_class6   = "inactive"; ?>
               <?php } ?>
				 <div id="attendance_view6" class="<?php echo $attend_class6; ?>">
				<a onclick="showpopup(this);" class="title" id="attendance_view" href="javascript:void(0);">Attendance</a>                <a onclick="showdropdown6(this);"  class="btn" id="attendance_view6" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist6(this);"  class="btn" id="attendance_view" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>  
                <br /> 
                </div>
               
                 <?php if($row['timetable_list']=='1'){ ?>
                
               <?php $time_class6   = "active"; }else{?>
               <?php $time_class6   = "inactive"; ?>
               <?php } ?>
				 <div id="timetable_list6" class="<?php echo $time_class6; ?>">
				<a onclick="showpopup(this);" class="title" id="timetable_list" href="javascript:void(0);">Timetable</a>                <a onclick="showdropdown6(this);"  class="btn" id="timetable_list6" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist6(this);"  class="btn" id="timetable_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>                
                </div>
             
                 <?php if($row['exam_mark_list']=='1'){ ?>
                   
               <?php $mark_class6   = "active"; }else{?>
               <?php $mark_class6   = "inactive"; ?>
               <?php } ?>
				 <div id="exam_mark_list6" class="<?php echo $mark_class6; ?>">
				<a onclick="showpopup(this);" class="title" id="exam_mark_list" href="javascript:void(0);">Exams</a>                <a onclick="showdropdown6(this);"  class="btn" id="exam_mark_list6" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist6(this);" class="btn" id="exam_mark_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
                
                  <?php if($row['marks_list']=='1'){ ?>
                   
               <?php $marks_class6   = "active"; }else{?>
               <?php $marks_class6   = "inactive"; ?>
               <?php } ?>
				 <div id="marks_list6" class="<?php echo $marks_class6; ?>">
				<a onclick="showpopup(this);" class="title" id="marks_list" href="javascript:void(0);">Marks</a>                <a onclick="showdropdown6(this);" class="btn" id="marks_list6" href="javascript:void(0);" >
				<i class="entypo-pencil"></i>Change</a>
				<a onclick="delete_reportlist6(this);" class="btn" id="marks_list" href="javascript:void(0);">				
				<i class="entypo-trash"></i>Remove</a>
                 
                </div>
               	<?php endforeach; ?>
              
                
                </div>
                </div>
             
                </div>
                <!--     Endshortcut6    -->
                  <div id="get_data_table"></div>

                 </div> 
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
			
			
          
          
            
 
<script type="text/javascript">
	
	function showdropdown4(elem)
	{
		 var id = $(elem).attr("id");
		 //alert(id);
		 $("#report_list4").val("");	
		 $("#report_list4").removeClass("inactive");
		 $("#report_maindiv4").removeClass("inactive");
		 $("#report_list4").addClass("active");
		 $("#report_maindiv4").addClass("active");
			  
	}
	
	function showdropdown6(elem)
	{
		 var id = $(elem).attr("id");
		 //alert(id);
		 $("#report_list6").val("");	
		 $("#report_list6").removeClass("inactive");
		 $("#report_maindiv6").removeClass("inactive");
		 $("#report_list6").addClass("active");
		 $("#report_maindiv6").addClass("active");
			  
	}
	
	function showdropdown5(elem)
	{
		 var id = $(elem).attr("id");
		 //alert(id);
		  $("#report_list5").val("");	
		 $("#report_list5").removeClass("inactive");
		 $("#report_maindiv5").removeClass("inactive");
		 $("#report_list5").addClass("active");
		 $("#report_maindiv5").addClass("active");
			  
	}
	
	
	
	function showdropdown2(elem)
	{
		 var id = $(elem).attr("id");
		 //alert(id);
		 $("#report_list2").val("");
		 $("#report_list2").removeClass("inactive");
		 $("#report_maindiv2").removeClass("inactive");
		 $("#report_list2").addClass("active");
		 $("#report_maindiv2").addClass("active");
			  
	}

	function showdropdown3(elem)
	{
		 var id = $(elem).attr("id");
		 //alert(id);
		 $("#report_list3").val("");
		 $("#report_list3").removeClass("inactive");
		 $("#report_maindiv3").removeClass("inactive");
		 $("#report_list3").addClass("active");
		 $("#report_maindiv3").addClass("active");
			  
	}
		
	function showdropdown(elem)
	{
		 var id = $(elem).attr("id");
		  $("#report_list1").val("");
		 $("#report_list1").removeClass("inactive");
		 $("#report_maindiv1").removeClass("inactive");
		 $("#report_list1").addClass("active");
		 $("#report_maindiv1").addClass("active");
			  
	}
	function showpopup(elem)
	{ 
		var id = $(elem).attr("id");
		showAjaxModal('<?php echo base_url();?>index.php?modal/popup/'+id);	
	}
		
		/*  Delete report  delete_reportlist2*/
		function  delete_reportlist6(elem)
		{
		 var id = $(elem).attr("id");
		
		 $.ajax({
					type:"POST",
					url:"<?php echo base_url();?>index.php?admin/delete_data/"+id+"/6",
					success:function(data)
					{
						//$("#"+id+'3').hide();
						$("#"+id+'6').removeClass("active");
						$("#"+id+'6').addClass("inactive");	
						
						
					}
						
						
				});
				$("#report_list6").val("");
		$("#shortcut6").addClass("active");	
		$("#report_list6").addClass("active");
		 $("#report_maindiv6").addClass("active");
		 $("#link_shortcut6").addClass("active");	
		$("#shortcut6").removeClass("inactive");
		 $("#report_maindiv6").removeClass("inactive");	
		$("#report_list6").removeClass("inactive");
			
		 
		}			
		function  delete_reportlist5(elem)
		{
		 var id = $(elem).attr("id");
		
		 $.ajax({
					type:"POST",
					url:"<?php echo base_url();?>index.php?admin/delete_data/"+id+"/5",
					success:function(data)
					{
						//$("#"+id+'3').hide();
						$("#"+id+'5').removeClass("active");
						$("#"+id+'5').addClass("inactive");	
						
						
					}
						
						
				});
				$("#report_list5").val("");
		$("#shortcut5").addClass("active");	
		$("#report_list5").addClass("active");
		 $("#report_maindiv5").addClass("active");
		 $("#link_shortcut5").addClass("active");	
		$("#shortcut5").removeClass("inactive");
		 $("#report_maindiv5").removeClass("inactive");	
		$("#report_list5").removeClass("inactive");
			
		 
		}			
		
	function  delete_reportlist4(elem)
	{
		 var id = $(elem).attr("id");
		
		 $.ajax({
					type:"POST",
					url:"<?php echo base_url();?>index.php?admin/delete_data/"+id+"/4",
					success:function(data)
					{
						//$("#"+id+'3').hide();
						$("#"+id+'4').removeClass("active");
						$("#"+id+'4').addClass("inactive");	
						
						
					}
						
						
				});
				$("#report_list4").val("");
		$("#shortcut4").addClass("active");	
		$("#report_list4").addClass("active");
		 $("#report_maindiv4").addClass("active");
		 $("#link_shortcut4").addClass("active");	
		$("#shortcut4").removeClass("inactive");
		 $("#report_maindiv4").removeClass("inactive");	
		$("#report_list4").removeClass("inactive");
			
		 
	}			
	function  delete_reportlist3(elem)
	{
		 var id = $(elem).attr("id");
		
		 $.ajax({
					type:"POST",
					url:"<?php echo base_url();?>index.php?admin/delete_data/"+id+"/3",
					success:function(data)
					{
						//$("#"+id+'3').hide();
						$("#"+id+'3').removeClass("active");
						$("#"+id+'3').addClass("inactive");	
						
						
					}
						
						
				});
				$("#report_list3").val("");
		$("#shortcut3").addClass("active");	
		$("#report_list3").addClass("active");
		 $("#report_maindiv3").addClass("active");
		 $("#link_shortcut3").addClass("active");	
		$("#shortcut3").removeClass("inactive");
		 $("#report_maindiv3").removeClass("inactive");	
		$("#report_list3").removeClass("inactive");
			
		 
	}		
	function  delete_reportlist2(elem)
	{
		 var id = $(elem).attr("id");
		
		 $.ajax({
					type:"POST",
					url:"<?php echo base_url();?>index.php?admin/delete_data/"+id+"/2",
					success:function(data)
					{
						//$("#"+id+'2').hide();
						$("#"+id+'2').addClass("inactive");	
						$("#"+id+'2').removeClass("active");
						
					}
						
						
				});
				$("#report_list2").val("");
		$("#shortcut2").removeClass("inactive");
		$("#shortcut2").addClass("active");
		$("#report_list2").removeClass("inactive");
		 $("#report_maindiv2").removeClass("inactive");		
		 $("#report_list2").addClass("active");
		 $("#report_maindiv2").addClass("active");
		 $("#link_shortcut2").addClass("active");
	}		
			
		
	function  delete_reportlist(elem)
	{
		 var id = $(elem).attr("id");
		
		 $.ajax({
					type:"POST",
					url:"<?php echo base_url();?>index.php?admin/delete_data/"+id+"/1",
					success:function(data)
					{
						//$("#"+id+'1').hide();
						$("#"+id+'1').addClass("inactive");	
						$("#"+id+'1').removeClass("active");
						
					}
						
						
				});
				$("#report_list1").val("");
		$("#shortcut1").removeClass("inactive");
		$("#shortcut1").addClass("active");
		$("#report_list1").removeClass("inactive");
		 $("#report_maindiv1").removeClass("inactive");		
		 $("#report_list1").addClass("active");
		 $("#report_maindiv1").addClass("active");
		 $("#link_shortcut").addClass("active");
	}
			
		
		
		
		
		
		
     $(function () {
		 
		 $("#link_shortcut").click(function(){
			 $("#shortcut1").removeClass("inactive");
			 $("#shortcut1").addClass("active");
			 $("#report_list1").removeClass("inactive");
			 $("#report_maindiv1").removeClass("inactive");	
			 $("#report_list1").addClass("active");
			 $("#report_maindiv1").addClass("active");
			 $("#link_shortcut").addClass("inactive");
		 });
		 
		 $("#report_list1").change(function () {
			 var repost_list = $(this).val();
			 var new_report= repost_list;
			 
				if(repost_list!='')
				{
					$("#report_list1").val(repost_list);
					$.ajax({
						type:"POST",
						url:"<?php echo base_url();?>index.php?admin/checkreport/"+repost_list,
						success:function(success)
						{
							if(success=="0")		
							{
								alert("This Report already added in shortcut!");	
								$("#report_list1").val("");
								return false;
								
							}
							else
							{
								if(new_report=='ind_student')
								{
									var report = "Individual Student Report Report";
								}
								else if(new_report=="non_teaching_list")
								{
									var report = "Non-Teaching Staff Listing Report";
								}
								else if(new_report=="fees_listing_page")
								{
									var report = "Fees Listing Report";
								}
								else if(new_report=="holiday_list")
								{
									var report = "Holiday List Report";
								}
								else if(new_report=="notification_list")
								{
									var report = "Notification List Report";
								}
								else if(new_report=="share_materials_list")
								{
									var report = "Study Materials Uploaded Report";
								}
								else if(new_report=="staff_attendence_list")
								{
									var report = "Staff Attendance Report";
								}
								else if(new_report=="teacher_list")
								{
									var report = "Teacher List Report";
								}
								else if(new_report=="group_list")
								{
									var report = "Group Listings Report";
								}
								else if(new_report=="attendance_view")
								{
									var report = "Attendance Report";
								}
								else if(new_report=="timetable_list")
								{
									var report = "Timetable Report";
								}
								else if(new_report=="exam_mark_list")
								{
									var report = "Exams Report";
								}
								else if(new_report=="marks_list")
								{
									var report = "Marks Report";
								}
								
								var r = confirm("Do You Want To Save "+report+"?");
								if (r == true) {
									
								} else {
									$("#report_list1").val("");
								   return false;
								}
								$.ajax({
						type:"POST",
						url:"<?php echo base_url();?>index.php?admin/save_data/"+repost_list+"/1",
						success:function(data)
						{
							//alert(data);
							$("#shortcut1").addClass("inactive");
							$("#shortcut1").removeClass("active");
							$("#report_list1").addClass("inactive");
							$("#report_maindiv1").addClass("inactive");
							$("#report_list1").removeClass("active");
							$("#report_maindiv1").removeClass("active");
							//alert(data);
							//$("#saved_item1").append(data);
							//alert(report_list);
								if(data=="ind_student")
								{
									
									$("#ind_student1").removeClass("inactive");
									$("#ind_student1").addClass("active");
									$("#marks_list1").removeClass("active");
									$("#marks_list1").addClass("inactive");
									$("#non_teaching_list1").addClass("inactive");
									$("#non_teaching_list1").removeClass("active");
									$("#fees_listing_page1").addClass("inactive");
                        		    $("#fees_listing_page1").removeClass("active");
									$("#holiday_list1").addClass("inactive");//Holiday List
									$("#holiday_list1").removeClass("active"); //Holiday List
									$("#teacher_list1").removeClass("active");
									$("#teacher_list1").addClass("inactive");   //teacher
									$("#notification_list1").removeClass("active");
									$("#notification_list1").addClass("inactive"); //Notification List
							 		$("#share_materials_list1").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list1").addClass("inactive");
							 		$("#staff_attendence_list1").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list1").addClass("inactive");  
							 		$("#group_list1").removeClass("active"); //Group Listings
									$("#group_list1").addClass("inactive");
									$("#attendance_view1").removeClass("active");
							 		$("#attendance_view1").addClass("inactive");   //Attendance
									$("#timetable_list1").removeClass("active");
							 		$("#timetable_list1").addClass("inactive");  // Timetable
							 		$("#exam_mark_list1").removeClass("active");
									$("#exam_mark_list1").addClass("inactive");   //Exam and Mark
                            
                              
							}
							else if(data=="non_teaching_list")
							{ 
									$("#non_teaching_list1").removeClass("inactive");// non_teaching_list
									$("#non_teaching_list1").addClass("active"); //Non-Teaching Staff Listing
									$("#teacher_list1").removeClass("active");
									$("#teacher_list1").addClass("inactive");   //teacher
									$("#ind_student1").removeClass("active");
									$("#ind_student1").addClass("inactive");
									$("#marks_list1").removeClass("active");
									$("#marks_list1").addClass("inactive");
									$("#fees_listing_page1").addClass("inactive");  //Fees Listing
                        		    $("#fees_listing_page1").removeClass("active"); //Fees Listing
                        		  
									$("#holiday_list1").addClass("inactive");//Holiday List
									$("#holiday_list1").removeClass("active"); //Holiday List
									$("#notification_list1").removeClass("active");
									$("#notification_list1").addClass("inactive"); //Notification List
							 		$("#share_materials_list1").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list1").addClass("inactive");
							 		$("#staff_attendence_list1").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list1").addClass("inactive");  
							 		$("#group_list1").removeClass("active"); //Group Listings
									$("#group_list1").addClass("inactive");
									$("#attendance_view1").removeClass("active");
							 		$("#attendance_view1").addClass("inactive");   //Attendance
									$("#timetable_list1").removeClass("active");
							 		$("#timetable_list1").addClass("inactive");  // Timetable
							 		$("#exam_mark_list1").removeClass("active");
									$("#exam_mark_list1").addClass("inactive");   //Exam and Mark
							}
							else if(data=="fees_listing_page")
							{
									$("#fees_listing_page1").addClass("active");  //Fees Listing
                        		    $("#fees_listing_page1").removeClass("inactive"); //Fees Listing
								$("#marks_list1").removeClass("active");
									$("#marks_list1").addClass("inactive");
									$("#teacher_list1").removeClass("active");
									$("#teacher_list1").addClass("inactive");   //teacher
									$("#ind_student1").removeClass("active");
									$("#ind_student1").addClass("inactive");
									
									$("#non_teaching_list1").removeClass("active");// non_teaching_list
									$("#non_teaching_list1").addClass("inactive"); //Non-Teaching Staff Listing	
                        		  
									$("#holiday_list1").addClass("inactive");//Holiday List
									$("#holiday_list1").removeClass("active"); //Holiday List
									$("#notification_list1").removeClass("active");
									$("#notification_list1").addClass("inactive"); //Notification List
							 		$("#share_materials_list1").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list1").addClass("inactive");
							 		$("#staff_attendence_list1").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list1").addClass("inactive");  
							 		$("#group_list1").removeClass("active"); //Group Listings
									$("#group_list1").addClass("inactive");
									$("#attendance_view1").removeClass("active");
							 		$("#attendance_view1").addClass("inactive");   //Attendance
									$("#timetable_list1").removeClass("active");
							 		$("#timetable_list1").addClass("inactive");  // Timetable
							 		$("#exam_mark_list1").removeClass("active");
									$("#exam_mark_list1").addClass("inactive");   //Exam and Mark
							}
							else if(data=="holiday_list")
							{
								
									$("#holiday_list1").addClass("active"); //Holiday List
									$("#holiday_list1").removeClass("inactive"); //Holiday List
									$("#marks_list1").removeClass("active");
									$("#marks_list1").addClass("inactive");
									$("#fees_listing_page1").removeClass("active"); //Fees Listing
									$("#fees_listing_page1").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student1").removeClass("active");
									$("#ind_student1").addClass("inactive");
									$("#non_teaching_list1").removeClass("active");// non_teaching_list
									$("#non_teaching_list1").addClass("inactive"); //Non-Teaching Staff Listing
									$("#teacher_list1").removeClass("active");
									$("#teacher_list1").addClass("inactive");   //teacher	                        				
									$("#notification_list1").removeClass("active");
									$("#notification_list1").addClass("inactive"); //Notification List
							 		$("#share_materials_list1").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list1").addClass("inactive");
							 		$("#staff_attendence_list1").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list1").addClass("inactive");  
							 		$("#group_list1").removeClass("active"); //Group Listings
									$("#group_list1").addClass("inactive");
									$("#attendance_view1").removeClass("active");
							 		$("#attendance_view1").addClass("inactive");   //Attendance
									$("#timetable_list1").removeClass("active");
							 		$("#timetable_list1").addClass("inactive");  // Timetable
							 		$("#exam_mark_list1").removeClass("active");
									$("#exam_mark_list1").addClass("inactive");   //Exam and Mark
							}
							else if(data=="notification_list")
							{
								$("#teacher_list1").removeClass("active");
									$("#teacher_list1").addClass("inactive");   //teacher
									$("#marks_list1").removeClass("active");
									$("#marks_list1").addClass("inactive");
									$("#notification_list1").addClass("active"); //Notification List
									$("#notification_list1").removeClass("inactive");								
									$("#holiday_list1").addClass("inactive"); //Holiday List
									$("#holiday_list1").removeClass("active"); //Holiday List
									$("#fees_listing_page1").removeClass("active"); //Fees Listing
									$("#fees_listing_page1").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student1").removeClass("active");
									$("#ind_student1").addClass("inactive");
									$("#non_teaching_list1").removeClass("active");// non_teaching_list
									$("#non_teaching_list1").addClass("inactive"); //Non-Teaching Staff Listing
							 		$("#share_materials_list1").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list1").addClass("inactive");
							 		$("#staff_attendence_list1").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list1").addClass("inactive");  
							 		$("#group_list1").removeClass("active"); //Group Listings
									$("#group_list1").addClass("inactive");
									$("#attendance_view1").removeClass("active");
							 		$("#attendance_view1").addClass("inactive");   //Attendance
									$("#timetable_list1").removeClass("active");
							 		$("#timetable_list1").addClass("inactive");  // Timetable
							 		$("#exam_mark_list1").removeClass("active");
									$("#exam_mark_list1").addClass("inactive");   //Exam and Mark
							}
							else if(data=="share_materials_list")
							{
									$("#teacher_list1").removeClass("active");
									$("#teacher_list1").addClass("inactive");   //teacher
									$("#marks_list1").removeClass("active");
									$("#marks_list1").addClass("inactive");
									$("#share_materials_list1").removeClass("inactive");  //Study Materials Uploaded
									$("#share_materials_list1").addClass("active");
									$("#notification_list1").addClass("inactive"); //Notification List
									$("#notification_list1").removeClass("active");								
									$("#holiday_list1").addClass("inactive"); //Holiday List
									$("#holiday_list1").removeClass("active"); //Holiday List
									$("#fees_listing_page1").removeClass("active"); //Fees Listing
									$("#fees_listing_page1").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student1").removeClass("active");
									$("#ind_student1").addClass("inactive");
									$("#non_teaching_list1").removeClass("active");// non_teaching_list
									$("#non_teaching_list1").addClass("inactive"); //Non-Teaching Staff Listing
							 		$("#staff_attendence_list1").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list1").addClass("inactive");  
							 		$("#group_list1").removeClass("active"); //Group Listings
									$("#group_list1").addClass("inactive");
									$("#attendance_view1").removeClass("active");
							 		$("#attendance_view1").addClass("inactive");   //Attendance
									$("#timetable_list1").removeClass("active");
							 		$("#timetable_list1").addClass("inactive");  // Timetable
							 		$("#exam_mark_list1").removeClass("active");
									$("#exam_mark_list1").addClass("inactive");   //Exam and Mark
							}
							else if(data=="staff_attendence_list")
							{
									$("#staff_attendence_list1").removeClass("inactive");   // Staff Attendance
									$("#staff_attendence_list1").addClass("active");  
									$("#marks_list1").removeClass("active");
									$("#marks_list1").addClass("inactive");
									$("#share_materials_list1").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list1").addClass("inactive");
									$("#notification_list1").addClass("inactive"); //Notification List
									$("#notification_list1").removeClass("active");								
									$("#holiday_list1").addClass("inactive"); //Holiday List
									$("#holiday_list1").removeClass("active"); //Holiday List
									$("#fees_listing_page1").removeClass("active"); //Fees Listing
									$("#fees_listing_page1").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student1").removeClass("active");
									$("#ind_student1").addClass("inactive");
									$("#non_teaching_list1").removeClass("active");// non_teaching_list
									$("#non_teaching_list1").addClass("inactive"); //Non-Teaching Staff Listing
							 		$("#group_list1").removeClass("active"); //Group Listings
									$("#group_list1").addClass("inactive");
									$("#attendance_view1").removeClass("active");
							 		$("#attendance_view1").addClass("inactive");   //Attendance
									$("#timetable_list1").removeClass("active");
							 		$("#timetable_list1").addClass("inactive");  // Timetable
							 		$("#exam_mark_list1").removeClass("active");
									$("#exam_mark_list1").addClass("inactive");   //Exam and Mark
									$("#teacher_list1").removeClass("active");
									$("#teacher_list1").addClass("inactive");   //teacher
							}
							else if(data=="group_list")
							{
									$("#group_list1").removeClass("inactive"); //Group Listings
									$("#group_list1").addClass("active");
									$("#marks_list1").removeClass("active");
									$("#marks_list1").addClass("inactive");
									$("#staff_attendence_list1").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list1").addClass("inactive");  
									$("#share_materials_list1").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list1").addClass("inactive");
									$("#notification_list1").addClass("inactive"); //Notification List
									$("#notification_list1").removeClass("active");								
									$("#holiday_list1").addClass("inactive"); //Holiday List
									$("#holiday_list1").removeClass("active"); //Holiday List
									$("#fees_listing_page1").removeClass("active"); //Fees Listing
									$("#fees_listing_page1").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student1").removeClass("active");
									$("#ind_student1").addClass("inactive");
									$("#non_teaching_list1").removeClass("active");// non_teaching_list
									$("#non_teaching_list1").addClass("inactive"); //Non-Teaching Staff Listing
							 		$("#teacher_list1").removeClass("active");
									$("#teacher_list1").addClass("inactive");   //teacher
									$("#attendance_view1").removeClass("active");
							 		$("#attendance_view1").addClass("inactive");   //Attendance
									$("#timetable_list1").removeClass("active");
							 		$("#timetable_list1").addClass("inactive");  // Timetable
							 		$("#exam_mark_list1").removeClass("active");
									$("#exam_mark_list1").addClass("inactive");   //Exam and Mark
							}
							else if(data=="attendance_view")
							{
									$("#attendance_view1").removeClass("inactive");
							 		$("#attendance_view1").addClass("active");   //Attendance
									$("#marks_list1").removeClass("active");
									$("#marks_list1").addClass("inactive");
									$("#teacher_list1").removeClass("active");
									$("#teacher_list1").addClass("inactive");   //teacher
									$("#group_list1").removeClass("active"); //Group Listings
									$("#group_list1").addClass("inactive");
									$("#staff_attendence_list1").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list1").addClass("inactive");  
									$("#share_materials_list1").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list1").addClass("inactive");
									$("#notification_list1").addClass("inactive"); //Notification List
									$("#notification_list1").removeClass("active");								
									$("#holiday_list1").addClass("inactive"); //Holiday List
									$("#holiday_list1").removeClass("active"); //Holiday List
									$("#fees_listing_page1").removeClass("active"); //Fees Listing
									$("#fees_listing_page1").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student1").removeClass("active");
									$("#ind_student1").addClass("inactive");
									$("#non_teaching_list1").removeClass("active");// non_teaching_list
									$("#non_teaching_list1").addClass("inactive"); //Non-Teaching Staff Listing
									$("#timetable_list1").removeClass("active");
							 		$("#timetable_list1").addClass("inactive");  // Timetable
							 		$("#exam_mark_list1").removeClass("active");
									$("#exam_mark_list1").addClass("inactive");   //Exam and Mark
							}
							else if(data=="timetable_list")
							{
									$("#timetable_list1").removeClass("inactive");
							 		$("#timetable_list1").addClass("active");  // Timetable
									$("#marks_list1").removeClass("active");
									$("#marks_list1").addClass("inactive");
									$("#teacher_list1").removeClass("active");
									$("#teacher_list1").addClass("inactive");   //teacher
									$("#attendance_view1").removeClass("active");
							 		$("#attendance_view1").addClass("inactive");   //Attendance
									$("#group_list1").removeClass("active"); //Group Listings
									$("#group_list1").addClass("inactive");
									$("#staff_attendence_list1").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list1").addClass("inactive");  
									$("#share_materials_list1").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list1").addClass("inactive");
									$("#notification_list1").addClass("inactive"); //Notification List
									$("#notification_list1").removeClass("active");								
									$("#holiday_list1").addClass("inactive"); //Holiday List
									$("#holiday_list1").removeClass("active"); //Holiday List
									$("#fees_listing_page1").removeClass("active"); //Fees Listing
									$("#fees_listing_page1").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student1").removeClass("active");
									$("#ind_student1").addClass("inactive");
									$("#non_teaching_list1").removeClass("active");// non_teaching_list
									$("#non_teaching_list1").addClass("inactive"); //Non-Teaching Staff Listing
							 		$("#exam_mark_list1").removeClass("active");
									$("#exam_mark_list1").addClass("inactive");   //Exam and Mark
							}
							else if(data=="exam_mark_list")
							{
									$("#exam_mark_list1").removeClass("inactive");
									$("#exam_mark_list1").addClass("active");   //Exam and Mark
									$("#marks_list1").removeClass("active");
									$("#marks_list1").addClass("inactive");
									$("#teacher_list1").removeClass("active");
									$("#teacher_list1").addClass("inactive");   //teacher
									$("#timetable_list1").removeClass("active");
							 		$("#timetable_list1").addClass("inactive");  // Timetable
									$("#attendance_view1").removeClass("active");
							 		$("#attendance_view1").addClass("inactive");   //Attendance
									$("#group_list1").removeClass("active"); //Group Listings
									$("#group_list1").addClass("inactive");
									$("#staff_attendence_list1").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list1").addClass("inactive");  
									$("#share_materials_list1").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list1").addClass("inactive");
									$("#notification_list1").addClass("inactive"); //Notification List
									$("#notification_list1").removeClass("active");								
									$("#holiday_list1").addClass("inactive"); //Holiday List
									$("#holiday_list1").removeClass("active"); //Holiday List
									$("#fees_listing_page1").removeClass("active"); //Fees Listing
									$("#fees_listing_page1").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student1").removeClass("active");
									$("#ind_student1").addClass("inactive");
									$("#non_teaching_list1").removeClass("active");// non_teaching_list
									$("#non_teaching_list1").addClass("inactive"); //Non-Teaching Staff Listing
							 		
							}
							else if(data=="teacher_list"){
								$("#teacher_list1").removeClass("inactive");
									$("#teacher_list1").addClass("active");   //Exam and Mark
									$("#marks_list1").removeClass("active");
									$("#marks_list1").addClass("inactive");
									$("#exam_mark_list1").removeClass("active");
									$("#exam_mark_list1").addClass("inactive");   //Exam and Mark
									$("#timetable_list1").removeClass("active");
							 		$("#timetable_list1").addClass("inactive");  // Timetable
									$("#attendance_view1").removeClass("active");
							 		$("#attendance_view1").addClass("inactive");   //Attendance
									$("#group_list1").removeClass("active"); //Group Listings
									$("#group_list1").addClass("inactive");
									$("#staff_attendence_list1").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list1").addClass("inactive");  
									$("#share_materials_list1").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list1").addClass("inactive");
									$("#notification_list1").addClass("inactive"); //Notification List
									$("#notification_list1").removeClass("active");								
									$("#holiday_list1").addClass("inactive"); //Holiday List
									$("#holiday_list1").removeClass("active"); //Holiday List
									$("#fees_listing_page1").removeClass("active"); //Fees Listing
									$("#fees_listing_page1").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student1").removeClass("active");
									$("#ind_student1").addClass("inactive");
									$("#non_teaching_list1").removeClass("active");// non_teaching_list
									$("#non_teaching_list1").addClass("inactive"); //Non-Teaching Staff Listing
								}
								else if(data=="marks_list"){
									$("#teacher_list1").removeClass("active");
									$("#teacher_list1").addClass("inactive");   //Exam and Mark
									$("#marks_list1").addClass("active");
									$("#marks_list1").removeClass("inactive");
								
									$("#exam_mark_list1").removeClass("active");
									$("#exam_mark_list1").addClass("inactive");   //Exam and Mark
									$("#timetable_list1").removeClass("active");
							 		$("#timetable_list1").addClass("inactive");  // Timetable
									$("#attendance_view1").removeClass("active");
							 		$("#attendance_view1").addClass("inactive");   //Attendance
									$("#group_list1").removeClass("active"); //Group Listings
									$("#group_list1").addClass("inactive");
									$("#staff_attendence_list1").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list1").addClass("inactive");  
									$("#share_materials_list1").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list1").addClass("inactive");
									$("#notification_list1").addClass("inactive"); //Notification List
									$("#notification_list1").removeClass("active");								
									$("#holiday_list1").addClass("inactive"); //Holiday List
									$("#holiday_list1").removeClass("active"); //Holiday List
									$("#fees_listing_page1").removeClass("active"); //Fees Listing
									$("#fees_listing_page1").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student1").removeClass("active");
									$("#ind_student1").addClass("inactive");
									$("#non_teaching_list1").removeClass("active");// non_teaching_list
									$("#non_teaching_list1").addClass("inactive"); //Non-Teaching Staff Listing
								}
						}
					});
					
							} // else condition
						}
					});
				}
			
		 });
		 /*              Report two start                      */
		  $("#report_list2").change(function () {
				var repost_list2 = $("#report_list2").val();
				var new_report2 = repost_list2;
				//alert(repost_list2);
				if(repost_list2!='')
				{
					$.ajax({
						type:"POST",
						url:"<?php echo base_url();?>index.php?admin/checkreport/"+repost_list2,
						success:function(success)
						{
							if(success=="0")		
							{
								alert("This Report already added in shortcut!");	
								$("#report_list2").val("");
								return false;
							}
							else
							{
								if(new_report2=='ind_student')
								{
									var report2 = "Individual Student Report Report";
								}
								else if(new_report2=="non_teaching_list")
								{
									var report2 = "Non-Teaching Staff Listing Report";
								}
								else if(new_report2=="fees_listing_page")
								{
									var report2 = "Fees Listing Report";
								}
								else if(new_report2=="holiday_list")
								{
									var report2 = "Holiday List Report";
								}
								else if(new_report2=="notification_list")
								{
									var report2 = "Notification List Report";
								}
								else if(new_report2=="share_materials_list")
								{
									var report2 = "Study Materials Uploaded Report";
								}
								else if(new_report2=="staff_attendence_list")
								{
									var report2 = "Staff Attendance Report";
								}
								else if(new_report2=="teacher_list")
								{
									var report2 = "Teacher List Report";
								}
								else if(new_report2=="group_list")
								{
									var report2 = "Group Listings Report";
								}
								else if(new_report2=="attendance_view")
								{
									var report2 = "Attendance Report";
								}
								else if(new_report2=="timetable_list")
								{
									var report2 = "Timetable Report";
								}
								else if(new_report2=="exam_mark_list")
								{
									var report2 = "Exams Report";
								}
								else if(new_report2=="marks_list")
								{
									var report2 = "Marks Report";
								}
								
								var r = confirm("Do You Want To Save "+report2+"?");
								if (r == true) {
									
								} else {
									$("#report_list2").val("");
								   return false;
								}
								
									$.ajax({
						type:"POST",
						url:"<?php echo base_url();?>index.php?admin/save_data/"+repost_list2+"/2",
						success:function(data)
						{
							$("#shortcut2").addClass("inactive");
							$("#shortcut2").removeClass("active");
							$("#report_list2").addClass("inactive");
							$("#report_maindiv2").addClass("inactive");
							$("#report_list2").removeClass("active");
							$("#report_maindiv2").removeClass("active");
							//alert(data);
							//$("#saved_item1").append(data);
							//alert(report_list);
								if(data=="ind_student")
								{
									
									$("#ind_student2").removeClass("inactive");
									$("#ind_student2").addClass("active");
									$("#marks_list2").addClass("inactive");   //Marks
									$("#marks_list2").removeClass("active");
									$("#teacher_list2").removeClass("active");
									$("#teacher_list2").addClass("inactive");   //teacher
									$("#non_teaching_list2").addClass("inactive");
									$("#non_teaching_list2").removeClass("active");
									$("#fees_listing_page2").addClass("inactive");
                        		    $("#fees_listing_page2").removeClass("active");
									$("#holiday_list2").addClass("inactive");//Holiday List
									$("#holiday_list2").removeClass("active"); //Holiday List
									$("#notification_list2").removeClass("active");
									$("#notification_list2").addClass("inactive"); //Notification List
							 		$("#share_materials_list2").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list2").addClass("inactive");
							 		$("#staff_attendence_list2").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list2").addClass("inactive");  
							 		$("#group_list2").removeClass("active"); //Group Listings
									$("#group_list2").addClass("inactive");
									$("#attendance_view2").removeClass("active");
							 		$("#attendance_view2").addClass("inactive");   //Attendance
									$("#timetable_list2").removeClass("active");
							 		$("#timetable_list2").addClass("inactive");  // Timetable
							 		$("#exam_mark_list2").removeClass("active");
									$("#exam_mark_list2").addClass("inactive");   //Exam and Mark
                            
                              
							}
							else if(data=="non_teaching_list")
							{ 
									$("#non_teaching_list2").removeClass("inactive");// non_teaching_list
									$("#non_teaching_list2").addClass("active"); //Non-Teaching Staff Listing
									$("#marks_list2").addClass("inactive");   //Marks
									$("#marks_list2").removeClass("active");
									$("#teacher_list2").removeClass("active");
									$("#teacher_list2").addClass("inactive");   //teacher
									$("#ind_student2").removeClass("active");
									$("#ind_student2").addClass("inactive");
									
									$("#fees_listing_page2").addClass("inactive");  //Fees Listing
                        		    $("#fees_listing_page2").removeClass("active"); //Fees Listing
                        		  
									$("#holiday_list2").addClass("inactive");//Holiday List
									$("#holiday_list2").removeClass("active"); //Holiday List
									$("#notification_list2").removeClass("active");
									$("#notification_list2").addClass("inactive"); //Notification List
							 		$("#share_materials_list2").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list2").addClass("inactive");
							 		$("#staff_attendence_list2").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list2").addClass("inactive");  
							 		$("#group_list2").removeClass("active"); //Group Listings
									$("#group_list2").addClass("inactive");
									$("#attendance_view2").removeClass("active");
							 		$("#attendance_view2").addClass("inactive");   //Attendance
									$("#timetable_list2").removeClass("active");
							 		$("#timetable_list2").addClass("inactive");  // Timetable
							 		$("#exam_mark_list2").removeClass("active");
									$("#exam_mark_list2").addClass("inactive");   //Exam and Mark
							}
							else if(data=="fees_listing_page")
							{
									$("#fees_listing_page2").addClass("active");  //Fees Listing
                        		    $("#fees_listing_page2").removeClass("inactive"); //Fees Listing
									$("#marks_list2").addClass("inactive");   //Marks
									$("#marks_list2").removeClass("active");
									
									$("#ind_student2").removeClass("active");
									$("#ind_student2").addClass("inactive");
									$("#teacher_list2").removeClass("active");
									$("#teacher_list2").addClass("inactive");   //teacher
									$("#non_teaching_list2").removeClass("active");// non_teaching_list
									$("#non_teaching_list2").addClass("inactive"); //Non-Teaching Staff Listing	
                        		  
									$("#holiday_list2").addClass("inactive");//Holiday List
									$("#holiday_list2").removeClass("active"); //Holiday List
									$("#notification_list2").removeClass("active");
									$("#notification_list2").addClass("inactive"); //Notification List
							 		$("#share_materials_list2").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list2").addClass("inactive");
							 		$("#staff_attendence_list2").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list2").addClass("inactive");  
							 		$("#group_list2").removeClass("active"); //Group Listings
									$("#group_list2").addClass("inactive");
									$("#attendance_view2").removeClass("active");
							 		$("#attendance_view2").addClass("inactive");   //Attendance
									$("#timetable_list2").removeClass("active");
							 		$("#timetable_list2").addClass("inactive");  // Timetable
							 		$("#exam_mark_list2").removeClass("active");
									$("#exam_mark_list2").addClass("inactive");   //Exam and Mark
							}
							else if(data=="holiday_list")
							{
									$("#holiday_list2").addClass("active"); //Holiday List
									$("#holiday_list2").removeClass("inactive"); //Holiday List
									$("#marks_list2").addClass("inactive");   //Marks
									$("#marks_list2").removeClass("active");
									$("#fees_listing_page2").removeClass("active"); //Fees Listing
									$("#fees_listing_page2").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student2").removeClass("active");
									$("#ind_student2").addClass("inactive");
									$("#non_teaching_list2").removeClass("active");// non_teaching_list
									$("#non_teaching_list2").addClass("inactive"); //Non-Teaching Staff Listing	                        			
									$("#notification_list2").removeClass("active");
									
									$("#notification_list2").addClass("inactive"); //Notification List
									$("#teacher_list2").removeClass("active");
									$("#teacher_list2").addClass("inactive");   //teacher
							 		$("#share_materials_list2").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list2").addClass("inactive");
							 		$("#staff_attendence_list2").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list2").addClass("inactive");  
							 		$("#group_list2").removeClass("active"); //Group Listings
									$("#group_list2").addClass("inactive");
									$("#attendance_view2").removeClass("active");
							 		$("#attendance_view2").addClass("inactive");   //Attendance
									$("#timetable_list2").removeClass("active");
							 		$("#timetable_list2").addClass("inactive");  // Timetable
							 		$("#exam_mark_list2").removeClass("active");
									$("#exam_mark_list2").addClass("inactive");   //Exam and Mark
							}
							else if(data=="notification_list")
							{
									$("#notification_list2").addClass("active"); //Notification List
									$("#notification_list2").removeClass("inactive");			
									$("#marks_list2").addClass("inactive");   //Marks
									$("#marks_list2").removeClass("active");					
									$("#holiday_list2").addClass("inactive"); //Holiday List
									$("#holiday_list2").removeClass("active"); //Holiday List
									$("#teacher_list2").removeClass("active");
									$("#teacher_list2").addClass("inactive");   //teacher
									$("#fees_listing_page2").removeClass("active"); //Fees Listing
									$("#fees_listing_page2").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student2").removeClass("active");
									$("#ind_student2").addClass("inactive");
									$("#non_teaching_list2").removeClass("active");// non_teaching_list
									$("#non_teaching_list2").addClass("inactive"); //Non-Teaching Staff Listing
							 		$("#share_materials_list2").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list2").addClass("inactive");
							 		$("#staff_attendence_list2").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list2").addClass("inactive");  
							 		$("#group_list2").removeClass("active"); //Group Listings
									$("#group_list2").addClass("inactive");
									$("#attendance_view2").removeClass("active");
							 		$("#attendance_view2").addClass("inactive");   //Attendance
									$("#timetable_list2").removeClass("active");
							 		$("#timetable_list2").addClass("inactive");  // Timetable
							 		$("#exam_mark_list2").removeClass("active");
									$("#exam_mark_list2").addClass("inactive");   //Exam and Mark
							}
							else if(data=="share_materials_list")
							{
									$("#share_materials_list2").removeClass("inactive");  //Study Materials Uploaded
									$("#share_materials_list2").addClass("active");
									$("#marks_list2").addClass("inactive");   //Marks
									$("#marks_list2").removeClass("active");
									$("#teacher_list2").removeClass("active");
									$("#teacher_list2").addClass("inactive");   //teacher
									$("#notification_list2").addClass("inactive"); //Notification List
									$("#notification_list2").removeClass("active");								
									$("#holiday_list2").addClass("inactive"); //Holiday List
									$("#holiday_list2").removeClass("active"); //Holiday List
									$("#fees_listing_page2").removeClass("active"); //Fees Listing
									$("#fees_listing_page2").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student2").removeClass("active");
									$("#ind_student2").addClass("inactive");
									$("#non_teaching_list2").removeClass("active");// non_teaching_list
									$("#non_teaching_list2").addClass("inactive"); //Non-Teaching Staff Listing
							 		$("#staff_attendence_list2").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list2").addClass("inactive");  
							 		$("#group_list2").removeClass("active"); //Group Listings
									$("#group_list2").addClass("inactive");
									$("#attendance_view2").removeClass("active");
							 		$("#attendance_view2").addClass("inactive");   //Attendance
									$("#timetable_list2").removeClass("active");
							 		$("#timetable_list2").addClass("inactive");  // Timetable
							 		$("#exam_mark_list2").removeClass("active");
									$("#exam_mark_list2").addClass("inactive");   //Exam and Mark
							}
							else if(data=="staff_attendence_list")
							{
									$("#staff_attendence_list2").removeClass("inactive");   // Staff Attendance
									$("#staff_attendence_list2").addClass("active");  
									$("#marks_list2").addClass("inactive");   //Marks
									$("#marks_list2").removeClass("active");
									$("#share_materials_list2").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list2").addClass("inactive");
									$("#teacher_list2").removeClass("active");
									$("#teacher_list2").addClass("inactive");   //teacher
									$("#notification_list2").addClass("inactive"); //Notification List
									$("#notification_list2").removeClass("active");								
									$("#holiday_list2").addClass("inactive"); //Holiday List
									$("#holiday_list2").removeClass("active"); //Holiday List
									$("#fees_listing_page2").removeClass("active"); //Fees Listing
									$("#fees_listing_page2").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student2").removeClass("active");
									$("#ind_student2").addClass("inactive");
									$("#non_teaching_list2").removeClass("active");// non_teaching_list
									$("#non_teaching_list2").addClass("inactive"); //Non-Teaching Staff Listing
							 		$("#group_list2").removeClass("active"); //Group Listings
									$("#group_list2").addClass("inactive");
									$("#attendance_view2").removeClass("active");
							 		$("#attendance_view2").addClass("inactive");   //Attendance
									$("#timetable_list2").removeClass("active");
							 		$("#timetable_list2").addClass("inactive");  // Timetable
							 		$("#exam_mark_list2").removeClass("active");
									$("#exam_mark_list2").addClass("inactive");   //Exam and Mark
							}
							else if(data=="group_list")
							{
									$("#group_list2").removeClass("inactive"); //Group Listings
									$("#group_list2").addClass("active");
									$("#marks_list2").addClass("inactive");   //Marks
									$("#marks_list2").removeClass("active");
									$("#staff_attendence_list2").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list2").addClass("inactive");  
									$("#teacher_list2").removeClass("active");
									$("#teacher_list2").addClass("inactive");   //teacher
									$("#share_materials_list2").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list2").addClass("inactive");
									$("#notification_list2").addClass("inactive"); //Notification List
									$("#notification_list2").removeClass("active");								
									$("#holiday_list2").addClass("inactive"); //Holiday List
									$("#holiday_list2").removeClass("active"); //Holiday List
									$("#fees_listing_page2").removeClass("active"); //Fees Listing
									$("#fees_listing_page2").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student2").removeClass("active");
									$("#ind_student2").addClass("inactive");
									$("#non_teaching_list2").removeClass("active");// non_teaching_list
									$("#non_teaching_list2").addClass("inactive"); //Non-Teaching Staff Listing
							 		
									$("#attendance_view2").removeClass("active");
							 		$("#attendance_view2").addClass("inactive");   //Attendance
									$("#timetable_list2").removeClass("active");
							 		$("#timetable_list2").addClass("inactive");  // Timetable
							 		$("#exam_mark_list2").removeClass("active");
									$("#exam_mark_list2").addClass("inactive");   //Exam and Mark
							}
							else if(data=="attendance_view")
							{
									$("#attendance_view2").removeClass("inactive");
							 		$("#attendance_view2").addClass("active");   //Attendance
									$("#marks_list2").addClass("inactive");   //Marks
									$("#marks_list2").removeClass("active");
									$("#group_list2").removeClass("active"); //Group Listings
									$("#group_list2").addClass("inactive");
									$("#teacher_list2").removeClass("active");
									$("#teacher_list2").addClass("inactive");   //teacher
									$("#staff_attendence_list2").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list2").addClass("inactive");  
									$("#share_materials_list2").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list2").addClass("inactive");
									$("#notification_list2").addClass("inactive"); //Notification List
									$("#notification_list2").removeClass("active");								
									$("#holiday_list2").addClass("inactive"); //Holiday List
									$("#holiday_list2").removeClass("active"); //Holiday List
									$("#fees_listing_page2").removeClass("active"); //Fees Listing
									$("#fees_listing_page2").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student2").removeClass("active");
									$("#ind_student2").addClass("inactive");
									$("#non_teaching_list2").removeClass("active");// non_teaching_list
									$("#non_teaching_list2").addClass("inactive"); //Non-Teaching Staff Listing
									$("#timetable_list2").removeClass("active");
							 		$("#timetable_list2").addClass("inactive");  // Timetable
							 		$("#exam_mark_list2").removeClass("active");
									$("#exam_mark_list2").addClass("inactive");   //Exam and Mark
							}
							else if(data=="timetable_list")
							{
									$("#timetable_list2").removeClass("inactive");
							 		$("#timetable_list2").addClass("active");  // Timetable
									$("#marks_list2").addClass("inactive");   //Marks
									$("#marks_list2").removeClass("active");
									$("#teacher_list2").removeClass("active");
									$("#teacher_list2").addClass("inactive");   //teacher
									$("#attendance_view2").removeClass("active");
							 		$("#attendance_view2").addClass("inactive");   //Attendance
									$("#group_list2").removeClass("active"); //Group Listings
									$("#group_list2").addClass("inactive");
									$("#staff_attendence_list2").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list2").addClass("inactive");  
									$("#share_materials_list2").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list2").addClass("inactive");
									$("#notification_list2").addClass("inactive"); //Notification List
									$("#notification_list2").removeClass("active");								
									$("#holiday_list2").addClass("inactive"); //Holiday List
									$("#holiday_list2").removeClass("active"); //Holiday List
									$("#fees_listing_page2").removeClass("active"); //Fees Listing
									$("#fees_listing_page2").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student2").removeClass("active");
									$("#ind_student2").addClass("inactive");
									$("#non_teaching_list2").removeClass("active");// non_teaching_list
									$("#non_teaching_list2").addClass("inactive"); //Non-Teaching Staff Listing
							 		$("#exam_mark_list2").removeClass("active");
									$("#exam_mark_list2").addClass("inactive");   //Exam and Mark
							}
							else if(data=="exam_mark_list")
							{
									$("#exam_mark_list2").removeClass("inactive");
									$("#exam_mark_list2").addClass("active");   //Exam and Mark
									$("#marks_list2").addClass("inactive");   //Marks
									$("#marks_list2").removeClass("active");
									$("#teacher_list2").removeClass("active");
									$("#teacher_list2").addClass("inactive");   //teacher
									$("#timetable_list2").removeClass("active");
							 		$("#timetable_list2").addClass("inactive");  // Timetable
									$("#attendance_view2").removeClass("active");
							 		$("#attendance_view2").addClass("inactive");   //Attendance
									$("#group_list2").removeClass("active"); //Group Listings
									$("#group_list2").addClass("inactive");
									$("#staff_attendence_list2").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list2").addClass("inactive");  
									$("#share_materials_list2").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list2").addClass("inactive");
									$("#notification_list2").addClass("inactive"); //Notification List
									$("#notification_list2").removeClass("active");								
									$("#holiday_list2").addClass("inactive"); //Holiday List
									$("#holiday_list2").removeClass("active"); //Holiday List
									$("#fees_listing_page2").removeClass("active"); //Fees Listing
									$("#fees_listing_page2").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student2").removeClass("active");
									$("#ind_student2").addClass("inactive");
									$("#non_teaching_list2").removeClass("active");// non_teaching_list
									$("#non_teaching_list2").addClass("inactive"); //Non-Teaching Staff Listing
							 		
							}
							else if(data=="teacher_list")
							{
									$("#teacher_list2").removeClass("inactive");
									$("#teacher_list2").addClass("active");   //teacher
									$("#marks_list2").addClass("inactive");   //Marks
									$("#marks_list2").removeClass("active");
									$("#exam_mark_list2").removeClass("active");
									$("#exam_mark_list2").addClass("inactive");   //Exam and Mark
									$("#timetable_list2").removeClass("active");
							 		$("#timetable_list2").addClass("inactive");  // Timetable
									$("#attendance_view2").removeClass("active");
							 		$("#attendance_view2").addClass("inactive");   //Attendance
									$("#group_list2").removeClass("active"); //Group Listings
									$("#group_list2").addClass("inactive");
									$("#staff_attendence_list2").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list2").addClass("inactive");  
									$("#share_materials_list2").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list2").addClass("inactive");
									$("#notification_list2").addClass("inactive"); //Notification List
									$("#notification_list2").removeClass("active");								
									$("#holiday_list2").addClass("inactive"); //Holiday List
									$("#holiday_list2").removeClass("active"); //Holiday List
									$("#fees_listing_page2").removeClass("active"); //Fees Listing
									$("#fees_listing_page2").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student2").removeClass("active");
									$("#ind_student2").addClass("inactive");
									$("#non_teaching_list2").removeClass("active");// non_teaching_list
									$("#non_teaching_list2").addClass("inactive"); //Non-Teaching Staff Listing
							 		
							}
							else if(data=="marks_list")
							{
									$("#teacher_list2").removeClass("active");
									$("#teacher_list2").addClass("inactive");   //teacher
									$("#marks_list2").addClass("active");   //Marks
									$("#marks_list2").removeClass("inactive");
									
									$("#exam_mark_list2").removeClass("active");
									$("#exam_mark_list2").addClass("inactive");   //Exam and Mark
									$("#timetable_list2").removeClass("active");
							 		$("#timetable_list2").addClass("inactive");  // Timetable
									$("#attendance_view2").removeClass("active");
							 		$("#attendance_view2").addClass("inactive");   //Attendance
									$("#group_list2").removeClass("active"); //Group Listings
									$("#group_list2").addClass("inactive");
									$("#staff_attendence_list2").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list2").addClass("inactive");  
									$("#share_materials_list2").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list2").addClass("inactive");
									$("#notification_list2").addClass("inactive"); //Notification List
									$("#notification_list2").removeClass("active");								
									$("#holiday_list2").addClass("inactive"); //Holiday List
									$("#holiday_list2").removeClass("active"); //Holiday List
									$("#fees_listing_page2").removeClass("active"); //Fees Listing
									$("#fees_listing_page2").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student2").removeClass("active");
									$("#ind_student2").addClass("inactive");
									$("#non_teaching_list2").removeClass("active");// non_teaching_list
									$("#non_teaching_list2").addClass("inactive"); //Non-Teaching Staff Listing
							 		
							}
						}
					});
			
							}
						}
					});
				}
				
				
		 });
		 
		 /*     Report Two End */
		  /*     Report Three Start */
		  $("#report_list3").change(function () {
				var repost_list3 = $("#report_list3").val();
				var new_report3 = repost_list3;
				//alert(repost_list2);
				if(repost_list3!='')
				{
					$.ajax({
						type:"POST",
						url:"<?php echo base_url();?>index.php?admin/checkreport/"+repost_list3,
						success:function(success)
						{
							if(success=="0")		
							{
								alert("This Report already added in shortcut!");	
								$("#report_list3").val("");
								return false;
							}
							else
							{
								if(new_report3=='ind_student')
								{
									var report3 = "Individual Student Report Report";
								}
								else if(new_report3=="non_teaching_list")
								{
									var report3 = "Non-Teaching Staff Listing Report";
								}
								else if(new_report3=="fees_listing_page")
								{
									var report3 = "Fees Listing Report";
								}
								else if(new_report3=="holiday_list")
								{
									var report3 = "Holiday List Report";
								}
								else if(new_report3=="notification_list")
								{
									var report3 = "Notification List Report";
								}
								else if(new_report3=="share_materials_list")
								{
									var report3 = "Study Materials Uploaded Report";
								}
								else if(new_report3=="staff_attendence_list")
								{
									var report3 = "Staff Attendance Report";
								}
								else if(new_report3=="teacher_list")
								{
									var report3 = "Teacher List Report";
								}
								else if(new_report3=="group_list")
								{
									var report3 = "Group Listings Report";
								}
								else if(new_report3=="attendance_view")
								{
									var report3 = "Attendance Report";
								}
								else if(new_report3=="timetable_list")
								{
									var report3 = "Timetable Report";
								}
								else if(new_report3=="exam_mark_list")
								{
									var report3 = "Exams Report";
								}
								else if(new_report3=="marks_list")
								{
									var report3 = "Marks Report";
								}
								
								var r = confirm("Do You Want To Save "+report3+"?");
								if (r == true) {
									
								} else {
									$("#report_list3").val("");
								   return false;
								}
								$.ajax({
									type:"POST",
									url:"<?php echo base_url();?>index.php?admin/save_data/"+repost_list3+"/3",
									success:function(data)
									{
										$("#shortcut3").addClass("inactive");
										$("#shortcut3").removeClass("active");
										$("#report_list3").addClass("inactive");
										$("#report_maindiv3").addClass("inactive");
										$("#report_list3").removeClass("active");
										$("#report_maindiv3").removeClass("active");
										//alert(data);
										//$("#saved_item1").append(data);
										//alert(report_list);
											if(data=="ind_student")
											{
												
												$("#ind_student3").removeClass("inactive");
												$("#ind_student3").addClass("active");
												$("#marks_list3").removeClass("active");
												$("#marks_list3").addClass("inactive");   //Exam and Mark
												$("#teacher_list3").removeClass("active");
												$("#teacher_list3").addClass("inactive");   //teacher
												$("#non_teaching_list3").addClass("inactive");
												$("#non_teaching_list3").removeClass("active");
												$("#fees_listing_page3").addClass("inactive");
												$("#fees_listing_page3").removeClass("active");
												$("#holiday_list3").addClass("inactive");//Holiday List
												$("#holiday_list3").removeClass("active"); //Holiday List
												$("#notification_list3").removeClass("active");
												$("#notification_list3").addClass("inactive"); //Notification List
												$("#share_materials_list3").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list3").addClass("inactive");
												$("#staff_attendence_list3").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list3").addClass("inactive");  
												$("#group_list3").removeClass("active"); //Group Listings
												$("#group_list3").addClass("inactive");
												$("#attendance_view3").removeClass("active");
												$("#attendance_view3").addClass("inactive");   //Attendance
												$("#timetable_list3").removeClass("active");
												$("#timetable_list3").addClass("inactive");  // Timetable
												$("#exam_mark_list3").removeClass("active");
												$("#exam_mark_list3").addClass("inactive");   //Exam and Mark
										
										  
										}
										else if(data=="non_teaching_list")
										{ 
												$("#non_teaching_list3").removeClass("inactive");// non_teaching_list
												$("#non_teaching_list3").addClass("active"); //Non-Teaching Staff Listing
												$("#marks_list3").removeClass("active");
												$("#marks_list3").addClass("inactive");   //Exam and Mark
												$("#teacher_list3").removeClass("active");
												$("#teacher_list3").addClass("inactive");   //teacher
												$("#ind_student3").removeClass("active");
												$("#ind_student3").addClass("inactive");
												
												$("#fees_listing_page3").addClass("inactive");  //Fees Listing
												$("#fees_listing_page3").removeClass("active"); //Fees Listing
											  
												$("#holiday_list3").addClass("inactive");//Holiday List
												$("#holiday_list3").removeClass("active"); //Holiday List
												$("#notification_list3").removeClass("active");
												$("#notification_list3").addClass("inactive"); //Notification List
												$("#share_materials_list3").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list3").addClass("inactive");
												$("#staff_attendence_list3").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list3").addClass("inactive");  
												$("#group_list3").removeClass("active"); //Group Listings
												$("#group_list3").addClass("inactive");
												$("#attendance_view3").removeClass("active");
												$("#attendance_view3").addClass("inactive");   //Attendance
												$("#timetable_list3").removeClass("active");
												$("#timetable_list3").addClass("inactive");  // Timetable
												$("#exam_mark_list3").removeClass("active");
												$("#exam_mark_list3").addClass("inactive");   //Exam and Mark
										}
										else if(data=="fees_listing_page")
										{
												$("#fees_listing_page3").addClass("active");  //Fees Listing
												$("#fees_listing_page3").removeClass("inactive"); //Fees Listing
												$("#marks_list3").removeClass("active");
												$("#marks_list3").addClass("inactive");   //Exam and Mark
												$("#teacher_list3").removeClass("active");
												$("#teacher_list3").addClass("inactive");   //teacher
												
												$("#ind_student3").removeClass("active");
												$("#ind_student3").addClass("inactive");
												
												$("#non_teaching_list3").removeClass("active");// non_teaching_list
												$("#non_teaching_list3").addClass("inactive"); //Non-Teaching Staff Listing	
											  
												$("#holiday_list3").addClass("inactive");//Holiday List
												$("#holiday_list3").removeClass("active"); //Holiday List
												$("#notification_list3").removeClass("active");
												$("#notification_list3").addClass("inactive"); //Notification List
												$("#share_materials_list3").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list3").addClass("inactive");
												$("#staff_attendence_list3").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list3").addClass("inactive");  
												$("#group_list3").removeClass("active"); //Group Listings
												$("#group_list3").addClass("inactive");
												$("#attendance_view3").removeClass("active");
												$("#attendance_view3").addClass("inactive");   //Attendance
												$("#timetable_list3").removeClass("active");
												$("#timetable_list3").addClass("inactive");  // Timetable
												$("#exam_mark_list3").removeClass("active");
												$("#exam_mark_list3").addClass("inactive");   //Exam and Mark
										}
										else if(data=="holiday_list")
										{
												$("#holiday_list3").addClass("active"); //Holiday List
												$("#holiday_list3").removeClass("inactive"); //Holiday List
												$("#marks_list3").removeClass("active");
												$("#marks_list3").addClass("inactive");   //Exam and Mark
												$("#teacher_list3").removeClass("active");
												$("#teacher_list3").addClass("inactive");   //teacher
												$("#fees_listing_page3").removeClass("active"); //Fees Listing
												$("#fees_listing_page3").addClass("inactive");  //Fees Listing
												$("#ind_student3").removeClass("active");
												$("#ind_student3").addClass("inactive");
												$("#non_teaching_list3").removeClass("active");// non_teaching_list
												$("#non_teaching_list3").addClass("inactive"); //Non-Teaching Staff Listing	                        			
												$("#notification_list3").removeClass("active");
												$("#notification_list3").addClass("inactive"); //Notification List
												$("#share_materials_list3").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list3").addClass("inactive");
												$("#staff_attendence_list3").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list3").addClass("inactive");  
												$("#group_list3").removeClass("active"); //Group Listings
												$("#group_list3").addClass("inactive");
												$("#attendance_view3").removeClass("active");
												$("#attendance_view3").addClass("inactive");   //Attendance
												$("#timetable_list3").removeClass("active");
												$("#timetable_list3").addClass("inactive");  // Timetable
												$("#exam_mark_list3").removeClass("active");
												$("#exam_mark_list3").addClass("inactive");   //Exam and Mark
										}
										else if(data=="notification_list")
										{
												$("#notification_list3").addClass("active"); //Notification List
												$("#notification_list3").removeClass("inactive");	
												$("#marks_list3").removeClass("active");
												$("#marks_list3").addClass("inactive");   //Exam and Mark
												$("#teacher_list3").removeClass("active");
												$("#teacher_list3").addClass("inactive");   //teacher							
												$("#holiday_list3").addClass("inactive"); //Holiday List
												$("#holiday_list3").removeClass("active"); //Holiday List
												$("#fees_listing_page3").removeClass("active"); //Fees Listing
												$("#fees_listing_page3").addClass("inactive");  //Fees Listing
												$("#ind_student3").removeClass("active");
												$("#ind_student3").addClass("inactive");
												$("#non_teaching_list3").removeClass("active");// non_teaching_list
												$("#non_teaching_list3").addClass("inactive"); //Non-Teaching Staff Listing
												$("#share_materials_list3").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list3").addClass("inactive");
												$("#staff_attendence_list3").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list3").addClass("inactive");  
												$("#group_list3").removeClass("active"); //Group Listings
												$("#group_list3").addClass("inactive");
												$("#attendance_view3").removeClass("active");
												$("#attendance_view3").addClass("inactive");   //Attendance
												$("#timetable_list3").removeClass("active");
												$("#timetable_list3").addClass("inactive");  // Timetable
												$("#exam_mark_list3").removeClass("active");
												$("#exam_mark_list3").addClass("inactive");   //Exam and Mark
										}
										else if(data=="share_materials_list")
										{
												$("#share_materials_list3").removeClass("inactive");  //Study Materials Uploaded
												$("#share_materials_list3").addClass("active");
												$("#marks_list3").removeClass("active");
												$("#marks_list3").addClass("inactive");   //Exam and Mark
												$("#teacher_list3").removeClass("active");
												
												$("#teacher_list3").addClass("inactive");   //teacher
												$("#notification_list3").addClass("inactive"); //Notification List
												$("#notification_list3").removeClass("active");								
												$("#holiday_list3").addClass("inactive"); //Holiday List
												$("#holiday_list3").removeClass("active"); //Holiday List
												$("#fees_listing_page3").removeClass("active"); //Fees Listing
												$("#fees_listing_page3").addClass("inactive");  //Fees Listing
												$("#ind_student3").removeClass("active");
												$("#ind_student3").addClass("inactive");
												$("#non_teaching_list3").removeClass("active");// non_teaching_list
												$("#non_teaching_list3").addClass("inactive"); //Non-Teaching Staff Listing
												$("#staff_attendence_list3").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list3").addClass("inactive");  
												$("#group_list3").removeClass("active"); //Group Listings
												$("#group_list3").addClass("inactive");
												$("#attendance_view3").removeClass("active");
												$("#attendance_view3").addClass("inactive");   //Attendance
												$("#timetable_list3").removeClass("active");
												$("#timetable_list3").addClass("inactive");  // Timetable
												$("#exam_mark_list3").removeClass("active");
												$("#exam_mark_list3").addClass("inactive");   //Exam and Mark
										}
										else if(data=="staff_attendence_list")
										{
												$("#staff_attendence_list3").removeClass("inactive");   // Staff Attendance
												$("#staff_attendence_list3").addClass("active");
												$("#marks_list3").removeClass("active");
												$("#marks_list3").addClass("inactive");   //Exam and Mark
												$("#teacher_list3").removeClass("active");
												$("#teacher_list3").addClass("inactive");   //teacher  
												$("#share_materials_list3").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list3").addClass("inactive");
												$("#notification_list3").addClass("inactive"); //Notification List
												$("#notification_list3").removeClass("active");								
												$("#holiday_list3").addClass("inactive"); //Holiday List
												$("#holiday_list3").removeClass("active"); //Holiday List
												$("#fees_listing_page3").removeClass("active"); //Fees Listing
												$("#fees_listing_page3").addClass("inactive");  //Fees Listing
												$("#ind_student3").removeClass("active");
												$("#ind_student3").addClass("inactive");
												$("#non_teaching_list3").removeClass("active");// non_teaching_list
												$("#non_teaching_list3").addClass("inactive"); //Non-Teaching Staff Listing
												$("#group_list3").removeClass("active"); //Group Listings
												$("#group_list3").addClass("inactive");
												$("#attendance_view3").removeClass("active");
												$("#attendance_view3").addClass("inactive");   //Attendance
												$("#timetable_list3").removeClass("active");
												$("#timetable_list3").addClass("inactive");  // Timetable
												$("#exam_mark_list3").removeClass("active");
												$("#exam_mark_list3").addClass("inactive");   //Exam and Mark
										}
										else if(data=="group_list")
										{
												$("#group_list3").removeClass("inactive"); //Group Listings
												$("#group_list3").addClass("active");
												$("#marks_list3").removeClass("active");
												$("#marks_list3").addClass("inactive");   //Exam and Mark
												$("#teacher_list3").removeClass("active");
												$("#teacher_list3").addClass("inactive");   //teacher
												$("#staff_attendence_list3").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list3").addClass("inactive");  
												$("#share_materials_list3").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list3").addClass("inactive");
												$("#notification_list3").addClass("inactive"); //Notification List
												$("#notification_list3").removeClass("active");								
												$("#holiday_list3").addClass("inactive"); //Holiday List
												$("#holiday_list3").removeClass("active"); //Holiday List
												$("#fees_listing_page3").removeClass("active"); //Fees Listing
												$("#fees_listing_page3").addClass("inactive");  //Fees Listing
												$("#ind_student3").removeClass("active");
												$("#ind_student3").addClass("inactive");
												$("#non_teaching_list3").removeClass("active");// non_teaching_list
												$("#non_teaching_list3").addClass("inactive"); //Non-Teaching Staff Listing
												
												$("#attendance_view3").removeClass("active");
												$("#attendance_view3").addClass("inactive");   //Attendance
												$("#timetable_list3").removeClass("active");
												$("#timetable_list3").addClass("inactive");  // Timetable
												$("#exam_mark_list3").removeClass("active");
												$("#exam_mark_list3").addClass("inactive");   //Exam and Mark
										}
										else if(data=="attendance_view")
										{
												$("#attendance_view3").removeClass("inactive");
												$("#attendance_view3").addClass("active");   //Attendance
												$("#marks_list3").removeClass("active");
												$("#marks_list3").addClass("inactive");   //Exam and Mark
												$("#teacher_list3").removeClass("active");
												$("#teacher_list3").addClass("inactive");   //teacher
												$("#group_list3").removeClass("active"); //Group Listings
												$("#group_list3").addClass("inactive");
												$("#staff_attendence_list3").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list3").addClass("inactive");  
												$("#share_materials_list3").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list3").addClass("inactive");
												$("#notification_list3").addClass("inactive"); //Notification List
												$("#notification_list3").removeClass("active");								
												$("#holiday_list3").addClass("inactive"); //Holiday List
												$("#holiday_list3").removeClass("active"); //Holiday List
												$("#fees_listing_page3").removeClass("active"); //Fees Listing
												$("#fees_listing_page3").addClass("inactive");  //Fees Listing
												$("#ind_student3").removeClass("active");
												$("#ind_student3").addClass("inactive");
												$("#non_teaching_list3").removeClass("active");// non_teaching_list
												$("#non_teaching_list3").addClass("inactive"); //Non-Teaching Staff Listing
												$("#timetable_list3").removeClass("active");
												$("#timetable_list3").addClass("inactive");  // Timetable
												$("#exam_mark_list3").removeClass("active");
												$("#exam_mark_list3").addClass("inactive");   //Exam and Mark
										}
										else if(data=="timetable_list")
										{
												$("#timetable_list3").removeClass("inactive");
												$("#timetable_list3").addClass("active");  // Timetable
												$("#marks_list3").removeClass("active");
												$("#marks_list3").addClass("inactive");   //Exam and Mark
												$("#teacher_list3").removeClass("active");
												$("#teacher_list3").addClass("inactive");   //teacher
												$("#attendance_view3").removeClass("active");
												$("#attendance_view3").addClass("inactive");   //Attendance
												$("#group_list3").removeClass("active"); //Group Listings
												$("#group_list3").addClass("inactive");
												$("#staff_attendence_list3").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list3").addClass("inactive");  
												$("#share_materials_list3").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list3").addClass("inactive");
												$("#notification_list3").addClass("inactive"); //Notification List
												$("#notification_list3").removeClass("active");								
												$("#holiday_list3").addClass("inactive"); //Holiday List
												$("#holiday_list3").removeClass("active"); //Holiday List
												$("#fees_listing_page3").removeClass("active"); //Fees Listing
												$("#fees_listing_page3").addClass("inactive");  //Fees Listing
												$("#ind_student3").removeClass("active");
												$("#ind_student3").addClass("inactive");
												$("#non_teaching_list3").removeClass("active");// non_teaching_list
												$("#non_teaching_list3").addClass("inactive"); //Non-Teaching Staff Listing
												$("#exam_mark_list3").removeClass("active");
												$("#exam_mark_list3").addClass("inactive");   //Exam and Mark
										}
										else if(data=="exam_mark_list")
										{
												$("#exam_mark_list3").removeClass("inactive");
												$("#exam_mark_list3").addClass("active");   //Exam and Mark
												$("#marks_list3").removeClass("active");
												$("#marks_list3").addClass("inactive");   //Exam and Mark
												$("#teacher_list3").removeClass("active");
												$("#teacher_list3").addClass("inactive");   //teacher
												$("#timetable_list3").removeClass("active");
												$("#timetable_list3").addClass("inactive");  // Timetable
												$("#attendance_view3").removeClass("active");
												$("#attendance_view3").addClass("inactive");   //Attendance
												$("#group_list3").removeClass("active"); //Group Listings
												$("#group_list3").addClass("inactive");
												$("#staff_attendence_list3").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list3").addClass("inactive");  
												$("#share_materials_list3").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list3").addClass("inactive");
												$("#notification_list3").addClass("inactive"); //Notification List
												$("#notification_list3").removeClass("active");								
												$("#holiday_list3").addClass("inactive"); //Holiday List
												$("#holiday_list3").removeClass("active"); //Holiday List
												$("#fees_listing_page3").removeClass("active"); //Fees Listing
												$("#fees_listing_page3").addClass("inactive");  //Fees Listing
												$("#ind_student3").removeClass("active");
												$("#ind_student3").addClass("inactive");
												$("#non_teaching_list3").removeClass("active");// non_teaching_list
												$("#non_teaching_list3").addClass("inactive"); //Non-Teaching Staff Listing
												
										}
										else if(data=="teacher_list")
										{
												$("#teacher_list3").removeClass("inactive");
												$("#teacher_list3").addClass("active");   //Exam and Mark
												$("#marks_list3").removeClass("active");
												$("#marks_list3").addClass("inactive");   //Exam and Mark
												$("#exam_mark_list3").removeClass("active");
												$("#exam_mark_list3").addClass("inactive");   //Exam and Mark
												$("#timetable_list3").removeClass("active");
												$("#timetable_list3").addClass("inactive");  // Timetable
												$("#attendance_view3").removeClass("active");
												$("#attendance_view3").addClass("inactive");   //Attendance
												$("#group_list3").removeClass("active"); //Group Listings
												$("#group_list3").addClass("inactive");
												$("#staff_attendence_list3").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list3").addClass("inactive");  
												$("#share_materials_list3").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list3").addClass("inactive");
												$("#notification_list3").addClass("inactive"); //Notification List
												$("#notification_list3").removeClass("active");								
												$("#holiday_list3").addClass("inactive"); //Holiday List
												$("#holiday_list3").removeClass("active"); //Holiday List
												$("#fees_listing_page3").removeClass("active"); //Fees Listing
												$("#fees_listing_page3").addClass("inactive");  //Fees Listing
												$("#ind_student3").removeClass("active");
												$("#ind_student3").addClass("inactive");
												$("#non_teaching_list3").removeClass("active");// non_teaching_list
												$("#non_teaching_list3").addClass("inactive"); //Non-Teaching Staff Listing
												
										}
										else if(data=="marks_list")
										{
												$("#teacher_list3").removeClass("active");
												$("#teacher_list3").addClass("inactive");   //Exam and Mark
												$("#marks_list3").removeClass("inactive");
												$("#marks_list3").addClass("active");   //Exam and Mark
												$("#exam_mark_list3").removeClass("active");
												$("#exam_mark_list3").addClass("inactive");   //Exam and Mark
												$("#timetable_list3").removeClass("active");
												$("#timetable_list3").addClass("inactive");  // Timetable
												$("#attendance_view3").removeClass("active");
												$("#attendance_view3").addClass("inactive");   //Attendance
												$("#group_list3").removeClass("active"); //Group Listings
												$("#group_list3").addClass("inactive");
												$("#staff_attendence_list3").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list3").addClass("inactive");  
												$("#share_materials_list3").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list3").addClass("inactive");
												$("#notification_list3").addClass("inactive"); //Notification List
												$("#notification_list3").removeClass("active");								
												$("#holiday_list3").addClass("inactive"); //Holiday List
												$("#holiday_list3").removeClass("active"); //Holiday List
												$("#fees_listing_page3").removeClass("active"); //Fees Listing
												$("#fees_listing_page3").addClass("inactive");  //Fees Listing
												$("#ind_student3").removeClass("active");
												$("#ind_student3").addClass("inactive");
												$("#non_teaching_list3").removeClass("active");// non_teaching_list
												$("#non_teaching_list3").addClass("inactive"); //Non-Teaching Staff Listing
												
										}
									}
								});
									
							} // else condition 
						}
					});
				}
				//$("#report_list3").val("");
				
		 });
		 /*     Report Three End */
		 
		   /*     Report four Start */
		    $("#report_list4").change(function () {
				var repost_list4 = $("#report_list4").val();
				var new_report4 = repost_list4;
				//alert(repost_list2);
				if(repost_list4!='')
				{
					$.ajax({
						type:"POST",
						url:"<?php echo base_url();?>index.php?admin/checkreport/"+repost_list4,
						success:function(success)
						{
							if(success=="0")		
							{
								alert("This Report already added in shortcut!");
								$("#report_list4").val("");	
								return false;
							}
							else
							{
					
								if(new_report4=='ind_student')
								{
									var report4 = "Individual Student Report Report";
								}
								else if(new_report4=="non_teaching_list")
								{
									var report4 = "Non-Teaching Staff Listing Report";
								}
								else if(new_report4=="fees_listing_page")
								{
									var report4 = "Fees Listing Report";
								}
								else if(new_report4=="holiday_list")
								{
									var report4 = "Holiday List Report";
								}
								else if(new_report4=="notification_list")
								{
									var report4 = "Notification List Report";
								}
								else if(new_report4=="share_materials_list")
								{
									var report4 = "Study Materials Uploaded Report";
								}
								else if(new_report4=="staff_attendence_list")
								{
									var report4 = "Staff Attendance Report";
								}
								else if(new_report4=="teacher_list")
								{
									var report4 = "Teacher List Report";
								}
								else if(new_report4=="group_list")
								{
									var report4 = "Group Listings Report";
								}
								else if(new_report4=="attendance_view")
								{
									var report4 = "Attendance Report";
								}
								else if(new_report4=="timetable_list")
								{
									var report4 = "Timetable Report";
								}
								else if(new_report4=="exam_mark_list")
								{
									var report4 = "Exams Report";
								}
								else if(new_report4=="marks_list")
								{
									var report4 = "Marks Report";
								}
								
								var r = confirm("Do You Want To Save "+report4+"?");
								
								if (r == true) {
									
								} else {
									$("#report_list4").val("");	
								   return false;
								}
								
								$.ajax({
									type:"POST",
									url:"<?php echo base_url();?>index.php?admin/save_data/"+repost_list4+"/4",
									success:function(data)
									{
										$("#shortcut4").addClass("inactive");
										$("#shortcut4").removeClass("active");
										$("#report_list4").addClass("inactive");
										$("#report_maindiv4").addClass("inactive");
										$("#report_list4").removeClass("active");
										$("#report_maindiv4").removeClass("active");
										//alert(data);
										//$("#saved_item1").append(data);
										//alert(report_list);
											if(data=="ind_student")
											{
												
												$("#ind_student4").removeClass("inactive");
												$("#ind_student4").addClass("active");
												$("#marks_list4").removeClass("active");
												$("#marks_list4").addClass("inactive");   //Exam and Mark
												$("#teacher_list4").removeClass("active");
												$("#teacher_list4").addClass("inactive");   //Teacher
												$("#non_teaching_list4").addClass("inactive");
												$("#non_teaching_list4").removeClass("active");
												$("#fees_listing_page4").addClass("inactive");
												$("#fees_listing_page4").removeClass("active");
												$("#holiday_list4").addClass("inactive");//Holiday List
												$("#holiday_list4").removeClass("active"); //Holiday List
												$("#notification_list4").removeClass("active");
												$("#notification_list4").addClass("inactive"); //Notification List
												$("#share_materials_list4").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list4").addClass("inactive");
												$("#staff_attendence_list4").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list4").addClass("inactive");  
												$("#group_list4").removeClass("active"); //Group Listings
												$("#group_list4").addClass("inactive");
												$("#attendance_view4").removeClass("active");
												$("#attendance_view4").addClass("inactive");   //Attendance
												$("#timetable_list4").removeClass("active");
												$("#timetable_list4").addClass("inactive");  // Timetable
												$("#exam_mark_list4").removeClass("active");
												$("#exam_mark_list4").addClass("inactive");   //Exam and Mark
										
										  
										}
										else if(data=="non_teaching_list")
										{ 
												$("#non_teaching_list4").removeClass("inactive");// non_teaching_list
												$("#non_teaching_list4").addClass("active"); //Non-Teaching Staff Listing
												$("#marks_list4").removeClass("active");
												$("#marks_list4").addClass("inactive");   //Exam and Mark
												$("#ind_student4").removeClass("active");
												$("#ind_student4").addClass("inactive");
												$("#teacher_list4").removeClass("active");
												$("#teacher_list4").addClass("inactive");   //Teacher
												$("#fees_listing_page4").addClass("inactive");  //Fees Listing
												$("#fees_listing_page4").removeClass("active"); //Fees Listing
											  
												$("#holiday_list4").addClass("inactive");//Holiday List
												$("#holiday_list4").removeClass("active"); //Holiday List
												$("#notification_list4").removeClass("active");
												$("#notification_list4").addClass("inactive"); //Notification List
												$("#share_materials_list4").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list4").addClass("inactive");
												$("#staff_attendence_list4").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list4").addClass("inactive");  
												$("#group_list4").removeClass("active"); //Group Listings
												$("#group_list4").addClass("inactive");
												$("#attendance_view4").removeClass("active");
												$("#attendance_view4").addClass("inactive");   //Attendance
												$("#timetable_list4").removeClass("active");
												$("#timetable_list4").addClass("inactive");  // Timetable
												$("#exam_mark_list4").removeClass("active");
												$("#exam_mark_list4").addClass("inactive");   //Exam and Mark
										}
										else if(data=="fees_listing_page")
										{
												$("#fees_listing_page4").addClass("active");  //Fees Listing
												$("#fees_listing_page4").removeClass("inactive"); //Fees Listing
											$("#marks_list4").removeClass("active");
												$("#marks_list4").addClass("inactive");   //Exam and Mark
												$("#teacher_list4").removeClass("active");
												$("#teacher_list4").addClass("inactive");   //Teacher
												$("#ind_student4").removeClass("active");
												$("#ind_student4").addClass("inactive");
												
												$("#non_teaching_list4").removeClass("active");// non_teaching_list
												$("#non_teaching_list4").addClass("inactive"); //Non-Teaching Staff Listing	
											  
												$("#holiday_list4").addClass("inactive");//Holiday List
												$("#holiday_list4").removeClass("active"); //Holiday List
												$("#notification_list4").removeClass("active");
												$("#notification_list4").addClass("inactive"); //Notification List
												$("#share_materials_list4").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list4").addClass("inactive");
												$("#staff_attendence_list4").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list4").addClass("inactive");  
												$("#group_list4").removeClass("active"); //Group Listings
												$("#group_list4").addClass("inactive");
												$("#attendance_view4").removeClass("active");
												$("#attendance_view4").addClass("inactive");   //Attendance
												$("#timetable_list4").removeClass("active");
												$("#timetable_list4").addClass("inactive");  // Timetable
												$("#exam_mark_list4").removeClass("active");
												$("#exam_mark_list4").addClass("inactive");   //Exam and Mark
										}
										else if(data=="holiday_list")
										{
												$("#holiday_list4").addClass("active"); //Holiday List
												$("#holiday_list4").removeClass("inactive"); //Holiday List
												$("#marks_list4").removeClass("active");
												$("#marks_list4").addClass("inactive");   //Exam and Mark
												$("#fees_listing_page4").removeClass("active"); //Fees Listing
												$("#fees_listing_page4").addClass("inactive");  //Fees Listing
												$("#teacher_list4").removeClass("active");
												$("#teacher_list4").addClass("inactive");   //Teacher
												$("#ind_student4").removeClass("active");
												$("#ind_student4").addClass("inactive");
												$("#non_teaching_list4").removeClass("active");// non_teaching_list
												$("#non_teaching_list4").addClass("inactive"); //Non-Teaching Staff Listing	                        			
												$("#notification_list4").removeClass("active");
												$("#notification_list4").addClass("inactive"); //Notification List
												$("#share_materials_list4").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list4").addClass("inactive");
												$("#staff_attendence_list4").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list4").addClass("inactive");  
												$("#group_list4").removeClass("active"); //Group Listings
												$("#group_list4").addClass("inactive");
												$("#attendance_view4").removeClass("active");
												$("#attendance_view4").addClass("inactive");   //Attendance
												$("#timetable_list4").removeClass("active");
												$("#timetable_list4").addClass("inactive");  // Timetable
												$("#exam_mark_list4").removeClass("active");
												$("#exam_mark_list4").addClass("inactive");   //Exam and Mark
										}
										else if(data=="notification_list")
										{
												$("#notification_list4").addClass("active"); //Notification List
												$("#notification_list4").removeClass("inactive");	
												$("#marks_list4").removeClass("active");
												$("#marks_list4").addClass("inactive");   //Exam and Mark							
												$("#holiday_list4").addClass("inactive"); //Holiday List
												$("#holiday_list4").removeClass("active"); //Holiday List
												$("#teacher_list4").removeClass("active");
												$("#teacher_list4").addClass("inactive");   //Teacher
												$("#fees_listing_page4").removeClass("active"); //Fees Listing
												$("#fees_listing_page4").addClass("inactive");  //Fees Listing
												$("#ind_student4").removeClass("active");
												$("#ind_student4").addClass("inactive");
												$("#non_teaching_list4").removeClass("active");// non_teaching_list
												$("#non_teaching_list4").addClass("inactive"); //Non-Teaching Staff Listing
												$("#share_materials_list4").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list4").addClass("inactive");
												$("#staff_attendence_list4").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list4").addClass("inactive");  
												$("#group_list4").removeClass("active"); //Group Listings
												$("#group_list4").addClass("inactive");
												$("#attendance_view4").removeClass("active");
												$("#attendance_view4").addClass("inactive");   //Attendance
												$("#timetable_list4").removeClass("active");
												$("#timetable_list4").addClass("inactive");  // Timetable
												$("#exam_mark_list4").removeClass("active");
												$("#exam_mark_list4").addClass("inactive");   //Exam and Mark
										}
										else if(data=="share_materials_list")
										{
												$("#share_materials_list4").removeClass("inactive");  //Study Materials Uploaded
												$("#share_materials_list4").addClass("active");
												$("#marks_list4").removeClass("active");
												$("#marks_list4").addClass("inactive");   //Exam and Mark
												$("#teacher_list4").removeClass("active");
												$("#teacher_list4").addClass("inactive");   //Teacher
												$("#notification_list4").addClass("inactive"); //Notification List
												$("#notification_list4").removeClass("active");								
												$("#holiday_list4").addClass("inactive"); //Holiday List
												$("#holiday_list4").removeClass("active"); //Holiday List
												$("#fees_listing_page4").removeClass("active"); //Fees Listing
												$("#fees_listing_page4").addClass("inactive");  //Fees Listing
												$("#ind_student4").removeClass("active");
												$("#ind_student4").addClass("inactive");
												$("#non_teaching_list4").removeClass("active");// non_teaching_list
												$("#non_teaching_list4").addClass("inactive"); //Non-Teaching Staff Listing
												$("#staff_attendence_list4").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list4").addClass("inactive");  
												$("#group_list4").removeClass("active"); //Group Listings
												$("#group_list4").addClass("inactive");
												$("#attendance_view4").removeClass("active");
												$("#attendance_view4").addClass("inactive");   //Attendance
												$("#timetable_list4").removeClass("active");
												$("#timetable_list4").addClass("inactive");  // Timetable
												$("#exam_mark_list4").removeClass("active");
												$("#exam_mark_list4").addClass("inactive");   //Exam and Mark
										}
										else if(data=="staff_attendence_list")
										{
												$("#staff_attendence_list4").removeClass("inactive");   // Staff Attendance
												$("#staff_attendence_list4").addClass("active");  
												$("#share_materials_list4").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list4").addClass("inactive");
												$("#marks_list4").removeClass("active");
												$("#marks_list4").addClass("inactive");   //Exam and Mark
												$("#teacher_list4").removeClass("active");
												$("#teacher_list4").addClass("inactive");   //Teacher
												$("#notification_list4").addClass("inactive"); //Notification List
												$("#notification_list4").removeClass("active");								
												$("#holiday_list4").addClass("inactive"); //Holiday List
												$("#holiday_list4").removeClass("active"); //Holiday List
												$("#fees_listing_page4").removeClass("active"); //Fees Listing
												$("#fees_listing_page4").addClass("inactive");  //Fees Listing
												$("#ind_student4").removeClass("active");
												$("#ind_student4").addClass("inactive");
												$("#non_teaching_list4").removeClass("active");// non_teaching_list
												$("#non_teaching_list4").addClass("inactive"); //Non-Teaching Staff Listing
												$("#group_list4").removeClass("active"); //Group Listings
												$("#group_list4").addClass("inactive");
												$("#attendance_view4").removeClass("active");
												$("#attendance_view4").addClass("inactive");   //Attendance
												$("#timetable_list4").removeClass("active");
												$("#timetable_list4").addClass("inactive");  // Timetable
												$("#exam_mark_list4").removeClass("active");
												$("#exam_mark_list4").addClass("inactive");   //Exam and Mark
										}
										else if(data=="group_list")
										{
												$("#group_list4").removeClass("inactive"); //Group Listings
												$("#group_list4").addClass("active");
												$("#marks_list4").removeClass("active");
												$("#marks_list4").addClass("inactive");   //Exam and Mark
												$("#teacher_list4").removeClass("active");
												$("#teacher_list4").addClass("inactive");   //Teacher
												$("#staff_attendence_list4").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list4").addClass("inactive");  
												$("#share_materials_list4").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list4").addClass("inactive");
												$("#notification_list4").addClass("inactive"); //Notification List
												$("#notification_list4").removeClass("active");								
												$("#holiday_list4").addClass("inactive"); //Holiday List
												$("#holiday_list4").removeClass("active"); //Holiday List
												$("#fees_listing_page4").removeClass("active"); //Fees Listing
												$("#fees_listing_page4").addClass("inactive");  //Fees Listing
												$("#ind_student4").removeClass("active");
												$("#ind_student4").addClass("inactive");
												$("#non_teaching_list4").removeClass("active");// non_teaching_list
												$("#non_teaching_list4").addClass("inactive"); //Non-Teaching Staff Listing
												
												$("#attendance_view4").removeClass("active");
												$("#attendance_view4").addClass("inactive");   //Attendance
												$("#timetable_list4").removeClass("active");
												$("#timetable_list4").addClass("inactive");  // Timetable
												$("#exam_mark_list4").removeClass("active");
												$("#exam_mark_list4").addClass("inactive");   //Exam and Mark
										}
										else if(data=="attendance_view")
										{
												$("#attendance_view4").removeClass("inactive");
												$("#attendance_view4").addClass("active");   //Attendance
												$("#marks_list4").removeClass("active");
												$("#marks_list4").addClass("inactive");   //Exam and Mark
												$("#teacher_list4").removeClass("active");
												$("#teacher_list4").addClass("inactive");   //Teacher
												$("#group_list4").removeClass("active"); //Group Listings
												$("#group_list4").addClass("inactive");
												$("#staff_attendence_list4").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list4").addClass("inactive");  
												$("#share_materials_list4").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list4").addClass("inactive");
												$("#notification_list4").addClass("inactive"); //Notification List
												$("#notification_list4").removeClass("active");								
												$("#holiday_list4").addClass("inactive"); //Holiday List
												$("#holiday_list4").removeClass("active"); //Holiday List
												$("#fees_listing_page4").removeClass("active"); //Fees Listing
												$("#fees_listing_page4").addClass("inactive");  //Fees Listing
												$("#ind_student4").removeClass("active");
												$("#ind_student4").addClass("inactive");
												$("#non_teaching_list4").removeClass("active");// non_teaching_list
												$("#non_teaching_list4").addClass("inactive"); //Non-Teaching Staff Listing
												$("#timetable_list4").removeClass("active");
												$("#timetable_list4").addClass("inactive");  // Timetable
												$("#exam_mark_list4").removeClass("active");
												$("#exam_mark_list4").addClass("inactive");   //Exam and Mark
										}
										else if(data=="timetable_list")
										{
												$("#timetable_list4").removeClass("inactive");
												$("#timetable_list4").addClass("active");  // Timetable
												$("#marks_list4").removeClass("active");
												$("#marks_list4").addClass("inactive");   //Exam and Mark
												$("#teacher_list4").removeClass("active");
												$("#teacher_list4").addClass("inactive");   //Teacher
												$("#attendance_view4").removeClass("active");
												$("#attendance_view4").addClass("inactive");   //Attendance
												$("#group_list4").removeClass("active"); //Group Listings
												$("#group_list4").addClass("inactive");
												$("#staff_attendence_list4").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list4").addClass("inactive");  
												$("#share_materials_list4").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list4").addClass("inactive");
												$("#notification_list4").addClass("inactive"); //Notification List
												$("#notification_list4").removeClass("active");								
												$("#holiday_list4").addClass("inactive"); //Holiday List
												$("#holiday_list4").removeClass("active"); //Holiday List
												$("#fees_listing_page4").removeClass("active"); //Fees Listing
												$("#fees_listing_page4").addClass("inactive");  //Fees Listing
												$("#ind_student4").removeClass("active");
												$("#ind_student4").addClass("inactive");
												$("#non_teaching_list4").removeClass("active");// non_teaching_list
												$("#non_teaching_list4").addClass("inactive"); //Non-Teaching Staff Listing
												$("#exam_mark_list4").removeClass("active");
												$("#exam_mark_list4").addClass("inactive");   //Exam and Mark
										}
										else if(data=="exam_mark_list")
										{
												$("#exam_mark_list4").removeClass("inactive");
												$("#exam_mark_list4").addClass("active");   //Exam and Mark
												$("#marks_list4").removeClass("active");
												$("#marks_list4").addClass("inactive");   //Exam and Mark
												$("#teacher_list4").removeClass("active");
												$("#teacher_list4").addClass("inactive");   //Teacher
												$("#timetable_list4").removeClass("active");
												$("#timetable_list4").addClass("inactive");  // Timetable
												$("#attendance_view4").removeClass("active");
												$("#attendance_view4").addClass("inactive");   //Attendance
												$("#group_list4").removeClass("active"); //Group Listings
												$("#group_list4").addClass("inactive");
												$("#staff_attendence_list4").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list4").addClass("inactive");  
												$("#share_materials_list4").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list4").addClass("inactive");
												$("#notification_list4").addClass("inactive"); //Notification List
												$("#notification_list4").removeClass("active");								
												$("#holiday_list4").addClass("inactive"); //Holiday List
												$("#holiday_list4").removeClass("active"); //Holiday List
												$("#fees_listing_page4").removeClass("active"); //Fees Listing
												$("#fees_listing_page4").addClass("inactive");  //Fees Listing
												$("#ind_student4").removeClass("active");
												$("#ind_student4").addClass("inactive");
												$("#non_teaching_list4").removeClass("active");// non_teaching_list
												$("#non_teaching_list4").addClass("inactive"); //Non-Teaching Staff Listing
												
										}
										else if(data=="teacher_list")
										{
												$("#teacher_list4").removeClass("inactive");
												$("#teacher_list4").addClass("active");   //Exam and Mark
												$("#marks_list4").removeClass("active");
												$("#marks_list4").addClass("inactive");   //Exam and Mark
												$("#exam_mark_list4").removeClass("active");
												$("#exam_mark_list4").addClass("inactive");   //Exam and Mark
												$("#timetable_list4").removeClass("active");
												$("#timetable_list4").addClass("inactive");  // Timetable
												$("#attendance_view4").removeClass("active");
												$("#attendance_view4").addClass("inactive");   //Attendance
												$("#group_list4").removeClass("active"); //Group Listings
												$("#group_list4").addClass("inactive");
												$("#staff_attendence_list4").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list4").addClass("inactive");  
												$("#share_materials_list4").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list4").addClass("inactive");
												$("#notification_list4").addClass("inactive"); //Notification List
												$("#notification_list4").removeClass("active");								
												$("#holiday_list4").addClass("inactive"); //Holiday List
												$("#holiday_list4").removeClass("active"); //Holiday List
												$("#fees_listing_page4").removeClass("active"); //Fees Listing
												$("#fees_listing_page4").addClass("inactive");  //Fees Listing
												$("#ind_student4").removeClass("active");
												$("#ind_student4").addClass("inactive");
												$("#non_teaching_list4").removeClass("active");// non_teaching_list
												$("#non_teaching_list4").addClass("inactive"); //Non-Teaching Staff Listing
												
										}
										else if(data=="marks_list")
										{
											$("#marks_list4").removeClass("inactive");
												$("#marks_list4").addClass("active");   //Exam and Mark
												$("#teacher_list4").removeClass("active");
												$("#teacher_list4").addClass("inactive");   //Exam and Mark
												$("#exam_mark_list4").removeClass("active");
												$("#exam_mark_list4").addClass("inactive");   //Exam and Mark
												$("#timetable_list4").removeClass("active");
												$("#timetable_list4").addClass("inactive");  // Timetable
												$("#attendance_view4").removeClass("active");
												$("#attendance_view4").addClass("inactive");   //Attendance
												$("#group_list4").removeClass("active"); //Group Listings
												$("#group_list4").addClass("inactive");
												$("#staff_attendence_list4").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list4").addClass("inactive");  
												$("#share_materials_list4").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list4").addClass("inactive");
												$("#notification_list4").addClass("inactive"); //Notification List
												$("#notification_list4").removeClass("active");								
												$("#holiday_list4").addClass("inactive"); //Holiday List
												$("#holiday_list4").removeClass("active"); //Holiday List
												$("#fees_listing_page4").removeClass("active"); //Fees Listing
												$("#fees_listing_page4").addClass("inactive");  //Fees Listing
												$("#ind_student4").removeClass("active");
												$("#ind_student4").addClass("inactive");
												$("#non_teaching_list4").removeClass("active");// non_teaching_list
												$("#non_teaching_list4").addClass("inactive"); //Non-Teaching Staff Listing
												
										}
									}
								});
									
							}
						}
					});
				}
				//$("#report_list4").val("");
				
		 });
		     /*     Report Four end */
		 
		 /* Report five start */
		  $("#report_list5").change(function () {
				var repost_list5 = $("#report_list5").val();
				var new_report5 = repost_list5;
				//alert(repost_list2);
				if(repost_list5!='')
				{
					$.ajax({
						type:"POST",
						url:"<?php echo base_url();?>index.php?admin/checkreport/"+repost_list5,
						success:function(success)
						{
							if(success=="0")		
							{
								alert("This Report already added in shortcut!");	
								 $("#report_list5").val("");	
								return false;
							}
							else
							{
								if(new_report5=='ind_student')
								{
									var report5 = "Individual Student Report Report";
								}
								else if(new_report5=="non_teaching_list")
								{
									var report5 = "Non-Teaching Staff Listing Report";
								}
								else if(new_report5=="fees_listing_page")
								{
									var report5 = "Fees Listing Report";
								}
								else if(new_report5=="holiday_list")
								{
									var report5 = "Holiday List Report";
								}
								else if(new_report5=="notification_list")
								{
									var report5 = "Notification List Report";
								}
								else if(new_report5=="share_materials_list")
								{
									var report5 = "Study Materials Uploaded Report";
								}
								else if(new_report5=="staff_attendence_list")
								{
									var report5 = "Staff Attendance Report";
								}
								else if(new_report5=="teacher_list")
								{
									var report5 = "Teacher List Report";
								}
								else if(new_report5=="group_list")
								{
									var report5 = "Group Listings Report";
								}
								else if(new_report5=="attendance_view")
								{
									var report5 = "Attendance Report";
								}
								else if(new_report5=="timetable_list")
								{
									var report5 = "Timetable Report";
								}
								else if(new_report5=="exam_mark_list")
								{
									var report5 = "Exams Report";
								}
								else if(new_report5=="marks_list")
								{
									var report5 = "Marks Report";
								}
								
								var r = confirm("Do You Want To Save "+report5+"?");
								
								 
								if (r == true) {
									
								} else {
									$("#report_list5").val("");	
								   return false;
								}
								
								$.ajax({
									type:"POST",
									url:"<?php echo base_url();?>index.php?admin/save_data/"+repost_list5+"/5",
									success:function(data)
									{
										$("#shortcut5").addClass("inactive");
										$("#shortcut5").removeClass("active");
										$("#report_list5").addClass("inactive");
										$("#report_maindiv5").addClass("inactive");
										$("#report_list5").removeClass("active");
										$("#report_maindiv5").removeClass("active");
										//alert(data);
										//$("#saved_item1").append(data);
										//alert(report_list);
											if(data=="ind_student")
											{
												
												$("#ind_student5").removeClass("inactive");
												$("#ind_student5").addClass("active");
												$("#marks_list5").removeClass("active");
												$("#marks_list5").addClass("inactive");   //Exam and Mark
												$("#teacher_list5").removeClass("active");
												$("#teacher_list5").addClass("inactive");   //Teacher
												$("#non_teaching_list5").addClass("inactive");
												$("#non_teaching_list5").removeClass("active");
												$("#fees_listing_page5").addClass("inactive");
												$("#fees_listing_page5").removeClass("active");
												$("#holiday_list5").addClass("inactive");//Holiday List
												$("#holiday_list5").removeClass("active"); //Holiday List
												$("#notification_list5").removeClass("active");
												$("#notification_list5").addClass("inactive"); //Notification List
												$("#share_materials_list5").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list5").addClass("inactive");
												$("#staff_attendence_list5").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list5").addClass("inactive");  
												$("#group_list5").removeClass("active"); //Group Listings
												$("#group_list5").addClass("inactive");
												$("#attendance_view5").removeClass("active");
												$("#attendance_view5").addClass("inactive");   //Attendance
												$("#timetable_list5").removeClass("active");
												$("#timetable_list5").addClass("inactive");  // Timetable
												$("#exam_mark_list5").removeClass("active");
												$("#exam_mark_list5").addClass("inactive");   //Exam and Mark
										
										  
										}
										else if(data=="non_teaching_list")
										{ 
												$("#non_teaching_list5").removeClass("inactive");// non_teaching_list
												$("#non_teaching_list5").addClass("active"); //Non-Teaching Staff Listing
												$("#marks_list5").removeClass("active");
												$("#marks_list5").addClass("inactive");   //Exam and Mark
												$("#ind_student5").removeClass("active");
												$("#ind_student5").addClass("inactive");
												$("#teacher_list5").removeClass("active");
												$("#teacher_list5").addClass("inactive");   //Teacher
												
												$("#fees_listing_page5").addClass("inactive");  //Fees Listing
												$("#fees_listing_page5").removeClass("active"); //Fees Listing
											  
												$("#holiday_list5").addClass("inactive");//Holiday List
												$("#holiday_list5").removeClass("active"); //Holiday List
												$("#notification_list5").removeClass("active");
												$("#notification_list5").addClass("inactive"); //Notification List
												$("#share_materials_list5").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list5").addClass("inactive");
												$("#staff_attendence_list5").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list5").addClass("inactive");  
												$("#group_list5").removeClass("active"); //Group Listings
												$("#group_list5").addClass("inactive");
												$("#attendance_view5").removeClass("active");
												$("#attendance_view5").addClass("inactive");   //Attendance
												$("#timetable_list5").removeClass("active");
												$("#timetable_list5").addClass("inactive");  // Timetable
												$("#exam_mark_list5").removeClass("active");
												$("#exam_mark_list5").addClass("inactive");   //Exam and Mark
										}
										else if(data=="fees_listing_page")
										{
												$("#fees_listing_page5").addClass("active");  //Fees Listing
												$("#fees_listing_page5").removeClass("inactive"); //Fees Listing
											$("#marks_list5").removeClass("active");
												$("#marks_list5").addClass("inactive");   //Exam and Mark
												
												$("#ind_student5").removeClass("active");
												$("#ind_student5").addClass("inactive");
												$("#teacher_list5").removeClass("active");
												$("#teacher_list5").addClass("inactive");   //Teacher
												
												$("#non_teaching_list5").removeClass("active");// non_teaching_list
												$("#non_teaching_list5").addClass("inactive"); //Non-Teaching Staff Listing	
											  
												$("#holiday_list5").addClass("inactive");//Holiday List
												$("#holiday_list5").removeClass("active"); //Holiday List
												$("#notification_list5").removeClass("active");
												$("#notification_list5").addClass("inactive"); //Notification List
												$("#share_materials_list5").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list5").addClass("inactive");
												$("#staff_attendence_list5").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list5").addClass("inactive");  
												$("#group_list5").removeClass("active"); //Group Listings
												$("#group_list5").addClass("inactive");
												$("#attendance_view5").removeClass("active");
												$("#attendance_view5").addClass("inactive");   //Attendance
												$("#timetable_list5").removeClass("active");
												$("#timetable_list5").addClass("inactive");  // Timetable
												$("#exam_mark_list5").removeClass("active");
												$("#exam_mark_list5").addClass("inactive");   //Exam and Mark
										}
										else if(data=="holiday_list")
										{
												$("#holiday_list5").addClass("active"); //Holiday List
												$("#holiday_list5").removeClass("inactive"); //Holiday List
												$("#marks_list5").removeClass("active");
												$("#marks_list5").addClass("inactive");   //Exam and Mark
												$("#fees_listing_page5").removeClass("active"); //Fees Listing
												$("#fees_listing_page5").addClass("inactive");  //Fees Listing
												$("#ind_student5").removeClass("active");
												$("#ind_student5").addClass("inactive");
												$("#teacher_list5").removeClass("active");
												$("#teacher_list5").addClass("inactive");   //Teacher
												$("#non_teaching_list5").removeClass("active");// non_teaching_list
												$("#non_teaching_list5").addClass("inactive"); //Non-Teaching Staff Listing	                        			
												$("#notification_list5").removeClass("active");
												$("#notification_list5").addClass("inactive"); //Notification List
												$("#share_materials_list5").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list5").addClass("inactive");
												$("#staff_attendence_list5").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list5").addClass("inactive");  
												$("#group_list5").removeClass("active"); //Group Listings
												$("#group_list5").addClass("inactive");
												$("#attendance_view5").removeClass("active");
												$("#attendance_view5").addClass("inactive");   //Attendance
												$("#timetable_list5").removeClass("active");
												$("#timetable_list5").addClass("inactive");  // Timetable
												$("#exam_mark_list5").removeClass("active");
												$("#exam_mark_list5").addClass("inactive");   //Exam and Mark
										}
										else if(data=="notification_list")
										{
												$("#notification_list5").addClass("active"); //Notification List
												$("#notification_list5").removeClass("inactive");		
												$("#marks_list5").removeClass("active");
												$("#marks_list5").addClass("inactive");   //Exam and Mark						
												$("#holiday_list5").addClass("inactive"); //Holiday List
												$("#holiday_list5").removeClass("active"); //Holiday List
												$("#teacher_list5").removeClass("active");
												$("#teacher_list5").addClass("inactive");   //Teacher
												$("#fees_listing_page5").removeClass("active"); //Fees Listing
												$("#fees_listing_page5").addClass("inactive");  //Fees Listing
												$("#ind_student5").removeClass("active");
												$("#ind_student5").addClass("inactive");
												$("#non_teaching_list5").removeClass("active");// non_teaching_list
												$("#non_teaching_list5").addClass("inactive"); //Non-Teaching Staff Listing
												$("#share_materials_list5").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list5").addClass("inactive");
												$("#staff_attendence_list5").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list5").addClass("inactive");  
												$("#group_list5").removeClass("active"); //Group Listings
												$("#group_list5").addClass("inactive");
												$("#attendance_view5").removeClass("active");
												$("#attendance_view5").addClass("inactive");   //Attendance
												$("#timetable_list5").removeClass("active");
												$("#timetable_list5").addClass("inactive");  // Timetable
												$("#exam_mark_list5").removeClass("active");
												$("#exam_mark_list5").addClass("inactive");   //Exam and Mark
										}
										else if(data=="share_materials_list")
										{
												$("#share_materials_list5").removeClass("inactive");  //Study Materials Uploaded
												$("#share_materials_list5").addClass("active");
												$("#marks_list5").removeClass("active");
												$("#marks_list5").addClass("inactive");   //Exam and Mark
												$("#teacher_list5").removeClass("active");
												$("#teacher_list5").addClass("inactive");   //Teacher
												$("#notification_list5").addClass("inactive"); //Notification List
												$("#notification_list5").removeClass("active");								
												$("#holiday_list5").addClass("inactive"); //Holiday List
												$("#holiday_list5").removeClass("active"); //Holiday List
												$("#fees_listing_page5").removeClass("active"); //Fees Listing
												$("#fees_listing_page5").addClass("inactive");  //Fees Listing
												$("#ind_student5").removeClass("active");
												$("#ind_student5").addClass("inactive");
												$("#non_teaching_list5").removeClass("active");// non_teaching_list
												$("#non_teaching_list5").addClass("inactive"); //Non-Teaching Staff Listing
												$("#staff_attendence_list5").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list5").addClass("inactive");  
												$("#group_list5").removeClass("active"); //Group Listings
												$("#group_list5").addClass("inactive");
												$("#attendance_view5").removeClass("active");
												$("#attendance_view5").addClass("inactive");   //Attendance
												$("#timetable_list5").removeClass("active");
												$("#timetable_list5").addClass("inactive");  // Timetable
												$("#exam_mark_list5").removeClass("active");
												$("#exam_mark_list5").addClass("inactive");   //Exam and Mark
										}
										else if(data=="staff_attendence_list")
										{
												$("#staff_attendence_list5").removeClass("inactive");   // Staff Attendance
												$("#staff_attendence_list5").addClass("active");  
												$("#marks_list5").removeClass("active");
												$("#marks_list5").addClass("inactive");   //Exam and Mark
												$("#share_materials_list5").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list5").addClass("inactive");
												$("#notification_list5").addClass("inactive"); //Notification List
												
												$("#notification_list5").removeClass("active");	
												$("#teacher_list5").removeClass("active");
												$("#teacher_list5").addClass("inactive");   //Teacher							
												$("#holiday_list5").addClass("inactive"); //Holiday List
												$("#holiday_list5").removeClass("active"); //Holiday List
												$("#fees_listing_page5").removeClass("active"); //Fees Listing
												$("#fees_listing_page5").addClass("inactive");  //Fees Listing
												$("#ind_student5").removeClass("active");
												$("#ind_student5").addClass("inactive");
												$("#non_teaching_list5").removeClass("active");// non_teaching_list
												$("#non_teaching_list5").addClass("inactive"); //Non-Teaching Staff Listing
												$("#group_list5").removeClass("active"); //Group Listings
												$("#group_list5").addClass("inactive");
												$("#attendance_view5").removeClass("active");
												$("#attendance_view5").addClass("inactive");   //Attendance
												$("#timetable_list5").removeClass("active");
												$("#timetable_list5").addClass("inactive");  // Timetable
												$("#exam_mark_list5").removeClass("active");
												$("#exam_mark_list5").addClass("inactive");   //Exam and Mark
										}
										else if(data=="group_list")
										{
												$("#group_list5").removeClass("inactive"); //Group Listings
												$("#group_list5").addClass("active");
												$("#marks_list5").removeClass("active");
												$("#marks_list5").addClass("inactive");   //Exam and Mark
												$("#staff_attendence_list5").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list5").addClass("inactive");  
												$("#share_materials_list5").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list5").addClass("inactive");
												$("#notification_list5").addClass("inactive"); //Notification List
												$("#teacher_list5").removeClass("active");
												$("#teacher_list5").addClass("inactive");   //Teacher
												$("#notification_list5").removeClass("active");								
												$("#holiday_list5").addClass("inactive"); //Holiday List
												$("#holiday_list5").removeClass("active"); //Holiday List
												$("#fees_listing_page5").removeClass("active"); //Fees Listing
												$("#fees_listing_page5").addClass("inactive");  //Fees Listing
												$("#ind_student5").removeClass("active");
												$("#ind_student5").addClass("inactive");
												$("#non_teaching_list5").removeClass("active");// non_teaching_list
												$("#non_teaching_list5").addClass("inactive"); //Non-Teaching Staff Listing
												
												$("#attendance_view5").removeClass("active");
												$("#attendance_view5").addClass("inactive");   //Attendance
												$("#timetable_list5").removeClass("active");
												$("#timetable_list5").addClass("inactive");  // Timetable
												$("#exam_mark_list5").removeClass("active");
												$("#exam_mark_list5").addClass("inactive");   //Exam and Mark
										}
										else if(data=="attendance_view")
										{
												$("#attendance_view5").removeClass("inactive");
												$("#attendance_view5").addClass("active");   //Attendance
												$("#marks_list5").removeClass("active");
												$("#marks_list5").addClass("inactive");   //Exam and Mark
												$("#group_list5").removeClass("active"); //Group Listings
												$("#group_list5").addClass("inactive");
												$("#staff_attendence_list5").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list5").addClass("inactive");  
												$("#share_materials_list5").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list5").addClass("inactive");
												$("#teacher_list5").removeClass("active");
												$("#teacher_list5").addClass("inactive");   //Teacher
												$("#notification_list5").addClass("inactive"); //Notification List
												$("#notification_list5").removeClass("active");								
												$("#holiday_list5").addClass("inactive"); //Holiday List
												$("#holiday_list5").removeClass("active"); //Holiday List
												$("#fees_listing_page5").removeClass("active"); //Fees Listing
												$("#fees_listing_page5").addClass("inactive");  //Fees Listing
												$("#ind_student5").removeClass("active");
												$("#ind_student5").addClass("inactive");
												$("#non_teaching_list5").removeClass("active");// non_teaching_list
												$("#non_teaching_list5").addClass("inactive"); //Non-Teaching Staff Listing
												$("#timetable_list5").removeClass("active");
												$("#timetable_list5").addClass("inactive");  // Timetable
												$("#exam_mark_list5").removeClass("active");
												$("#exam_mark_list5").addClass("inactive");   //Exam and Mark
										}
										else if(data=="timetable_list")
										{
												$("#timetable_list5").removeClass("inactive");
												$("#timetable_list5").addClass("active");  // Timetable
												$("#marks_list5").removeClass("active");
												$("#marks_list5").addClass("inactive");   //Exam and Mark
												$("#attendance_view5").removeClass("active");
												$("#attendance_view5").addClass("inactive");   //Attendance
												$("#teacher_list5").removeClass("active");
												$("#teacher_list5").addClass("inactive");   //Teacher
												$("#group_list5").removeClass("active"); //Group Listings
												$("#group_list5").addClass("inactive");
												$("#staff_attendence_list5").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list5").addClass("inactive");  
												$("#share_materials_list5").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list5").addClass("inactive");
												$("#notification_list5").addClass("inactive"); //Notification List
												$("#notification_list5").removeClass("active");								
												$("#holiday_list5").addClass("inactive"); //Holiday List
												$("#holiday_list5").removeClass("active"); //Holiday List
												$("#fees_listing_page5").removeClass("active"); //Fees Listing
												$("#fees_listing_page5").addClass("inactive");  //Fees Listing
												$("#ind_student5").removeClass("active");
												$("#ind_student5").addClass("inactive");
												$("#non_teaching_list5").removeClass("active");// non_teaching_list
												$("#non_teaching_list5").addClass("inactive"); //Non-Teaching Staff Listing
												$("#exam_mark_list5").removeClass("active");
												$("#exam_mark_list5").addClass("inactive");   //Exam and Mark
										}
										else if(data=="exam_mark_list")
										{
												$("#teacher_list5").removeClass("active");
												$("#teacher_list5").addClass("inactive");   //Teacher
												$("#marks_list5").removeClass("active");
												$("#marks_list5").addClass("inactive");   //Exam and Mark
												$("#exam_mark_list5").removeClass("inactive");
												$("#exam_mark_list5").addClass("active");   //Exam and Mark
												$("#timetable_list5").removeClass("active");
												$("#timetable_list5").addClass("inactive");  // Timetable
												$("#attendance_view5").removeClass("active");
												$("#attendance_view5").addClass("inactive");   //Attendance
												$("#group_list5").removeClass("active"); //Group Listings
												$("#group_list5").addClass("inactive");
												$("#staff_attendence_list5").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list5").addClass("inactive");  
												$("#share_materials_list5").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list5").addClass("inactive");
												$("#notification_list5").addClass("inactive"); //Notification List
												$("#notification_list5").removeClass("active");								
												$("#holiday_list5").addClass("inactive"); //Holiday List
												$("#holiday_list5").removeClass("active"); //Holiday List
												$("#fees_listing_page5").removeClass("active"); //Fees Listing
												$("#fees_listing_page5").addClass("inactive");  //Fees Listing
												$("#ind_student5").removeClass("active");
												$("#ind_student5").addClass("inactive");
												$("#non_teaching_list5").removeClass("active");// non_teaching_list
												$("#non_teaching_list5").addClass("inactive"); //Non-Teaching Staff Listing
												
										}
										else if(data=="teacher_list")
										{
												$("#teacher_list5").removeClass("inactive");
												$("#teacher_list5").addClass("active");   //Teacher
												$("#marks_list5").removeClass("active");
												$("#marks_list5").addClass("inactive");   //Exam and Mark
												$("#exam_mark_list5").removeClass("active");
												$("#exam_mark_list5").addClass("inactive");   //Exam and Mark
												$("#timetable_list5").removeClass("active");
												$("#timetable_list5").addClass("inactive");  // Timetable
												$("#attendance_view5").removeClass("active");
												$("#attendance_view5").addClass("inactive");   //Attendance
												$("#group_list5").removeClass("active"); //Group Listings
												$("#group_list5").addClass("inactive");
												$("#staff_attendence_list5").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list5").addClass("inactive");  
												$("#share_materials_list5").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list5").addClass("inactive");
												$("#notification_list5").addClass("inactive"); //Notification List
												$("#notification_list5").removeClass("active");								
												$("#holiday_list5").addClass("inactive"); //Holiday List
												$("#holiday_list5").removeClass("active"); //Holiday List
												$("#fees_listing_page5").removeClass("active"); //Fees Listing
												$("#fees_listing_page5").addClass("inactive");  //Fees Listing
												$("#ind_student5").removeClass("active");
												$("#ind_student5").addClass("inactive");
												$("#non_teaching_list5").removeClass("active");// non_teaching_list
												$("#non_teaching_list5").addClass("inactive"); //Non-Teaching Staff Listing
												
										}else if(data=="marks_list")
										{
												$("#teacher_list5").removeClass("active");
												$("#teacher_list5").addClass("inactive");   //Teacher
												$("#marks_list5").removeClass("inactive");
												$("#marks_list5").addClass("active");   //Exam and Mark
												$("#exam_mark_list5").removeClass("active");
												$("#exam_mark_list5").addClass("inactive");   //Exam and Mark
												$("#timetable_list5").removeClass("active");
												$("#timetable_list5").addClass("inactive");  // Timetable
												$("#attendance_view5").removeClass("active");
												$("#attendance_view5").addClass("inactive");   //Attendance
												$("#group_list5").removeClass("active"); //Group Listings
												$("#group_list5").addClass("inactive");
												$("#staff_attendence_list5").removeClass("active");   // Staff Attendance
												$("#staff_attendence_list5").addClass("inactive");  
												$("#share_materials_list5").removeClass("active");  //Study Materials Uploaded
												$("#share_materials_list5").addClass("inactive");
												$("#notification_list5").addClass("inactive"); //Notification List
												$("#notification_list5").removeClass("active");								
												$("#holiday_list5").addClass("inactive"); //Holiday List
												$("#holiday_list5").removeClass("active"); //Holiday List
												$("#fees_listing_page5").removeClass("active"); //Fees Listing
												$("#fees_listing_page5").addClass("inactive");  //Fees Listing
												$("#ind_student5").removeClass("active");
												$("#ind_student5").addClass("inactive");
												$("#non_teaching_list5").removeClass("active");// non_teaching_list
												$("#non_teaching_list5").addClass("inactive"); //Non-Teaching Staff Listing
												
										}
									}
								});
									
							}
						}
					});
				}
				//$("#report_list5").val("");
				
		 });
		 /*    Report List five end     */
		  
		  
		   /* Report six start */
		   $("#report_list6").change(function () {
				var repost_list6 = $("#report_list6").val();
				var new_report6 = repost_list6;
				//alert(repost_list2);
				if(repost_list6!='')
				{
					$.ajax({
						type:"POST",
						url:"<?php echo base_url();?>index.php?admin/checkreport/"+repost_list6,
						success:function(success)
						{
							if(success=="0")		
							{
								alert("This Report already added in shortcut!");	
								$("#report_list6").val("");	
								return false;
							}
							else
							{
								if(new_report6=='ind_student')
								{
									var report6 = "Individual Student Report Report";
								}
								else if(new_report6=="non_teaching_list")
								{
									var report6 = "Non-Teaching Staff Listing Report";
								}
								else if(new_report6=="fees_listing_page")
								{
									var report6 = "Fees Listing Report";
								}
								else if(new_report6=="holiday_list")
								{
									var report6 = "Holiday List Report";
								}
								else if(new_report6=="notification_list")
								{
									var report6 = "Notification List Report";
								}
								else if(new_report6=="share_materials_list")
								{
									var report6 = "Study Materials Uploaded Report";
								}
								else if(new_report6=="staff_attendence_list")
								{
									var report6 = "Staff Attendance Report";
								}
								else if(new_report6=="teacher_list")
								{
									var report6 = "Teacher List Report";
								}
								else if(new_report6=="group_list")
								{
									var report6 = "Group Listings Report";
								}
								else if(new_report6=="attendance_view")
								{
									var report6 = "Attendance Report";
								}
								else if(new_report6=="timetable_list")
								{
									var report6 = "Timetable Report";
								}
								else if(new_report6=="exam_mark_list")
								{
									var report6 = "Exams Report";
								}
								else if(new_report6=="marks_list")
								{
									var report6 = "Marks Report";
								}
								
								var r = confirm("Do You Want To Save "+report6+"?");
								if (r == true) {
									
								} else {
									$("#report_list6").val("");	
								   return false;
								}
								
								$.ajax({
						type:"POST",
						url:"<?php echo base_url();?>index.php?admin/save_data/"+repost_list6+"/6",
						success:function(data)
						{
							$("#shortcut6").addClass("inactive");
							$("#shortcut6").removeClass("active");
							$("#report_list6").addClass("inactive");
							$("#report_maindiv6").addClass("inactive");
							$("#report_list6").removeClass("active");
							$("#report_maindiv6").removeClass("active");
							//alert(data);
							//$("#saved_item1").append(data);
							//alert(report_list);
								if(data=="ind_student")
								{
									
									$("#ind_student6").removeClass("inactive");
									$("#ind_student6").addClass("active");
									$("#marks_list6").removeClass("active");
									$("#marks_list6").addClass("inactive");
									
									$("#teacher_list6").removeClass("active");
									$("#teacher_list6").addClass("inactive");   //Exam and Mark
									$("#non_teaching_list6").addClass("inactive");
									$("#non_teaching_list6").removeClass("active");
									$("#fees_listing_page6").addClass("inactive");
                        		    $("#fees_listing_page6").removeClass("active");
									$("#holiday_list6").addClass("inactive");//Holiday List
									$("#holiday_list6").removeClass("active"); //Holiday List
									$("#notification_list6").removeClass("active");
									$("#notification_list6").addClass("inactive"); //Notification List
							 		$("#share_materials_list6").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list6").addClass("inactive");
							 		$("#staff_attendence_list6").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list6").addClass("inactive");  
							 		$("#group_list6").removeClass("active"); //Group Listings
									$("#group_list6").addClass("inactive");
									$("#attendance_view6").removeClass("active");
							 		$("#attendance_view6").addClass("inactive");   //Attendance
									$("#timetable_list6").removeClass("active");
							 		$("#timetable_list6").addClass("inactive");  // Timetable
							 		$("#exam_mark_list6").removeClass("active");
									$("#exam_mark_list6").addClass("inactive");   //Exam and Mark
                            
                              
							}
							else if(data=="non_teaching_list")
							{ 
									$("#non_teaching_list6").removeClass("inactive");// non_teaching_list
									$("#non_teaching_list6").addClass("active"); //Non-Teaching Staff Listing
									$("#marks_list6").removeClass("active");
									$("#marks_list6").addClass("inactive");
									$("#teacher_list6").removeClass("active");
									$("#teacher_list6").addClass("inactive");   //Exam and Mark
									$("#ind_student6").removeClass("active");
									$("#ind_student6").addClass("inactive");
									
									$("#fees_listing_page6").addClass("inactive");  //Fees Listing
                        		    $("#fees_listing_page6").removeClass("active"); //Fees Listing
                        		  
									$("#holiday_list6").addClass("inactive");//Holiday List
									$("#holiday_list6").removeClass("active"); //Holiday List
									$("#notification_list6").removeClass("active");
									$("#notification_list6").addClass("inactive"); //Notification List
							 		$("#share_materials_list6").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list6").addClass("inactive");
							 		$("#staff_attendence_list6").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list6").addClass("inactive");  
							 		$("#group_list6").removeClass("active"); //Group Listings
									$("#group_list6").addClass("inactive");
									$("#attendance_view6").removeClass("active");
							 		$("#attendance_view6").addClass("inactive");   //Attendance
									$("#timetable_list6").removeClass("active");
							 		$("#timetable_list6").addClass("inactive");  // Timetable
							 		$("#exam_mark_list6").removeClass("active");
									$("#exam_mark_list6").addClass("inactive");   //Exam and Mark
							}
							else if(data=="fees_listing_page")
							{
									$("#fees_listing_page6").addClass("active");  //Fees Listing
                        		    $("#fees_listing_page6").removeClass("inactive"); //Fees Listing
									$("#marks_list6").removeClass("active");
									$("#marks_list6").addClass("inactive");
								$("#teacher_list6").removeClass("active");
									$("#teacher_list6").addClass("inactive");   //Exam and Mark
									
									$("#ind_student6").removeClass("active");
									$("#ind_student6").addClass("inactive");
									
									$("#non_teaching_list6").removeClass("active");// non_teaching_list
									$("#non_teaching_list6").addClass("inactive"); //Non-Teaching Staff Listing	
                        		  
									$("#holiday_list6").addClass("inactive");//Holiday List
									$("#holiday_list6").removeClass("active"); //Holiday List
									$("#notification_list6").removeClass("active");
									$("#notification_list6").addClass("inactive"); //Notification List
							 		$("#share_materials_list6").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list6").addClass("inactive");
							 		$("#staff_attendence_list6").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list6").addClass("inactive");  
							 		$("#group_list6").removeClass("active"); //Group Listings
									$("#group_list6").addClass("inactive");
									$("#attendance_view6").removeClass("active");
							 		$("#attendance_view6").addClass("inactive");   //Attendance
									$("#timetable_list6").removeClass("active");
							 		$("#timetable_list6").addClass("inactive");  // Timetable
							 		$("#exam_mark_list6").removeClass("active");
									$("#exam_mark_list6").addClass("inactive");   //Exam and Mark
							}
							else if(data=="holiday_list")
							{
									$("#holiday_list6").addClass("active"); //Holiday List
									$("#holiday_list6").removeClass("inactive"); //Holiday List
									$("#marks_list6").removeClass("active");
									$("#marks_list6").addClass("inactive");
									$("#teacher_list6").removeClass("active");
									$("#teacher_list6").addClass("inactive");   //Exam and Mark
									$("#fees_listing_page6").removeClass("active"); //Fees Listing
									$("#fees_listing_page6").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student6").removeClass("active");
									$("#ind_student6").addClass("inactive");
									$("#non_teaching_list6").removeClass("active");// non_teaching_list
									$("#non_teaching_list6").addClass("inactive"); //Non-Teaching Staff Listing	                        			
									$("#notification_list6").removeClass("active");
									$("#notification_list6").addClass("inactive"); //Notification List
							 		$("#share_materials_list6").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list6").addClass("inactive");
							 		$("#staff_attendence_list6").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list6").addClass("inactive");  
							 		$("#group_list6").removeClass("active"); //Group Listings
									$("#group_list6").addClass("inactive");
									$("#attendance_view6").removeClass("active");
							 		$("#attendance_view6").addClass("inactive");   //Attendance
									$("#timetable_list6").removeClass("active");
							 		$("#timetable_list6").addClass("inactive");  // Timetable
							 		$("#exam_mark_list6").removeClass("active");
									$("#exam_mark_list6").addClass("inactive");   //Exam and Mark
							}
							else if(data=="notification_list")
							{
									$("#notification_list6").addClass("active"); //Notification List
									$("#notification_list6").removeClass("inactive");		
									$("#marks_list6").removeClass("active");
									$("#marks_list6").addClass("inactive");
									$("#teacher_list6").removeClass("active");
									$("#teacher_list6").addClass("inactive");   //Exam and Mark						
									$("#holiday_list6").addClass("inactive"); //Holiday List
									$("#holiday_list6").removeClass("active"); //Holiday List
									$("#fees_listing_page6").removeClass("active"); //Fees Listing
									$("#fees_listing_page6").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student6").removeClass("active");
									$("#ind_student6").addClass("inactive");
									$("#non_teaching_list6").removeClass("active");// non_teaching_list
									$("#non_teaching_list6").addClass("inactive"); //Non-Teaching Staff Listing
							 		$("#share_materials_list6").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list6").addClass("inactive");
							 		$("#staff_attendence_list6").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list6").addClass("inactive");  
							 		$("#group_list6").removeClass("active"); //Group Listings
									$("#group_list6").addClass("inactive");
									$("#attendance_view6").removeClass("active");
							 		$("#attendance_view6").addClass("inactive");   //Attendance
									$("#timetable_list6").removeClass("active");
							 		$("#timetable_list6").addClass("inactive");  // Timetable
							 		$("#exam_mark_list6").removeClass("active");
									$("#exam_mark_list6").addClass("inactive");   //Exam and Mark
							}
							else if(data=="share_materials_list")
							{
									$("#share_materials_list6").removeClass("inactive");  //Study Materials Uploaded
									$("#share_materials_list6").addClass("active");
									$("#marks_list6").removeClass("active");
									$("#marks_list6").addClass("inactive");
									$("#teacher_list6").removeClass("active");
									$("#teacher_list6").addClass("inactive");   //Exam and Mark
									$("#notification_list6").addClass("inactive"); //Notification List
									$("#notification_list6").removeClass("active");								
									$("#holiday_list6").addClass("inactive"); //Holiday List
									$("#holiday_list6").removeClass("active"); //Holiday List
									$("#fees_listing_page6").removeClass("active"); //Fees Listing
									$("#fees_listing_page6").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student6").removeClass("active");
									$("#ind_student6").addClass("inactive");
									$("#non_teaching_list6").removeClass("active");// non_teaching_list
									$("#non_teaching_list6").addClass("inactive"); //Non-Teaching Staff Listing
							 		$("#staff_attendence_list6").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list6").addClass("inactive");  
							 		$("#group_list6").removeClass("active"); //Group Listings
									$("#group_list6").addClass("inactive");
									$("#attendance_view6").removeClass("active");
							 		$("#attendance_view6").addClass("inactive");   //Attendance
									$("#timetable_list6").removeClass("active");
							 		$("#timetable_list6").addClass("inactive");  // Timetable
							 		$("#exam_mark_list6").removeClass("active");
									$("#exam_mark_list6").addClass("inactive");   //Exam and Mark
							}
							else if(data=="staff_attendence_list")
							{
									$("#staff_attendence_list6").removeClass("inactive");   // Staff Attendance
									$("#staff_attendence_list6").addClass("active"); 
									$("#marks_list6").removeClass("active");
									$("#marks_list6").addClass("inactive"); 
									$("#teacher_list6").removeClass("active");
									$("#teacher_list6").addClass("inactive");   //Exam and Mark
									$("#share_materials_list6").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list6").addClass("inactive");
									$("#notification_list6").addClass("inactive"); //Notification List
									$("#notification_list6").removeClass("active");								
									$("#holiday_list6").addClass("inactive"); //Holiday List
									$("#holiday_list6").removeClass("active"); //Holiday List
									$("#fees_listing_page6").removeClass("active"); //Fees Listing
									$("#fees_listing_page6").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student6").removeClass("active");
									$("#ind_student6").addClass("inactive");
									$("#non_teaching_list6").removeClass("active");// non_teaching_list
									$("#non_teaching_list6").addClass("inactive"); //Non-Teaching Staff Listing
							 		$("#group_list6").removeClass("active"); //Group Listings
									$("#group_list6").addClass("inactive");
									$("#attendance_view6").removeClass("active");
							 		$("#attendance_view6").addClass("inactive");   //Attendance
									$("#timetable_list6").removeClass("active");
							 		$("#timetable_list6").addClass("inactive");  // Timetable
							 		$("#exam_mark_list6").removeClass("active");
									$("#exam_mark_list6").addClass("inactive");   //Exam and Mark
							}
							else if(data=="group_list")
							{
									$("#group_list6").removeClass("inactive"); //Group Listings
									$("#group_list6").addClass("active");
									$("#marks_list6").removeClass("active");
									$("#marks_list6").addClass("inactive");
									$("#teacher_list6").removeClass("active");
									$("#teacher_list6").addClass("inactive");   //Exam and Mark
									$("#staff_attendence_list6").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list6").addClass("inactive");  
									$("#share_materials_list6").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list6").addClass("inactive");
									$("#notification_list6").addClass("inactive"); //Notification List
									$("#notification_list6").removeClass("active");								
									$("#holiday_list6").addClass("inactive"); //Holiday List
									$("#holiday_list6").removeClass("active"); //Holiday List
									$("#fees_listing_page6").removeClass("active"); //Fees Listing
									$("#fees_listing_page6").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student6").removeClass("active");
									$("#ind_student6").addClass("inactive");
									$("#non_teaching_list6").removeClass("active");// non_teaching_list
									$("#non_teaching_list6").addClass("inactive"); //Non-Teaching Staff Listing
							 		
									$("#attendance_view6").removeClass("active");
							 		$("#attendance_view6").addClass("inactive");   //Attendance
									$("#timetable_list6").removeClass("active");
							 		$("#timetable_list6").addClass("inactive");  // Timetable
							 		$("#exam_mark_list6").removeClass("active");
									$("#exam_mark_list6").addClass("inactive");   //Exam and Mark
							}
							else if(data=="attendance_view")
							{
									$("#attendance_view6").removeClass("inactive");
							 		$("#attendance_view6").addClass("active");   //Attendance
									$("#marks_list6").removeClass("active");
									$("#marks_list6").addClass("inactive");
									$("#teacher_list6").removeClass("active");
									$("#teacher_list6").addClass("inactive");   //Exam and Mark
									$("#group_list6").removeClass("active"); //Group Listings
									$("#group_list6").addClass("inactive");
									$("#staff_attendence_list6").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list6").addClass("inactive");  
									$("#share_materials_list6").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list6").addClass("inactive");
									$("#notification_list6").addClass("inactive"); //Notification List
									$("#notification_list6").removeClass("active");								
									$("#holiday_list6").addClass("inactive"); //Holiday List
									$("#holiday_list6").removeClass("active"); //Holiday List
									$("#fees_listing_page6").removeClass("active"); //Fees Listing
									$("#fees_listing_page6").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student6").removeClass("active");
									$("#ind_student6").addClass("inactive");
									$("#non_teaching_list6").removeClass("active");// non_teaching_list
									$("#non_teaching_list6").addClass("inactive"); //Non-Teaching Staff Listing
									$("#timetable_list6").removeClass("active");
							 		$("#timetable_list6").addClass("inactive");  // Timetable
							 		$("#exam_mark_list6").removeClass("active");
									$("#exam_mark_list6").addClass("inactive");   //Exam and Mark
							}
							else if(data=="timetable_list")
							{
									$("#timetable_list6").removeClass("inactive");
							 		$("#timetable_list6").addClass("active");  // Timetable
									$("#marks_list6").removeClass("active");
									$("#marks_list6").addClass("inactive");
									$("#teacher_list6").removeClass("active");
									$("#teacher_list6").addClass("inactive");   //Exam and Mark
									$("#attendance_view6").removeClass("active");
							 		$("#attendance_view6").addClass("inactive");   //Attendance
									$("#group_list6").removeClass("active"); //Group Listings
									$("#group_list6").addClass("inactive");
									$("#staff_attendence_list6").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list6").addClass("inactive");  
									$("#share_materials_list6").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list6").addClass("inactive");
									$("#notification_list6").addClass("inactive"); //Notification List
									$("#notification_list6").removeClass("active");								
									$("#holiday_list6").addClass("inactive"); //Holiday List
									$("#holiday_list6").removeClass("active"); //Holiday List
									$("#fees_listing_page6").removeClass("active"); //Fees Listing
									$("#fees_listing_page6").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student6").removeClass("active");
									$("#ind_student6").addClass("inactive");
									$("#non_teaching_list6").removeClass("active");// non_teaching_list
									$("#non_teaching_list6").addClass("inactive"); //Non-Teaching Staff Listing
							 		$("#exam_mark_list6").removeClass("active");
									$("#exam_mark_list6").addClass("inactive");   //Exam and Mark
							}
							else if(data=="exam_mark_list")
							{
									$("#exam_mark_list6").removeClass("inactive");
									$("#exam_mark_list6").addClass("active");   //Exam and Mark
									$("#marks_list6").removeClass("active");
									$("#marks_list6").addClass("inactive");
									$("#teacher_list6").removeClass("active");
									$("#teacher_list6").addClass("inactive");   //Exam and Mark
									$("#timetable_list6").removeClass("active");
							 		$("#timetable_list6").addClass("inactive");  // Timetable
									$("#attendance_view6").removeClass("active");
							 		$("#attendance_view6").addClass("inactive");   //Attendance
									$("#group_list6").removeClass("active"); //Group Listings
									$("#group_list6").addClass("inactive");
									$("#staff_attendence_list6").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list6").addClass("inactive");  
									$("#share_materials_list6").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list6").addClass("inactive");
									$("#notification_list6").addClass("inactive"); //Notification List
									$("#notification_list6").removeClass("active");								
									$("#holiday_list6").addClass("inactive"); //Holiday List
									$("#holiday_list6").removeClass("active"); //Holiday List
									$("#fees_listing_page6").removeClass("active"); //Fees Listing
									$("#fees_listing_page6").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student6").removeClass("active");
									$("#ind_student6").addClass("inactive");
									$("#non_teaching_list6").removeClass("active");// non_teaching_list
									$("#non_teaching_list6").addClass("inactive"); //Non-Teaching Staff Listing
							 		
							}
							else if(data=="teacher_list")
							{
									$("#teacher_list6").removeClass("inactive");
									$("#teacher_list6").addClass("active");   //Exam and Mark
									$("#marks_list6").removeClass("active");
									$("#marks_list6").addClass("inactive");   //Exam and Mark
									$("#exam_mark_list6").removeClass("active");
									$("#exam_mark_list6").addClass("inactive");   //Exam and Mark
									$("#timetable_list6").removeClass("active");
							 		$("#timetable_list6").addClass("inactive");  // Timetable
									$("#attendance_view6").removeClass("active");
							 		$("#attendance_view6").addClass("inactive");   //Attendance
									$("#group_list6").removeClass("active"); //Group Listings
									$("#group_list6").addClass("inactive");
									$("#staff_attendence_list6").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list6").addClass("inactive");  
									$("#share_materials_list6").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list6").addClass("inactive");
									$("#notification_list6").addClass("inactive"); //Notification List
									$("#notification_list6").removeClass("active");								
									$("#holiday_list6").addClass("inactive"); //Holiday List
									$("#holiday_list6").removeClass("active"); //Holiday List
									$("#fees_listing_page6").removeClass("active"); //Fees Listing
									$("#fees_listing_page6").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student6").removeClass("active");
									$("#ind_student6").addClass("inactive");
									$("#non_teaching_list6").removeClass("active");// non_teaching_list
									$("#non_teaching_list6").addClass("inactive"); //Non-Teaching Staff Listing
							 		
							}
							else if(data=="marks_list")
							{
									$("#teacher_list6").removeClass("active");
									$("#teacher_list6").addClass("inactive");   //Exam and Mark
									$("#marks_list6").removeClass("inactive");
									$("#marks_list6").addClass("active");   //Exam and Mark
									$("#exam_mark_list6").removeClass("active");
									$("#exam_mark_list6").addClass("inactive");   //Exam and Mark
									$("#timetable_list6").removeClass("active");
							 		$("#timetable_list6").addClass("inactive");  // Timetable
									$("#attendance_view6").removeClass("active");
							 		$("#attendance_view6").addClass("inactive");   //Attendance
									$("#group_list6").removeClass("active"); //Group Listings
									$("#group_list6").addClass("inactive");
									$("#staff_attendence_list6").removeClass("active");   // Staff Attendance
									$("#staff_attendence_list6").addClass("inactive");  
									$("#share_materials_list6").removeClass("active");  //Study Materials Uploaded
									$("#share_materials_list6").addClass("inactive");
									$("#notification_list6").addClass("inactive"); //Notification List
									$("#notification_list6").removeClass("active");								
									$("#holiday_list6").addClass("inactive"); //Holiday List
									$("#holiday_list6").removeClass("active"); //Holiday List
									$("#fees_listing_page6").removeClass("active"); //Fees Listing
									$("#fees_listing_page6").addClass("inactive");  //Fees Listing
                        		  	$("#ind_student6").removeClass("active");
									$("#ind_student6").addClass("inactive");
									$("#non_teaching_list6").removeClass("active");// non_teaching_list
									$("#non_teaching_list6").addClass("inactive"); //Non-Teaching Staff Listing
							 		
							}
						}
					});
						
							}
						}
					});
					
					
				
				}
				//$("#report_list6").val("");
				
		 });
		    /*    Report List six end     */
		 
		 
		 
			$("#report_lists").change(function () {
				var repost_list = $(this).val();
				//alert(repost_list);
				if(repost_list!='')
				{
			//	window.open('<?php echo base_url() . "index.php?admin/report_newlist/"; ?>'+repost_list,'_blank');
				}
                if ($(this).val() == "non_teaching") {
                    $("#holiday").hide();
					$("#notification").hide();
					$("#group_list").hide();
					$("#fees_listing").hide();
					$("#study_materials").hide();
					$("#staff_attendence").hide();
					$("#ind_student").hide();
					$("#non_teaching").show();
					$("#attendance_sub_1").hide();
					$("#attendance_sub_2").hide();
					$("#attendance_sub_3").hide();
					$("#timetable").hide();
					$("#timetable_sub_1").hide();
					$("#timetable_sub_2").hide();
					$("#attendance").hide();
					$("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();					
                } 
				else if ($(this).val() == "holiday_list") {
                    $("#holiday").show();
					$("#ind_student").hide();
					$("#notification").hide();
					$("#non_teaching").hide();
					$("#fees_listing").hide();
					$("#study_materials").hide();
					$("#staff_attendence").hide();
					$("#group_list").hide();
					$("#attendance").hide();
					$("#attendance_sub_1").hide();
					$("#attendance_sub_2").hide();
					$("#attendance_sub_3").hide();
					$("#timetable").hide();
					$("#timetable_sub_1").hide();
					$("#timetable_sub_2").hide();
					$("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "notification_list") {
                    $("#notification").show();
					 $("#holiday").hide();
					 $("#ind_student").hide();
					 $("#fees_listing").hide();
					 $("#non_teaching").hide();
					 $("#study_materials").hide();
					 $("#staff_attendence").hide();
					 $("#group_list").hide();
					 $("#attendance").hide();
					 $("#attendance_sub_1").hide();
					 $("#attendance_sub_2").hide();
					 $("#attendance_sub_3").hide();
					 $("#timetable").hide();
					 $("#timetable_sub_1").hide();
					 $("#timetable_sub_2").hide();
					 $("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "group_list") {
                    $("#notification").hide();
					 $("#holiday").hide();
					 $("#ind_student").hide();
					 $("#non_teaching").hide();
					 $("#fees_listing").hide();
					 $("#study_materials").hide();
					 $("#staff_attendence").hide();
					 $("#group_list").show();
					 $("#attendance").hide();
					 $("#attendance_sub_1").hide();
					 $("#attendance_sub_2").hide();
					 $("#attendance_sub_3").hide();
					 $("#timetable").hide();
					 $("#timetable_sub_1").hide();
					 $("#timetable_sub_2").hide();
					 $("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "fees_listing") {
                    $("#notification").hide();
					 $("#holiday").hide();
					 $("#ind_student").hide();
					 $("#non_teaching").hide();
					 $("#fees_listing").hide();
					 $("#group_list").hide();
					 $("#staff_attendence").hide();
					 $("#study_materials").hide();
					 $("#fees_listing").show();
					 $("#attendance").hide();
					 $("#attendance_sub_1").hide();
					 $("#attendance_sub_2").hide();
					 $("#attendance_sub_3").hide();
					 $("#timetable").hide();
					 $("#timetable_sub_1").hide();
					 $("#timetable_sub_2").hide();
					 $("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "study_materials") {
                     $("#notification").hide();
					 $("#holiday").hide();
					 $("#ind_student").hide();
					 $("#non_teaching").hide();
					 $("#fees_listing").hide();
					 $("#group_list").hide();	
					 $("#staff_attendence").hide();
					 $("#attendance").hide();
					 $("#attendance_sub_1").hide();
					 $("#attendance_sub_2").hide();
					 $("#attendance_sub_3").hide();					 
					 $("#study_materials").show();
					 $("#timetable").hide();
					 $("#timetable_sub_1").hide();
					 $("#timetable_sub_2").hide();
					 $("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "staff_attendence") {
                    $("#notification").hide();
					 $("#holiday").hide();
					 $("#ind_student").hide();
					 $("#non_teaching").hide();
					 $("#fees_listing").hide();
					 $("#group_list").hide();	
					 $("#staff_attendence").show();					 
					 $("#study_materials").hide();
					 $("#timetable").hide();
					 $("#timetable_sub_1").hide();
					 $("#timetable_sub_2").hide();
					 $("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "ind_student") {
                    $("#notification").hide();
					 $("#holiday").hide();
					 $("#ind_student").show();
					 $("#non_teaching").hide();
					 $("#fees_listing").hide();
					 $("#group_list").hide();	
					 $("#staff_attendence").hide();					 
					 $("#study_materials").hide();
					 $("#attendance").hide();
					 $("#attendance_sub_1").hide();
					 $("#attendance_sub_2").hide();
					 $("#attendance_sub_3").hide();
					 $("#timetable").hide();
					 $("#timetable_sub_1").hide();
					 $("#timetable_sub_2").hide();
					 $("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "attendance") {
					$("#attendance").show();
					$("#holiday").hide();
					$("#notification").hide();
					$("#group_list").hide();
					$("#fees_listing").hide();
					$("#study_materials").hide();
					$("#staff_attendence").hide();
					$("#ind_student").hide();
					$("#non_teaching").hide();
					$("#attendance_sub_1").hide();
					$("#attendance_sub_2").hide();
					$("#timetable").hide();
					$("#timetable_sub_1").hide();
					$("#timetable_sub_2").hide();
					$("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
				}else if ($(this).val() == "timetable") {
					$("#timetable").show();
					$("#timetable_sub_1").hide();
					$("#timetable_sub_2").hide();
					$("#attendance").hide();
					$("#holiday").hide();
					$("#notification").hide();
					$("#group_list").hide();
					$("#fees_listing").hide();
					$("#study_materials").hide();
					$("#staff_attendence").hide();
					$("#ind_student").hide();
					$("#non_teaching").hide();
					$("#attendance_sub_1").hide();
					$("#attendance_sub_2").hide();
					$("#exam_mark").hide();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
			    }else if ($(this).val() == "exam_mark") {
					$("#exam_mark").show();
					$("#exam_mark_sub_1").hide();
					$("#exam_mark_sub_2").hide();
					$("#exam_mark_sub_3").hide();
					$("#exam_mark_sub_4").hide();
					$("#exam_mark_sub_5").hide();
					$("#timetable").hide();
					$("#timetable_sub_1").hide();
					$("#timetable_sub_2").hide();
					$("#attendance").hide();
					$("#holiday").hide();
					$("#notification").hide();
					$("#group_list").hide();
					$("#fees_listing").hide();
					$("#study_materials").hide();
					$("#staff_attendence").hide();
					$("#ind_student").hide();
					$("#non_teaching").hide();
					$("#attendance_sub_1").hide();
					$("#attendance_sub_2").hide();
					}		
				else{
					  $("#notification").hide();
					  $("#holiday").hide();
					  $("#ind_student").hide();
					  $("#non_teaching").hide();
					  $("#group_list").hide();
					  $("#fees_listing").hide();
					  $("#staff_attendence").hide();
					  $("#study_materials").hide();
					  $("#attendance").hide();
					  $("#attendance_sub_1").hide();
					  $("#attendance_sub_2").hide();
					  $("#attendance_sub_3").hide();
					  $("#timetable").hide();
					  $("#timetable_sub_1").hide();
					  $("#timetable_sub_2").hide();
					  $("#exam_mark").hide();
					  $("#exam_mark_sub_1").hide();
					  $("#exam_mark_sub_2").hide();
					  $("#exam_mark_sub_3").hide();
					  $("#exam_mark_sub_4").hide();
					  $("#exam_mark_sub_5").hide();
					  
				}
            });
        });
		
	 $(function () {
            $("#attendance_list").change(function () {
					 if($("#attendance_list").val()=="class_wise_attendance"){
						  $("#attendance_sub_1").show();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						  $("#attendance").show();
						  $("#notification").hide();
						  $("#holiday").hide();
						  $("#ind_student").hide();
						  $("#non_teaching").hide();
						  $("#group_list").hide();
						  $("#fees_listing").hide();
						  $("#staff_attendence").hide();
						  $("#study_materials").hide();
						  $("#timetable").hide();
					      $("#timetable_sub_1").hide();
					      $("#timetable_sub_2").hide();
					}
					else if($("#attendance_list").val()=="standard_attendance"){
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").show();
						  $("#attendance_sub_3").hide();
						  $("#attendance").show();
						  $("#notification").hide();
						  $("#holiday").hide();
						  $("#ind_student").hide();
						  $("#non_teaching").hide();
						  $("#group_list").hide();
						  $("#fees_listing").hide();
						  $("#staff_attendence").hide();
						  $("#study_materials").hide();
						  $("#timetable").hide();
					      $("#timetable_sub_1").hide();
					      $("#timetable_sub_2").hide();
					}
					else if($("#attendance_list").val()=="all_attendance"){
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").show();
						  $("#attendance").show();
						  $("#notification").hide();
						  $("#holiday").hide();
						  $("#ind_student").hide();
						  $("#non_teaching").hide();
						  $("#group_list").hide();
						  $("#fees_listing").hide();
						  $("#staff_attendence").hide();
						  $("#study_materials").hide();
						  $("#timetable").hide();
					      $("#timetable_sub_1").hide();
					      $("#timetable_sub_2").hide();
					}
				});
        });
		
		 $(function () {
            $("#timetable_list").change(function () {
				
				alert('dsd');
					 if($("#timetable_list").val()=="class_wise_timetable"){
						  $("#timetable").show();
					      $("#timetable_sub_1").show();
					      $("#timetable_sub_2").hide();
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						  $("#attendance").hide();
						  $("#notification").hide();
						  $("#holiday").hide();
						  $("#ind_student").hide();
						  $("#non_teaching").hide();
						  $("#group_list").hide();
						  $("#fees_listing").hide();
						  $("#staff_attendence").hide();
						  $("#study_materials").hide();
					}else if($("#timetable_list").val()=="teacher_wise_timetable"){
						  $("#timetable").show();
					      $("#timetable_sub_2").show();	
						  $("#timetable_sub_1").hide();
					      $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						  $("#attendance").hide();
						  $("#notification").hide();
						  $("#holiday").hide();
						  $("#ind_student").hide();
						  $("#non_teaching").hide();
						  $("#group_list").hide();
						  $("#fees_listing").hide();
						  $("#staff_attendence").hide();
						  $("#study_materials").hide();
					}
					
				});
        });
		
		 $(function () {
            $("#exam_mark_list").change(function () {
					 if($("#exam_mark_list").val()=="class_wise_exam"){
						  $("#exam_mark").show();
						  $("#exam_mark_sub_1").show();
						  $("#exam_mark_sub_2").hide();
						  $("#exam_mark_sub_3").hide();
						  $("#exam_mark_sub_4").hide();
						  $("#exam_mark_sub_5").hide();
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						  $("#attendance").hide();
						  $("#notification").hide();
						  $("#holiday").hide();
						  $("#ind_student").hide();
						  $("#non_teaching").hide();
						  $("#group_list").hide();
						  $("#fees_listing").hide();
						  $("#staff_attendence").hide();
						  $("#study_materials").hide();
						  $("#timetable").hide();
					      $("#timetable_sub_1").hide();
					      $("#timetable_sub_2").hide();
					}
					else if($("#exam_mark_list").val()=="student_mark"){
						  $("#exam_mark").show();
						  $("#exam_mark_sub_1").hide();
						  $("#exam_mark_sub_2").show();
						  $("#exam_mark_sub_3").hide();
						  $("#exam_mark_sub_4").hide();
						  $("#exam_mark_sub_5").hide();	
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						  $("#attendance").hide();
						  $("#notification").hide();
						  $("#holiday").hide();
						  $("#ind_student").hide();
						  $("#non_teaching").hide();
						  $("#group_list").hide();
						  $("#fees_listing").hide();
						  $("#staff_attendence").hide();
						  $("#study_materials").hide();
						  $("#timetable").hide();
					      $("#timetable_sub_1").hide();
					      $("#timetable_sub_2").hide();
					}
					else if($("#exam_mark_list").val()=="class_wise_top3_student"){
						  $("#exam_mark").show();
						  $("#exam_mark_sub_1").hide();
						  $("#exam_mark_sub_2").hide();
						  $("#exam_mark_sub_3").show();
						  $("#exam_mark_sub_4").hide();
						  $("#exam_mark_sub_5").hide();
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						  $("#attendance").hide();
						  $("#notification").hide();
						  $("#holiday").hide();
						  $("#ind_student").hide();
						  $("#non_teaching").hide();
						  $("#group_list").hide();
						  $("#fees_listing").hide();
						  $("#staff_attendence").hide();
						  $("#study_materials").hide();
						  $("#timetable").hide();
					      $("#timetable_sub_1").hide();
					      $("#timetable_sub_2").hide();
					}else if($("#exam_mark_list").val()=="subject_wise_top3_student"){
						  $("#exam_mark").show();
						  $("#exam_mark_sub_1").hide();
						  $("#exam_mark_sub_2").hide();
						  $("#exam_mark_sub_3").hide();
						  $("#exam_mark_sub_4").show();
						  $("#exam_mark_sub_5").hide();
						  $("#attendance_sub_1").hide();
						  $("#attendance_sub_2").hide();
						  $("#attendance_sub_3").hide();
						  $("#attendance").hide();
						  $("#notification").hide();
						  $("#holiday").hide();
						  $("#ind_student").hide();
						  $("#non_teaching").hide();
						  $("#group_list").hide();
						  $("#fees_listing").hide();
						  $("#staff_attendence").hide();
						  $("#study_materials").hide();
						  $("#timetable").hide();
					      $("#timetable_sub_1").hide();
					      $("#timetable_sub_2").hide();
					}
				});
        });
		
		
function get_exam(class_id) {
	 
	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_exam/' + class_id,
            success: function(response)
            {
				jQuery('#exam_listing').html(response);
	        }
       });
   }
function get_student_name_exam(class_id) {
	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_exam_list_mark/' + class_id,
            success: function(response)
            {
				jQuery('.exam_listing_mark').html(response);
	        }
       });
   	   $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_student_list_mark/' + class_id,
            success: function(response)
            {
				jQuery('#student_listing').html(response);
            }
       });
}
    </script>
<script>
  $(document).ready(function() {
	  
	  var calendar = $('#notice_calendar');
				
				$('#notice_calendar').fullCalendar({
					header: {
						left: 'title',
						right: 'today prev,next'
					},
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,
					
					events: [
						<?php 
						$notices	=	$this->db->get('noticeboard')->result_array();
						foreach($notices as $row):
						?>
						{
							title: "<?php echo $row['notice_title'];?>",
							/*start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
							end:	new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>)*/ 
						},
						<?php 
						endforeach
						?>
						
					]
				});
	});
  </script>
    
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 
  <div id="dialog_box" style="display: none;">
  Do You Want To Save This Report?
</div>