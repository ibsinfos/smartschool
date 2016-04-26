
<?php 
	$this->load->helper('html');
?>
<style>
	.modal-backdrop.in{opticity:0; z-index:0 !important;}
</style>
<hr />
<!------CONTROL TABS START------->

<ul class="nav nav-tabs bordered">	
	<li class="active">		
		<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>Inbox</a>		
	</li>
	<li><a href="#compose" data-toggle="tab">Compose</a></li> 
</ul>

<!------CONTROL TABS END------->
<div class="tab-content">    
	<!----TABLE LISTING STARTS--->
	<div class="tab-pane box active" id="list">		
		<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">			
			<thead>
				
				<tr>
					<th><div>Name</div></th>
					
					<th><div>Details</div></th>
					
					<th><div>Timestamp</div></th>						
					
					<th><div>Action</div></th>						
					
				</tr>
				
			</thead>
			
			<tbody>
				
				<?php $count = 0;
					
					$current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
					 $this->db->order_by("message_id", "desc");
					$this->db->where('reciever_email', $current_user);						
					$message_threads = $this->db->get('message')->result_array();
					
					foreach ($message_threads as $row):					    
					$stuname="";
					$read_sender = $row['sender'];
					$user_to_show = explode('-', $row['sender']); 
					
					$user_to_show_type  = $user_to_show[0];
					
					$user_to_show_id 	= $user_to_show[1];
					
					$m_id = $row['message_id'];					
					
					$date = $row['timestamp'];	
					
					$timestamp = date("g:iA  d/m/y",$date);
					
				?>  					
				
				<tr>
					<td><?php						
						if($user_to_show_type=='parents')
						{
							echo $this->db->get_where('parent', array('parent_id' => $user_to_show_id))->row()->name;
							
						}
						else
						{
							echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name;
							
						}
					?>
					
					</td>
					
					<td><?php echo $row['message'];?></td>
					
					<td><?php echo $timestamp; ?></td>						
					
					<td>						
						<?php
							
							if($user_to_show_type=='parents')
							{
								$msgdata=	$this->db->get_where('parent', array('parent_id' => $user_to_show_id))->row();
								$typeid=$msgdata->parent_id;
								$typename=$msgdata->name;
							}
							elseif($user_to_show_type=='student')
							{
								$msgdata=	$this->db->get_where('student', array($user_to_show_type . '_id' => $user_to_show_id))->row();
								$typeid=$msgdata->student_id;
								$typename=$msgdata->name;
							}
							elseif($user_to_show_type=='teacher')
							{
								$msgdata=	$this->db->get_where('teacher', array($user_to_show_type . '_id' => $user_to_show_id))->row();
								$typeid=$msgdata->teacher_id;
								$typename=$msgdata->name;
							}
							elseif($user_to_show_type=='admin')
							{
								$msgdata=	$this->db->get_where('admin', array($user_to_show_type . '_id' => $user_to_show_id))->row();
								$typeid=$msgdata->admin_id;
								$typename=$msgdata->name;
							}
							?>
							<a data-toggle="modal" data-target="#myModal123" data-id="<?php echo $m_id;?>"  onclick="addId('<?php echo $m_id;?>','<?=$typename;?>','<?php echo str_replace(array("\r", "\n"),'', $row['message']);?>','<?php echo $user_to_show_type?>',<?php echo $typeid;?>);">
								
								<i class="entypo-eye"  <?php if($row['read_status'] == 0){ ?>style="color:red"<?php } ?>></i>
								
							</a>
						
					</td>
					
				</tr>					
				
				<?php 
					
				endforeach; ?>					
				
			</tbody>
			
		</table>
		
	</div>
	
	
	
	<!-- Popup start  -->
	
	<div class="modal fade" id="myModal123" role="dialog" style="z-index:2000 !important;" aria-hidden="true">
		
		
	</div>
	
	<!-- Popup End---->	
	
	
	
	<div class="tab-pane fade" id="compose">
		
		<div class="mail-header" style="padding-bottom: 27px ;">
			
			<!-- title -->
			
			<h3 class="mail-title">
				
				<?php echo get_phrase('write_new_message'); ?>
				
			</h3>
			
		</div>
		
		<div class="mail-compose">
			
			<?php echo form_open(base_url() . 'index.php?student/message/send_new/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
			
			<div class="form-group">
				
				<label for="subject"><?php echo get_phrase('recipient'); ?>:</label>
				
			</div>
			
			<div id="wrapper">
				
				<div id="states-dropdown">
					
					<select class="form-control" name="reciever"  id="dropdownMenu2" required>
						
						<option value=""><?php echo get_phrase('select_entity'); ?></option>
						<?php
							$query=$this->db->get('group')->result();							
							foreach($query as $g)
							{
								if($g->group_id!=2 && $g->group_id!=4)
								{
								?>
								<option value="<?php echo $g->group_id?>"><?php echo $g->group_name ?></option>
								<?php
								}
							}
						?>
						<option value="admin">Admin</option>
					</select>
					
				</div>
				
				<div id="listbox"></div>
				
			</div>
			
			<!--<input type="hidden" name="email_info" value "<?php echo $_POST['email_info']; ?>"/>-->
			
			<div class="">
				<!--<textarea name="receiverlist" id="receiverlist" ></textarea>-->
				<textarea row="2" class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" 
				
				name="receiverlist" placeholder="Receiver List" 
				
				id="receiverlist"></textarea>
				<input type="hidden" name="receiveid" id="receiveid" value=""/>
				<input type="hidden" name="receivetype" id="receivetype" value=""/>
				
			</div>
			<div class="compose-message-editor">
				
				<textarea row="2" class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" 
				
				name="message" placeholder="<?php echo get_phrase('write_your_message'); ?>" 
				
				id="sample_wysiwyg" required></textarea>
				
			</div>
			
			<hr>
			
			<button type="submit" class="btn btn-success btn-icon pull-right">
				
				<?php echo get_phrase('send'); ?>
				
				<i class="entypo-mail"></i>
				
			</button>
			
		</form>
		
	</div>
	
</div>


</div>

<script type="text/javascript">
	$('#myModal123').on('hidden.bs.modal', function () {
		
		location.reload(true);
		
	});
	
function addId(id ,name ,message,type,typeid){
		
		var id = id;
		
		var name = name;
		
		var message = message;
		var type=type;
		var typeid=typeid;
		//alert(id);
		
		$.ajax({
			
			type: "post",
			
			url: "<?php echo base_url('/index.php?student/message/message_read1');?>/"+id,
			
			data: {id:id,name:name,message:message,type:type,typeid:typeid},
		
			cache: false,
			
			async: false,
			success: function(result){
		
				$("#myModal123").html(result);
				$('#mail_name').append(name);
				$('#txttype').val(type);
				$('#txttypeid').val(typeid);
			}
			
		});
	}
	
</script> 

<script type="text/javascript">
	
	$("#dropdownMenu2").change(function () {
		
		var Entity = $(this).val();
		if(Entity=='admin')
		{
			$("#receiverlist").val("admin;");
			$('#receiveid').val('1;');
			$('#receivetype').val('admin;');
			$('#listbox').empty();
		}
		else
		{
			//console.log(Entity);
			
			$.ajax({   
				
				url: "index.php?getinfo/fromstudent", //The url where the server req would we made.
				
				async: false,
				
				type: "POST", //The type which you want to use: GET/POST
				
				data: "entity="+Entity, //The variables which are going.
				
				dataType: "html", //Return data type (what we expect).
				
				//This is the function which will be called if ajax call is successful.
				
				success: function(data) {
					
					//data is the html of the page where the request is made.
					
					$('#listbox').html(data);
					
				}
				
			})
		}
		
	});
	
</script>	
