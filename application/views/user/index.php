<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="text-gray-800">Data User</h4>
    </div>
    <div class="card-body">
        <?= anchor('user/create', 'Tambah', ['class' => 'btn btn-primary mb-3']); ?>
        <?php if ($users) : ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Diblokir</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($users as $t) : ?>
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= $t->nama_user; ?></td>
                                <td><?= $t->username; ?></td>
                                <td><?= $t->level; ?></td>
                                <td><?= $t->is_blokir == 'n' ? 'Tidak' : 'Ya'; ?></td>
                                <td><?= anchor("user/edit/$t->id_user", 'Edit', ['class' => 'btn btn-sm btn-warning']) ?></td>
                                <td><?= anchor("user/delete/$t->id_user", 'Delete', ['class' => 'btn btn-sm btn-danger']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p>Tidak ada data user.</p>
        <?php endif; ?>
    </div>
</div>