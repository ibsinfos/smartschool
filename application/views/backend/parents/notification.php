<div class="row">
	<div class="col-md-12">
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>From</div></th>
                    		<th><div>Details</div></th>
                    		<th><div>Time Stamp</div></th>
                    		<th><div>Action</div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($notices as $row):?>
						<tr>
                           <td><?php echo $row['notice_name'];?></td>
							<td class="span5"><?php echo $row['notice'];?></td>
							<td><?php echo date('h:i A F d, Y',strtotime($row['create_timestamp']));?></td>
						
						<td>						
							   <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/model_notice_view/<?php echo $row['notice_id'];?>');">
							<i class="entypo-eye"  <?php if($row['notice_read'] == 0){ ?>style="color:red"<?php } ?>></i>
						</a></td>	
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({"oLanguage": { "sSearch": "Filter" } });
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
	</script>