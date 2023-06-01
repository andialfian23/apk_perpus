<?php defined('BASEPATH') or  exit('No direct script access allowed');

class Pengembalian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->halaman = 'pengembalian';
        $is_login   = $this->session->userdata('is_login');

        if (!$is_login) {
            redirect(base_url());
            return;
        }
    }
    public function index()
    {
        if (!$_POST) {
            $input = (object) ['keywords' => ''];
            $first_load = true;
        } else {
            $input = (object) $this->input->post(null, true);
            $first_load = false;
        }

        $pengembalian = $this->pengembalian->search($input->keywords);
        $halaman = $this->halaman;
        $main_view = 'pengembalian/index';
        $form_action = 'pengembalian';
        $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input', 'first_load', 'pengembalian'));
    }
    public function kembalikan()
    {
        $id_pinjam = post_gan('id_pinjam');
        $denda = post_gan('denda');

        $this->pengembalian->kembalikan($id_pinjam, $denda);
        $peminjaman = $this->db->where('id_pinjam', $id_pinjam)->get('peminjaman');
        $this->pengembalian->ubahStatusBuku($peminjaman->id_buku);

        $this->session->set_flashdata('success', 'Buku sudah dikembalikan.');
        redirect('pengembalian');
    }
}
