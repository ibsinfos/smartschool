<div class="row">
	<div class="col-md-12">
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box active" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/create_group/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group mandatory"><div class="col-sm-5"> * Fields are mandatory </div></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Group Name<span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="group_name" data-validate="required"
                                     data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Type of Users');?><span class="mandatory">*</span></label>
                                <div class="col-sm-3">
                                    <select id="user_type" name="user_t" class="form-control" style="width:100%;" onchange="return get_user(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                    <option value="">Select User Type</option>
                                    <option value="1">Teacher</option>
                                    <option value="2">Student</option>
                                    <option value="3">Non Technical</option>
                                    <option value="4">Parent</option>
                             <?php if($this->session->userdata('admin_id')== 1){  ?>       
                                    <option value="5">Sub Admin</option>
                                    <?php }?>
                                    </select>
                                    <div id="test"></div>
                                   
                                </div>
                            </div>
                  <div class="form-group">          
          		 <label class="col-sm-3 control-label">Existing Users<span class="mandatory">*</span></label>
				<div class="col-sm-3">
					<select class="form-control" style="width:100%;" size="8" multiple="multiple" id="multiselect">
                                    </select>
				</div>
				
				<div class="col-sm-1">
					<!--<button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>-->
					<button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
					<button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
					<!--<button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>-->
				</div>
				
				<div class="col-sm-3">
					<select name="user_role[]" id="multiselect_to" class="form-control" size="8" multiple="multiple" data-validate="required"
                                     data-message-required="<?php echo get_phrase('value_required');?>"></select>
				</div>
				</div>	
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_group');?></button>
                              </div>
						   </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>

<script type="text/javascript">
  $(function(){
      // bind change event to select
      $('#dropclass').on('change', function () {
         // var url = $(this).val(); // get selected value
		  var classId = $(this).val();
          if (classId) { // require a URL
              window.location = "<?php echo base_url('/index.php?admin/group/');?>/"+classId;
          }
          return false;
      });
    });
	function get_user(user_id) {
		$("#test").append('<input type="hidden" name="user_type" value="'+user_id+'">');
    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_user/' + user_id ,
            success: function(response)
            {
                jQuery('#multiselect').html(response);
            }
        });
   }
   function get_group_ajax(group_id) {

    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_group_ajax/' + group_id ,
            success: function(response)
            {
                jQuery('#group_listing').html(response);
            }
        });
   }

$(document).ready(function() {
 $(document).click(function() {
	var value = $( "#multiselect_to option" ).text();
	if (value == "")
	{
		$('#user_type').removeAttr('disabled');
    }
    else
	{
       $('#user_type').attr('disabled', 'disabled');
    }
 });
});
</script>
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->  
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable();
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
	});
</script>
<script type="text/javascript" src="assets/js/multiselect.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		// make code pretty
		window.prettyPrint && prettyPrint();
		
		if ( window.location.hash ) {
			scrollTo(window.location.hash);
		}
		
		$('.nav').on('click', 'a', function(e) {
			scrollTo($(this).attr('href'));
		});

		$('#multiselect').multiselect();

		$('[name="q"]').on('keyup', function(e) {
			var search = this.value;
			var $options = $(this).next('select').find('option');

			$options.each(function(i, option) {
				if (option.text.indexOf(search) > -1) {
					$(option).show();
				} else {
					$(option).hide();
				}
			});
		});

		$('#search').multiselect({
			search: {
				left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
				right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
			}
		});

		$('.multiselect').multiselect();
		$('.js-multiselect').multiselect({
			right: '#js_multiselect_to_1',
			rightAll: '#js_right_All_1',
			rightSelected: '#js_right_Selected_1',
			leftSelected: '#js_left_Selected_1',
			leftAll: '#js_left_All_1'
		});

		$('#keepRenderingSort').multiselect({
			keepRenderingSort: true
		});

		$('#undo_redo').multiselect();

		$('#multi_d').multiselect({
			right: '#multi_d_to, #multi_d_to_2',
			rightSelected: '#multi_d_rightSelected, #multi_d_rightSelected_2',
			leftSelected: '#multi_d_leftSelected, #multi_d_leftSelected_2',
			rightAll: '#multi_d_rightAll, #multi_d_rightAll_2',
			leftAll: '#multi_d_leftAll, #multi_d_leftAll_2',

			moveToRight: function(Multiselect, options, event, silent, skipStack) {
				var button = $(event.currentTarget).attr('id');

				if (button == 'multi_d_rightSelected') {
					var left_options = Multiselect.left.find('option:selected');
					Multiselect.right.eq(0).append(left_options);

					if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
						Multiselect.right.eq(0).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(0));
					}
				} else if (button == 'multi_d_rightAll') {
					var left_options = Multiselect.left.find('option');
					Multiselect.right.eq(0).append(left_options);

					if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
						Multiselect.right.eq(0).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(0));
					}
				} else if (button == 'multi_d_rightSelected_2') {
					var left_options = Multiselect.left.find('option:selected');
					Multiselect.right.eq(1).append(left_options);

					if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
						Multiselect.right.eq(1).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(1));
					}
				} else if (button == 'multi_d_rightAll_2') {
					var left_options = Multiselect.left.find('option');
					Multiselect.right.eq(1).append(left_options);

					if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
						Multiselect.right.eq(1).eq(1).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(1));
					}
				}
			},

			moveToLeft: function(Multiselect, options, event, silent, skipStack) {
				var button = $(event.currentTarget).attr('id');

				if (button == 'multi_d_leftSelected') {
					var right_options = Multiselect.right.eq(0).find('option:selected');
					Multiselect.left.append(right_options);

					if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
						Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
					}
				} else if (button == 'multi_d_leftAll') {
					var right_options = Multiselect.right.eq(0).find('option');
					Multiselect.left.append(right_options);

					if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
						Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
					}
				} else if (button == 'multi_d_leftSelected_2') {
					var right_options = Multiselect.right.eq(1).find('option:selected');
					Multiselect.left.append(right_options);

					if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
						Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
					}
				} else if (button == 'multi_d_leftAll_2') {
					var right_options = Multiselect.right.eq(1).find('option');
					Multiselect.left.append(right_options);

					if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
						Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
					}
				}
			}
		});
	});
	
	function scrollTo( id ) {
		if ( $(id).length ) {
			$('html,body').animate({scrollTop: $(id).offset().top - 40},'slow');
		}
	}
	</script>
