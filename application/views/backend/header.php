
<div class="row top-title topbg">
	<div class="col-md-6 col-sm-12 clearfix">
    	<div class="pull-left">
        				 <img  height="60" class="" src="<?php echo base_url(); ?>/uploads/system_image/1.jpg">        
        </div>
<div class="pull-right">
        <h2 class="mar-zero">
       <?php echo $system_name;?></h2>
       </div>
    </div>
    
	<!-- Raw Links -->
	<div class="col-md-6 col-sm-12 clearfix ">		
  <li class="list-inline links-list pull-right">
  <?php if($account_type=='student'){?>
				<a href="<?php echo base_url();?>index.php?login/student_logout">
					Logout <i class="entypo-logout right"></i>
				</a>
				<?php }else{ ?>
				<a href="<?php echo base_url();?>index.php?login/logout">
					Logout <i class="entypo-logout right"></i>
				</a>
                <?php }?>
			</li>	
        <!--<ul class="list-inline links-list pull-left">
        <!-- Language Selector 			
           <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                        	<i class="entypo-user"></i> <?php echo $this->session->userdata('login_type');?>
                    </a>

				<?php if ($account_type != 'parent'):?>
				<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
					<li>
						<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile">
                        	<i class="entypo-info"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile">
                        	<i class="entypo-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>
				</ul>
				<?php endif;?>
				<?php if ($account_type == 'parent'):?>
				<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
					<li>
						<a href="<?php echo base_url();?>index.php?parents/manage_profile">
                        	<i class="entypo-info"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>index.php?parents/manage_profile">
                        	<i class="entypo-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>
				</ul>
				<?php endif;?>
			</li>
        </ul>-->
        
        
		<ul class="list-inline links-list pull-right padd-zero mar-zero">
			
			<!-- Language Selector 			
           <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                        <i class="entypo-globe"></i> language
                    </a>
				
				<ul class="dropdown-menu <?php if ($text_align == 'left-to-right') echo 'pull-left'; else echo 'pull-right';?>">
					<?php
                            $fields = $this->db->list_fields('language');
                            foreach ($fields as $field)
                            {
                                if($field == 'phrase_id' || $field == 'phrase')continue;
                                ?>
                                    <li class="<?php if($this->session->userdata('current_language') == $field)echo 'active';?>">
                                        <a href="<?php echo base_url();?>index.php?multilanguage/select_language/<?php echo $field;?>">
                                            <img src="assets/images/flag/<?php echo $field;?>.png" style="width:16px; height:16px;" />	
												 <span><?php echo $field;?></span>
                                        </a>
                                    </li>
                                <?php
                            }
                            ?>
				</ul>
				
			</li>
			-->
			<li class="sep"></li>
			<?php $mail_not	=$this->db->get_where('message' , array('read_status' => 0) )->result_array();	?>
			<?php
				$mesnoti=$this->db->get_where('message',array('read_status' => 0))->result_array();
				$noticount=0;
				foreach($mesnoti as $n)
				{
					$reciever_email=$n['reciever_email'];
					$datanoti=explode('-',$reciever_email);
					if($this->session->userdata('login_type')=='student')
					{
						if($datanoti[0]=='student'&&$datanoti[1]==$this->session->userdata('student_id'))
						{
							$noticount++;
						}
					}
					elseif($this->session->userdata('login_type')=='parents')
					{
						if($datanoti[0]=='parent'&&$datanoti[1]==$this->session->userdata('parent_id'))
						{
							$noticount++;
						}
					}
					elseif($this->session->userdata('login_type')=='teacher')
					{
						if($datanoti[0]=='teacher'&&$datanoti[1]==$this->session->userdata('teacher_id'))
						{
							$noticount++;
						}
					}
					else
					{
						if($datanoti[0]=='admin'&&$datanoti[1]==$this->session->userdata('admin_id'))
						{
							$noticount++;
						}
					}
				}
			?>
			<li class="notifications dropdown">
				<a data-close-others="true" href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/message"> <i class="entypo-mail"></i> <span class="badge badge-secondary"><?php echo $noticount; ?></span> </a>
			</li>
			<li class="notifications dropdown">
			<?php $not_read	=$this->db->get_where('noticeboard' , array('notice_read' => 0) )->result_array();	?>
				<a data-close-others="true" href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/notification" aria-expanded="false"> <i class="entypo-attention"></i> <span class="badge badge-info"><?php echo count($not_read); ?></span> </a>
			</li>
			<li class="notifications dropdown">
			<?php if($account_type=="parent"){?>
			     <a href="<?php echo base_url();?>index.php?parents/manage_profile"><i class="entypo-user"></i></a>

			<?php }else {?>
			<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile">	<i class="entypo-user"></i><?php //echo $this->session->userdata('login_type');?>
			<?php }?>
                        
            </a>
			</li>		
			
		</ul>
	</div>
	
</div>

<hr style="margin-top:0px;" />