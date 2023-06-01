<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="text-gray-800">Peminjaman</h4>
    </div>
    <div class="card-body">

        <?= form_open($form_action, ['id' => 'form-peminjaman', 'autocomplete' => 'off']) ?>

        <div class="row form-group">
            <label for="tanggal_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="<?= $input->tanggal_pinjam; ?>">
            </div>
            <div class="col-sm-5">
                <?= form_error('tanggal_pinjam') ?>
            </div>
        </div>
        <div class="row form-group">
            <!-- <label for="search_anggota" class="">Anggota</label> -->
            <?= form_label('Anggota', 'search_anggota', ['class' => 'label col-sm-2 col-form-label']) ?>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="search_anggota" name="search_anggota" value="<?= $input->search_anggota; ?>" onkeyup="anggotaAutoComplete()" placeholder="Masukkan NIS atau Nama Anggota">
                <ul id="anggota_list" class="live-search-list"></ul>
            </div>
            <div class="col-sm-5">
                <?= form_error('search_anggota') ?>
            </div>
        </div>
        <div class="row form-group">
            <!-- <label for="search_anggota" class="">Anggota</label> -->
            <?= form_label('Buku', 'search_buku', ['class' => 'label col-sm-2 col-form-label']) ?>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="search_buku" name="search_buku" value="<?= $input->search_buku; ?>" onkeyup="bukuAutoComplete()" placeholder="Masukkan Judul buku">
                <ul id="buku_list" class="live-search-list"></ul>
            </div>
            <div class="col-sm-5">
                <?= form_error('search_buku') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8 text-center">
                <?= form_button(['type' => 'submit', 'content' => 'Simpan', 'class' => 'btn btn-primary']) ?>
            </div>
        </div>

        <?= isset($input->id_anggota) ? form_input(['type' => 'text', 'name' => 'id_anggota', 'id' => 'id-anggota', 'value' => $input->id_anggota]) : '' ?>
        <?= isset($input->id_buku) ? form_input(['type' => 'text', 'name' => 'id_buku', 'id' => 'id-buku', 'value' => $input->id_buku]) : '' ?>

        <?= form_close() ?>