<?php defined('BASEPATH') or  exit('No direct script access allowed');

class Judul extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->halaman = 'buku';
    }
    public function index($page = null)
    {
        $juduls = $this->judul->getAllJudul($page);
        $jumlah = $this->judul->getAllJudulCount()->jumlah;
        $halaman = $this->halaman;
        $main_view = 'judul/index';
        $pagination = $this->judul->makePagination(site_url('judul'), 2, $jumlah);
        $this->load->view('template', compact('halaman', 'main_view', 'juduls', 'pagination', 'jumlah'));
    }
    //SEARCH
    public function search($page = null)
    {
        $keywords = get_gan('keywords', true);
        $juduls = $this->judul->searchJudul($keywords, $page);
        $jml = $this->judul->searchJudulCount($keywords);
        $jumlah = count($jml);
        $pagination = $this->judul->makePagination(site_url('judul/search/'), 3, $jumlah);

        if (!$juduls) {
            $this->session->set_flashdata('warning', 'Data Tidak Ditemukan.');
            redirect('judul');
        }

        $halaman = $this->halaman;
        $main_view = 'judul/index';
        $this->load->view('template', compact('halaman', 'main_view', 'juduls', 'pagination', 'jumlah'));
    }
    protected function isLogin()
    {
        $isLogin = session_gan('is_login');
        if (!$isLogin) {
            redirect(base_url());
        }
    }
    //CREATE
    public function create()
    {
        $this->isLogin();
        $input = (!$_POST)
            ? (object) $this->judul->getDefaultValues()
            : (object) $this->input->post(null, true);

        if (!empty($_FILES) && $_FILES['cover']['size'] > 0) {
            $coverFileName = date('YmdHis');
            $upload = $this->judul->uploadCover('cover', $coverFileName);
            if ($upload) {
                $input->cover = $this->upload->data('file_name');
                // $this->judul->coverResize('cover', "./cover/$coverFileName.jpg", 100, 150);
            }
        }

        if (!$this->judul->validate() || $this->form_validation->error_array()) {
            $halaman = $this->halaman;
            $main_view = 'judul/form';
            $form_action = 'judul/create';
            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input'));
            return;
        }

        ($this->db->insert('judul', $input))
            ? $this->session->set_flashdata('success', 'Data judul berhasil disimpan.')
            : $this->session->set_flashdata('error', 'Data judul gagal disimpan.');

        redirect('judul');
    }
    public function isbn_unik()
    {
        $isbn = $this->input->post('isbn', true);
        $id_judul = $this->input->post('id_judul', true);

        if ($this->db->get_where('judul', ['isbn' => $isbn, 'id_judul!=' => $id_judul])->num_rows() > 0) {
            $this->form_validation->set_message('isbn_unik', '%s sudah digunakan.');
            return false;
        }
        return true;
    }
    //EDIT
    public function edit($id = null)
    {
        $this->isLogin();
        $judul = $this->db->get_where('judul', ['id_judul' => $id]);
        if (!$judul) {
            $this->session->set_flashdata('warning', 'Data judul tidak ada.');
            redirect('judul');
        }
        $judul = $judul->row();

        if (!$_POST) {
            $input = (object) $judul;
        } else {
            $input = (object) $this->input->post(null, true);
            $input->cover = $judul->cover;
        }

        if (!empty($_FILES) && $_FILES['cover']['size'] > 0) {
            $coverFileName = date('YmdHis');
            $upload = $this->judul->uploadCover('cover', $coverFileName);
            if ($upload) {
                // ($judul->cover) || $this->judul->deleteCover($judul->cover);
                $this->judul->deleteCover($judul->cover);

                $input->cover = $this->upload->data('file_name');
                // $this->judul->coverResize('cover', "./cover/$coverFileName.jpg", 100, 150);

            }
        }

        if (!$this->judul->validate()) {
            $halaman = $this->halaman;
            $main_view = 'judul/form';
            $form_action = "judul/edit/$id";
            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input'));
            return;
        }

        ($this->db->where('id_judul', $id)->update('judul', $input))
            ? $this->session->set_flashdata('success', 'Data judul berhasil diupdate.')
            : $this->session->set_flashdata('error', 'Data judul gagal diupdate.');


        redirect('judul');
    }
    //DELETE
    public function delete($id = null)
    {
        $this->isLogin();

        $judul = $this->judul->where('id_judul', $id)->get();
        if (!$judul) {
            $this->session->set_flashdata('warning', 'Data judul tidak ada.');
            redirect('judul');
        }

        if ($this->judul->where('id_judul', $id)->delete()) {
            $this->judul->deleteCover($judul->cover);
            $this->session->set_flashdata('success', 'Data judul berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Data judul gagal dihapus.');
        }

        redirect('judul');
    }
}
