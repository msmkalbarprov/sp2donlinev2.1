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
                            <h4 class="header-title mb-4">Module Setting </h4>
                            <div class="text-end">
								<a href="<?= base_url('admin/admin_roles/module_add'); ?>" class="btn btn-success">Tambah</a>
                            </div>
                            <br />
                            <table id="example1" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th width="50"><?= trans('id') ?></th>
										<th><?= trans('module_name') ?></th>
										<th><?= trans('controller_name') ?></th>
										<th><?= trans('fa_icon') ?></th>
										<th><?= trans('operations') ?></th>
										<th><?= trans('sub_module') ?></th>
										<th width="100"><?= trans('action') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($records as $record): ?>
										<tr>
											<td><?= $record['module_id']; ?></td>
											<td><?= trans($record['module_name']); ?></td>
											<td><?= $record['controller_name']; ?></td>
											<td><?= $record['fa_icon']; ?></td>
											<td><?= $record['operation']; ?></td>
											<td>
												<a href="<?= base_url('admin/admin_roles/sub_module/'.$record['module_id']) ?>" class="btn btn-info btn-xs mr5">
													<i class="fa fa-sliders"></i>
												</a>
											</td>
											<td>
												<a href="<?php echo site_url("admin/admin_roles/module_edit/".$record['module_id']); ?>" class="btn btn-warning btn-xs mr5" >
														<i class="fa fa-edit"></i>
													</a>
												<a href="<?php echo site_url("admin/admin_roles/module_delete/".$record['module_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
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