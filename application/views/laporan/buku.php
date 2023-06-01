<div class="card shadow mb-4">
    <div class="card-header">
        <h4>Laporan Buku</h4>
    </div>
    <div class="card-body">
        <?= anchor("cetak-laporan-buku", 'Cetak', ['class' => 'btn btn-success', 'target' => '_blank']) ?>
        <?php if ($bukus) : ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ISBN</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($bukus as $t) : ?>
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= $t->isbn; ?></td>
                                <td><?= $t->judul_buku; ?></td>
                                <td><?= $t->penulis; ?></td>
                                <td><?= $t->penerbit; ?></td>
                                <td><?= $t->jumlah; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p>Tidak ada data buku.</p>
        <?php endif; ?>
    </div>
</div>