<div class="card shadow mb-4">
    <div class="card-body">

        <?= form_open($form_action) ?>
        <?= isset($input->id_user) ? form_hidden('id_user', $input->id_user) : ''; ?>
        <div class="row form-group">
            <div class="col-md-2">
                <?= form_label('Nama User', 'nama_user', ['class' => 'label']) ?>
            </div>
            <div class="col-md-4">
                <?= form_input(['type' => 'text', 'name' => 'nama_user', 'id' => 'nama_user', 'value' => $input->nama_user, 'class' => 'form-control', 'placeholder' => 'Nama User']) ?>
            </div>
            <div class="col-md-4">
                <?= form_error('nama_user') ?>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <?= form_label('Username', 'username', ['class' => 'label']) ?>
            </div>
            <div class="col-md-4">
                <?= form_input(['type' => 'text', 'name' => 'username', 'id' => 'username', 'value' => $input->username, 'class' => 'form-control', 'placeholder' => 'Username']) ?>
            </div>
            <div class="col-md-4">
                <?= form_error('username') ?>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <?= form_label('Password', 'password', ['class' => 'label']) ?>
            </div>
            <div class="col-md-4">
                <?= form_input(['type' => 'password', 'name' => 'password', 'id' => 'password', 'value' => $input->password, 'class' => 'form-control', 'placeholder' => 'Password']) ?>
            </div>
            <div class="col-md-4">
                <?= form_error('password') ?>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <p class="label">Level</p>
            </div>
            <div class="col-md-4">
                <label class="block-label">
                    <?= form_radio('level', 'operator', isset($input->level)
                        && ($input->level == 'operator') ? true : false) ?> Operator
                </label>
                <label class="block-label">
                    <?= form_radio('level', 'admin', isset($input->level)
                        && ($input->level == 'admin') ? true : false) ?> Administrator
                </label>
            </div>
            <div class="col-md-4">
                <?= form_error('level') ?>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2">
                <p class="label">Blokir?</p>
            </div>
            <div class="col-md-4">
                <label class="block-label">
                    <?= form_radio('is_blokir', 'y', isset($input->is_blokir)
                        && ($input->is_blokir == 'y') ? true : false) ?> Ya
                </label>
                <label class="block-label">
                    <?= form_radio('is_blokir', 'n', isset($input->is_blokir)
                        && ($input->is_blokir == 'n') ? true : false) ?> Tidak
                </label>
            </div>
            <div class="col-md-4">
                <?= form_error('is_blokir') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8">
                <?= form_button(['type' => 'submit', 'content' => 'Simpan', 'class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>