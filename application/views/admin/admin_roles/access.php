<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <!-- content -->
                    <div class="card">
                    <?php $this->load->view('admin/includes/_messages.php') ?>
                        <div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<?php foreach($modules as $kk => $module): ?>
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-3">
												<h5 class="m-0">
													<strong class="f-16"><?= trans($module['module_name'])?></strong>
												</h5>
											</div>
											<div class="col-md-9">
												<div class="row mb-3">
												<?php foreach(explode("|",$module['operation']) as $k => $operation):?>
													<div class="col-md-3 pb-3">	
														<span class="pull-left">
														<input type="checkbox" <?php if (in_array($module['controller_name'].'/'.$operation, $access)) echo 'checked="checked"';?>
														data-switchery="true" 
														id='cb_<?=$kk.$k?>'
														data-module='<?= $module['controller_name'] ?>'
														data-operation='<?= $operation; ?>' 
														data-plugin="switchery" 
														data-color="#039cfd" 
														class="tgl_checkbox"/>

															<!-- <input type='checkbox'
															class='tgl tgl-ios tgl_checkbox'
															data-module='<?= $module['controller_name'] ?>'
															data-operation='<?= $operation; ?>'
															id='cb_<?=$kk.$k?>' 
															<?php if (in_array($module['controller_name'].'/'.$operation, $access)) echo 'checked="checked"';?>
															/> -->
															<label class='tgl-btn' for='cb_<?=$kk.$k?>'></label> 
														</span>
														<span class="mt-15 pl-3">
															<?=ucwords($operation)?>
														</span>
													</div>
												<?php endforeach; ?>
												</div>
											</div>
										</div>
										<hr style="margin:7px 0px;" />
									</div>  
									<?php endforeach; ?>
								</div>
							</div>
                        </div>
                    </div> <!-- end card-->
            
            <!-- content -->
        </div> <!-- container -->

    </div> <!-- content -->
    <script src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/ashl1/datatables-rowsgroup@fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js"></script>



<script>
	$("body").on("change",".tgl_checkbox",function(){
		$.post('<?=base_url("admin/admin_roles/set_access")?>',
		{
			'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			module : $(this).data('module'),
			operation : $(this).data('operation'),
			admin_role_id : <?=$record['admin_role_id']?>,
			status : $(this).is(':checked')==true?1:0
		},
		function(data){
			$.notify("Status Changed Successfully", "success");
		});
	});
</script>	
	
