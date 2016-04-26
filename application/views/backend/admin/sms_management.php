<?php $this->load->helper('html');?>
<style>
	.modal-backdrop.in{opticity:0; z-index:0 !important;}
</style>
<hr />
<div class="row">    
	<div class="col-md-12">
<div class="tab-content">    
	<div class="modal fade" id="myModal123" role="dialog" style="z-index:2000 !important;" aria-hidden="true"></div>
	<!-- Popup End---->	
	<div class="tab-pane active" id="compose">
		
		<div class="mail-compose clearfix">
			<?php echo form_open(base_url() . 'index.php?twilio_demo', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
				<div class="form-group clearfix">
				<label class="col-sm-3 control-label">Select Class</label>
				<div id="states-dropdown" class="col-sm-5">
					<select class="form-control" name="class"  id="class" onchange="return get_student(this.value);" required>
						<option value="">Select Class</option>
						<?php
							$get_class=$this->db->get('class')->result_array();
							foreach($get_class as $row_class){?>
					<option value="<?php echo $row_class['name_numeric'];?>"><?php echo $row_class['name_numeric'];?></option>
							<?php
							}
						?>
					</select>
				</div>
				<div id="listbox"></div>
			</div>
				<div class="form-group clearfix">
			<label class="col-sm-3 control-label">Select Parent</label>
			<div class="col-sm-5">
				<textarea row="2" class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" 
				name="receiverlist" placeholder="Parent List"id="receiverlist"></textarea>
				<input type="hidden" name="phone_number" id="receiveid" value=""/>
				<input type="hidden" name="receivetype" id="receivetype" value=""/>
			</div>
			</div>
				<div class="form-group clearfix">
				<label class="col-sm-3 control-label">Message</label>
			<div class="compose-message-editor col-sm-5">
				<textarea row="2" class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" 
				name="message" placeholder="<?php echo get_phrase('write_your_message'); ?>" 
				id="sample_wysiwyg" required maxlength="150"></textarea>
			</div>
			</div>
			<hr>
			<div class="text-center">
			<button type="submit" class="btn btn-success btn-icon">
				<?php echo get_phrase('send'); ?>
				<i class="entypo-mail"></i>
			</button>
		  </div>
		</form>
	</div>
</div>
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
		$.ajax({
			type: "post",
			url: "<?php echo base_url('/index.php?admin/message/message_read1');?>/"+id,
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
function get_student(class_id){
 		$.ajax({   
			url: "index.php?admin/getinfostudent",
			async: false,
			type: "POST",
			data: "class_name="+class_id,
			dataType: "html",
			success: function(data)
			{
				$('#listbox').html(data);
			}
		})
	 }
</script>							