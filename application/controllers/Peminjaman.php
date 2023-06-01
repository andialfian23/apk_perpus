<?php defined('BASEPATH') or  exit('No direct script access allowed');

class Peminjaman extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->halaman = 'peminjaman';
        $is_login   = $this->session->userdata('is_login');

        if (!$is_login) {
            redirect(base_url());
            return;
        }
    }
    public function index()
    {
        $peminjaman = $this->peminjaman->getAllPeminjaman();
        $halaman = $this->halaman;
        $main_view = 'peminjaman/index';
        $this->load->view('template', compact('halaman', 'main_view', 'peminjaman'));
    }
    //CREATE
    public function create()
    {
        $input = (!$_POST)
            ? (object) $this->peminjaman->getDefaultValues()
            : (object) $this->input->post(null, true);

        if (!$this->peminjaman->validate()) {
            $halaman = $this->halaman;
            $main_view = 'peminjaman/form';
            $form_action = 'peminjaman/create';
            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input'));
            return;
        }
        //cek, melebihi jumlah maksimum
        $id_anggota = post_gan('id_anggota');
        if (!$this->peminjaman->cekMaxItem($id_anggota)) {
            $this->session->set_flashdata('error', 'Tidak boleh meminjam lebih dari 2 buku.');
            redirect('peminjaman');
            return;
        }
        //if validate, unset search_anggota and search_buku
        //we dont need these items to save to database
        unset($input->search_anggota);
        unset($input->search_buku);

        if ($this->db->insert('peminjaman', $input)) {
            //ubah status "is_Ada" -> n
            $this->peminjaman->ubahStatusBuku($input->id_buku, 'n');
            $this->session->set_flashdata('success', 'Data peminjaman berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Data peminjaman gagal disimpan.');
        }

        redirect('peminjaman');
    }
    //LIVE SEARCH FOR SISWA
    public function anggota_auto_complete()
    {
        $keywords = post_gan('keywords');
        $anggotas = $this->peminjaman->liveSearchAnggota($keywords);
        foreach ($anggotas as $t) {
            $no_id = str_replace($keywords, '<strong>' . $keywords . '</strong>', $t->no_id);
            $nama_anggota = preg_replace("#($keywords)#i", "<strong>$1</strong>", $t->nama_anggota);
            $str = '<li onclick="setItemAnggota(\'' . $t->nama_anggota . '\'); makeHiddenIdAnggota(\'' . $t->id_anggota . '\')">';
            $str .= "$no_id - $nama_anggota";
            $str .= "</li>";

            echo $str;
        }
    }
    //LIVE SEARCH FOR BUKU
    public function buku_auto_complete()
    {
        $keywords = post_gan('keywords');
        $bukus = $this->peminjaman->liveSearchBuku($keywords);
        foreach ($bukus as $t) {
            $judul_buku = preg_replace("#($keywords)#i", "<strong>$1</strong>", $t->judul_buku);
            $str = '<li onclick="setItemBuku(\'' . $t->judul_buku . '\'); makeHiddenIdBuku(\'' . $t->id_buku . '\')">';
            $str .= "$judul_buku";
            $str .= "</li>";

            echo $str;
        }
    }
}
