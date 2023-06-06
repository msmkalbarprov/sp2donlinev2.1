<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<?php $parent_module = $this->uri->segment(4); ?>
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <!-- content -->
                    <div class="card">
                    <?php $this->load->view('admin/includes/_messages.php') ?>
                        <div class="card-body">
                            <h4 class="header-title mb-4">Sub Module Setting </h4>
                            <div class="text-end">
								<a href="<?= base_url('admin/admin_roles/sub_module_add/'.$parent_module); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                            <br />
                            <table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50">ID</th>
							<th>Name</th>
							<th>Operations</th>
							<th width="100">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($records as $record): ?>
							<tr>
								<td><?= $record['id']; ?></td>
								<td><?= trans($record['name']); ?></td>
								<td><?= $record['link']; ?></td>
								<td>
									<a href="<?php echo site_url("admin/admin_roles/sub_module_edit/".$record['id']); ?>" class="btn btn-warning btn-xs mr5" >
											<i class="fa fa-edit"></i>
										</a>
									<a href="<?php echo site_url("admin/admin_roles/sub_module_delete/".$record['id'].'/'.$record['parent']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
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

