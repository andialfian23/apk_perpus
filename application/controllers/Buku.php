<?php defined('BASEPATH') or  exit('No direct script access allowed');

class Buku extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->halaman = 'buku';
    }
    protected function isLogin()
    {
        $isLogin = session_gan('is_login');
        if (!$isLogin) {
            redirect(base_url());
        }
    }
    public function create()
    {
        $this->isLogin();

        $id_judul = $this->input->post('id_judul');
        if (empty($id_judul)) {
            redirect('judul');
        }

        $judul = $this->db->get_where('judul', ['id_judul' => $id_judul])->row();

        $input = (!$_POST)
            ? (object) $this->buku->getDefaultValues()
            : (object) $this->input->post(null, true);

        $halaman = $this->halaman;
        $main_view = 'buku/form';
        $form_action = 'buku/create';

        if (!$this->buku->validate()) {
            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input', 'judul'));
            return;
        }

        ($this->db->insert('buku', $input))
            ? $this->session->set_flashdata('success', 'Data buku berhasil disimpan.')
            : $this->session->set_flashdata('error', 'Data buku gagal disimpan.');


        redirect('judul');
    }
    public function alpha_coma_dash_dot_space($str)
    {
        if (!preg_match('/^[a-zA-Z0-9 .,\-]+$/i', $str)) {
            $this->form_validation->set_message(
                'alpha_coma_dash_dot_space',
                'Hanya boleh berisi huruf, spasi, tanda hubung(-), titik(.) dan koma(,).'
            );
            return false;
        }
        return true;
    }
    public function kode_buku_unik()
    {
        $kode_buku = $this->input->post('kode_buku', true);
        $id_judul = $this->input->post('id_judul', true);

        if ($this->db->get_where('buku', ['kode_buku' => $kode_buku, 'id_judul' => $id_judul])->num_rows() > 0) {
            $this->form_validation->set_message('kode_buku_unik', '%s sudah digunakan.');
            return false;
        }
        return true;
    }
    //SHOW ALL BOOK
    public function total($id_judul = null)
    {
        if (is_null($id_judul)) {
            redirect('judul');
        }

        $bukus = $this->buku->total($id_judul);
        $halaman = $this->halaman;
        $main_view = 'siswa/total';
        $this->load->view('template', compact('halaman', 'main_view', 'bukus'));
    }
    //SHOW BUKU YANG ADA
    public function ada($id_judul = null)
    {
        if (is_null($id_judul)) {
            redirect('judul');
        }

        $bukus = $this->buku->ada($id_judul);
        $halaman = $this->halaman;
        $main_view = 'siswa/ada';
        $title = 'Buku (Ada)';
        $this->load->view('template', compact('halaman', 'main_view', 'bukus', 'title'));
    }
    //SHOW BUKU YANG DIPINJAM
    public function dipinjam($id_judul = null)
    {
        if (is_null($id_judul)) {
            redirect('judul');
        }

        $bukus = $this->buku->dipinjam($id_judul);
        $halaman = $this->halaman;
        $main_view = 'siswa/dipinjam';
        $this->load->view('template', compact('halaman', 'main_view', 'bukus'));
    }
    //DELETE
    public function delete($id = null)
    {
        $this->isLogin();

        $id_buku = $this->input->post('id_buku');
        $buku = $this->buku->where('id_buku', $id)->get();
        if (!$buku) {
            $this->session->set_flashdata('warning', 'Data buku tidak ada.');
            redirect('buku');
        }

        $this->buku->deleteCover($buku->cover);
        ($this->db->where('id_buku', $id)->delete('buku'))
            ? $this->session->set_flashdata('success', 'Data buku berhasil dihapus.')
            : $this->session->set_flashdata('error', 'Data buku gagal dihapus.');

        redirect('judul');
    }
}
