<link href="<?= base_url() ?>assets/adminto/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
<div class="datalist">
    <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="50"><?= trans('id') ?></th>
                <th>NAMA PENGGUNA</th>
                <th>USERNAME</th>
                <th>PERAN/ROLE</th>
                <th width="100">STATUS</th>
                <th width="120">AKSI</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($info as $row): ?>
            <tr>
            	<td>
					<?=$row['user_id']?>
                </td>
                <td>
					<?=$row['firstname']?> <?=$row['lastname']?>
                </td>
                <td>
                    <?=$row['username']?>
                </td> 
                <td>
                    <button class="btn btn-xs btn-success"><?=$row['admin_role_title']?></button>
                </td> 
                <td>
                
                <span class="badge <?php echo ($row['is_active'] == 1)? "bg-success" : "bg-danger"; ?>"><?php echo ($row['is_active'] == 1)? "Aktif" : "Nonaktif"; ?></span>
                
                </td>
                <td>
                    <a href="<?= base_url("admin/admin/edit/".$row['user_id']); ?>" class="btn btn-warning btn-xs mr5" >
                    <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?= base_url("admin/admin/delete/".$row['user_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<script src="<?= base_url(); ?>assets/adminto/libs/mohithg-switchery/switchery.min.js"></script>

