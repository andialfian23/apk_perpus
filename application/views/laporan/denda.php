<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="text-gray-800">Laporan Denda</h4>
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
                <div class="col-10">
                    <?php if ($dendas) : ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm" <?= ($jumlah_total > 10) ? 'id="dataTable"' : ''; ?> width="100%" cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($dendas as $t) : ?>
                                        <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                                        <td><?= ++$i; ?></td>
                                        <td><?= $t->tanggal_kembali; ?></td>
                                        <td><?= $t->no_id; ?></td>
                                        <td><?= $t->nama_anggota; ?></td>
                                        <td><?= $t->jumlah; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            Jumlah Total: Rp. <?= isset($jumlah_total) ? number_format($jumlah_total, 0, ',', '.') : ''; ?>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php else : ?>
                        <p>Tidak ada data denda.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($dendas) : ?>
            <div class="row">
                <div class="col-10">
                    <?php
                    $tanggal_awal = post_true('tanggal_awal');
                    $tanggal_akhir = post_true('tanggal_akhir');
                    ?>
                    <?= anchor(
                        "cetak-laporan-denda/$tanggal_awal/$tanggal_akhir",
                        'Cetak Laporan Denda',
                        ['class' => 'btn btn-success', 'target' => '_blank']
                    ) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>