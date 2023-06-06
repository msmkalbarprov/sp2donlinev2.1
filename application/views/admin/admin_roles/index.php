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
                            <h4 class="header-title mb-4">Peran/Role Setting </h4>
                            <div class="text-end">
							<a href="<?= base_url('admin/admin_roles/add'); ?>" class="btn btn-success btn-sm">Tambah</a>
                            </div>
                            <br />
                            <table id="example2" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50"><?= trans('id') ?></th>
							<th><?= trans('admin_role') ?></th>
							<th><?= trans('status') ?></th>
							<th><?= trans('permission') ?></th>
							<th width="200"><?= trans('action') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($records as $record): ?>
							<tr>
								<td><?php echo $record['admin_role_id']; ?></td>
								<td><?php echo $record['admin_role_title']; ?></td>
								<td>
									<input type="checkbox" <?php echo ($record['admin_role_status']==1)? "checked" : ""; ?> data-switchery="true" id='cb_<?=$record['admin_role_id']?>' data-id="<?php echo $record['admin_role_id']; ?>" data-plugin="switchery" data-color="#039cfd" class="tgl_checkbox"/>
									
									<label class='tgl-btn' for='cb_<?=$record['admin_role_id']?>'></label>
								</td>
								<td>
									<a href="<?php echo site_url("admin/admin_roles/access/".$record['admin_role_id']); ?>" class="btn btn-info btn-xs mr5" >
										<i class="fa fa-sliders"></i>
									</a>
								</td>
								<td>
									<?php if(!in_array($record['admin_role_id'],array(1))): ?>
										<a href="<?php echo site_url("admin/admin_roles/edit/".$record['admin_role_id']); ?>" class="btn btn-warning btn-xs mr5" >
											<i class="fa fa-edit"></i>
										</a>
										<a href="<?php echo site_url("admin/admin_roles/delete/".$record['admin_role_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
									<?php endif;?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
                        </div>
                    </div> <!-- end card-->
            
            <!-- content -->
        </div> <!-- container -->

    </div> <!-- content -->
    <script src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/ashl1/datatables-rowsgroup@fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js"></script>



<script>
  $(function () {
    $("#example1").DataTable();
  })
</script>

	<script>
		$("body").on("change",".tgl_checkbox",function(){
			$.post('<?=base_url("admin/admin_roles/change_status")?>',
			{
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',	
				id : $(this).data('id'),
				status : $(this).is(':checked') == true ? 1:0
			},
			function(data){
				Swal.fire(
					'Berhasil!',
					'Status Peran Berhasil diganti.',
					'success'
					)
			});
		});

	</script>