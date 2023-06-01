<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="text-gray-800">Laporan Peminjaman</h4>
    </div>
    <div class="card-body">

        <?= form_open($form_action) ?>
        <div class="row form-group">
            <div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-light" type="button">Tanggal Awal</button>
                    </span>
                    <input type="date" class="form-control" aria-label="Tanggal Awal" value="<?= $input->tanggal_awal; ?>" name="tanggal_awal" id="tanggal_awal">
                </div>
            </div>
            <div class="col-sm-5">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-light" type="button">Tanggal Akhir</button>
                    </span>
                    <input type="date" class="form-control" aria-label="Product name" value="<?= $input->tanggal_akhir; ?>" name="tanggal_akhir" id="tanggal_akhir">
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" type="submit">Cari</button>
                    </span>
                </div>
            </div>
        </div>
        <?= form_close() ?>


        <?php if (!$first_load) : ?>
            <div class="row">
                <div class="col-sm-12">
                    <?php if ($peminjamans) : ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm" <?= ($jumlah_total > 10) ? 'id="dataTable"' : ''; ?> width="100%" cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl. Pinjam</th>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Kode Buku</th>
                                        <th>Judul Buku</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($peminjamans as $t) : ?>
                                        <tr>
                                            <td><?= ++$i; ?></td>
                                            <td><?= $t->tanggal_pinjam; ?></td>
                                            <td><?= $t->no_id; ?></td>
                                            <td><?= $t->nama_anggota; ?></td>
                                            <td><?= $t->kode_buku; ?></td>
                                            <td><?= $t->judul_buku; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">Jumlah Total : <?= isset($jumlah_total) ? $jumlah_total : ''; ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php else : ?>
                        <p>Tidak ada data peminjaman.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($peminjamans) : ?>
            <div class="row">
                <div class="col-10">
                    <?php
                    $tanggal_awal = post_true('tanggal_awal');
                    $tanggal_akhir = post_true('tanggal_akhir');
                    ?>
                    <?= anchor(
                        "cetak-laporan-peminjaman/$tanggal_awal/$tanggal_akhir",
                        'Cetak',
                        ['class' => 'btn btn-success', 'target' => '_blank']
                    ) ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>