<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="text-gray-800"><?= $title; ?></h4>
    </div>
    <div class="card-body">
        <?= form_open($form_action) ?>
        <?= isset($input->id_anggota) ? form_hidden('id_anggota', $input->id_anggota) : ''; ?>
        <div class="row form-group">
            <label for="no_id" class="col-sm-2 col-form-label">Nomor ID</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="no_id" name="no_id" value="<?= $input->no_id; ?>">
            </div>
            <div class="col-sm-5">
                <?= form_error('no_id') ?>
            </div>
        </div>
        <div class="row form-group">
            <label for="nama_anggota" class="col-sm-2 col-form-label">Nama Anggota</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" value="<?= $input->nama_anggota; ?>">
            </div>
            <div class="col-sm-5">
                <?= form_error('nama_anggota') ?>
            </div>
        </div>
        <div class="row form-group">
            <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-5">
                <label class="block-label">
                    <?= form_radio('jenis_kelamin', 'L', isset($input->jenis_kelamin)
                        && ($input->jenis_kelamin == 'L') ? true : false) ?> Laki-laki
                </label>
                <label class="block-label">
                    <?= form_radio('jenis_kelamin', 'P', isset($input->jenis_kelamin)
                        && ($input->jenis_kelamin == 'P') ? true : false) ?> Perempuan
                </label>
            </div>
            <div class="col-sm-5">
                <?= form_error('jenis_kelamin') ?>
            </div>
        </div>
        <div class="row form-group">
            <label for="ket" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="ket" name="ket" value="<?= $input->ket; ?>">
            </div>
            <div class="col-sm-5">
                <?= form_error('ket') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-2">&nbsp;</div>
            <div class="col-8">
                <?= form_button(['type' => 'submit', 'content' => 'Simpan', 'class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?= form_close() ?>

    </div>
</div>