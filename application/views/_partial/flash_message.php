<?php
$success = $this->session->flashdata('success');
$error = $this->session->flashdata('error');
$warning = $this->session->flashdata('warning');

if ($error) {
    $message_status = 'error';
    $message = $error;
}

if ($warning) {
    $message_status = 'warning';
    $message = $warning;
}

if ($success) {
    $message_status = 'success';
    $message = $success;
}

if ($success || $warning || $error) : ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-<?= $message_status ?>" role="alert">
                <?= $message; ?>
            </div>
        </div>
    </div>
<?php endif; ?>