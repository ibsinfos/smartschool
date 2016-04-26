<script type="text/javascript">

jQuery(document).ready(function($)
	{	
		var datatable = $("#table_export").dataTable({"oLanguage": { "sSearch": "Filter" } });
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});	
	});		
</script>

<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
						SMS
                </a>
			</li>
			
		</ul>
    	<!------CONTROL TABS END------>
       
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">	
             <?php echo form_open(base_url() . 'index.php?twilio_demo/' , array('class' => 'form-horizontal  validate','target'=>'_top'));?>
                        <div class="padded">
                            <div id="drop">
								
							</div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Class</label>
                                <div class="col-sm-5">
                                    <select name="phone_number" class="form-control" style="width:100%;" data-validate="required">
										<option value="+91 81548 51354">+91 81548 51354</option>
                                        <option value="+91 90679 37401">+91 90679 37401</option>
                                        <option value="+91 97375 74107">+91 99048 69914</option>
								    	
                                    </select>
                                </div>
                            </div>
                            
							
                            
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info">Send</button>
                                  
                              </div>
						</div>
                    </form>                
                </div>                
                	
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			
	</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      

