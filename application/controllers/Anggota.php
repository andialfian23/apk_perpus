<?php defined('BASEPATH') or  exit('No direct script access allowed');

class Anggota extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->halaman = 'anggota';
        $is_login   = $this->session->userdata('is_login');

        if (!$is_login) {
            redirect(base_url());
            return;
        }
    }
    public function index()
    {
        $anggotas = $this->anggota->getAnggota()->num_rows();
        $halaman = $this->halaman;
        $main_view = 'anggota/index';
        $this->load->view('template', compact('halaman', 'main_view', 'anggotas'));
    }
    public function create()
    {
        $input = (!$_POST)
            ? (object) $this->anggota->getDefaultValues()
            : (object) $this->input->post(null, true);

        if (!$this->anggota->validate()) {
            $halaman = $this->halaman;
            $main_view = 'anggota/form';
            $form_action = 'anggota/create';
            $title = 'Tambah Anggota';
            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input', 'title'));
            return;
        }

        ($this->db->insert('anggota', $input))
            ? $this->session->set_flashdata('success', 'Data anggota berhasil disimpan.')
            : $this->session->set_flashdata('error', 'Data anggota gagal disimpan.');

        redirect('anggota');
    }
    public function alpha_coma_dash_dot_space($str)
    {
        if (!preg_match('/^[a-zA-Z .,\-]+$/i', $str)) {
            $this->form_validation->set_message(
                'alpha_coma_dash_dot_space',
                'Hanya boleh berisi huruf, spasi, tanda hubung(-), titik(.) dan koma(,).'
            );
            return false;
        }
        return true;
    }
    public function alpha_numeric_coma_dash_dot_space($str)
    {
        if (!preg_match('/^[a-zA-Z0-9 \-]+$/i', $str)) {
            $this->form_validation->set_message(
                'alpha_numeric_coma_dash_dot_space',
                'Hanya boleh berisi huruf, Angka, spasi, dan tanda hubung(-).'
            );
            return false;
        }
        return true;
    }
    public function no_id_unik()
    {
        $no_id = post_gan('no_id');
        $id_anggota = post_gan('id_anggota');

        if ($this->db->get_where('anggota', ['no_id' => $no_id, 'id_anggota !=' => $id_anggota])->num_rows()  > 0) {
            $this->form_validation->set_message('no_id_unik', '%s sudah digunakan.');
            return false;
        }
        return true;
    }
    //EDIT
    public function edit($id_anggota = null)
    {
        if ($id_anggota == null) {
            $this->session->set_flashdata('error', 'ID Anggota tidak diketahui.');
            redirect('anggota');
        }

        $anggota = $this->anggota->getAnggota($id_anggota);
        if (!$anggota) {
            $this->session->set_flashdata('warning', 'Data anggota tidak ada.');
            redirect('anggota');
        }

        $input = (!$_POST)
            ? (object) $anggota->row()
            : (object) $this->input->post(null, true);


        if (!$this->anggota->validate()) {
            $halaman = $this->halaman;
            $main_view = 'anggota/form';
            $form_action = "anggota/edit/$id_anggota";
            $title = 'Edit Anggota';
            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input', 'title'));
            return;
        }

        ($this->db->where('id_anggota', $id_anggota)->update('anggota', $input))
            ? $this->session->set_flashdata('success', 'Data anggota berhasil diupdate.')
            : $this->session->set_flashdata('error', 'Data anggota gagal diupdate.');

        redirect('anggota');
    }
    //DELETE
    public function delete($id_anggota = null)
    {
        if ($id_anggota == null) {
            $this->session->set_flashdata('error', 'ID anggota tidak diketahui.');
            redirect('anggota');
        }

        if (!$this->anggota->getAnggota($id_anggota)) {
            $this->session->set_flashdata('warning', 'Data anggota tidak ada.');
            redirect('anggota');
        }

        ($this->db->delete('anggota', ['id_anggota' => $id_anggota]))
            ? $this->session->set_flashdata('success', 'Data anggota berhasil dihapus.')
            : $this->session->set_flashdata('error', 'Data anggota gagal dihapus.');

        redirect('anggota');
    }
    //JSON
    public function json()
    {
        if (empty($_POST['search']['value'])) {
            $_POST['search']['value'] = '';
        }
        if (empty($_POST['length'])) {
            $_POST['length'] = '10';
            $_POST['start'] = '0';
            $_POST['draw'] = null;
        }

        $list   = $this->anggota->get_datatables();
        $data   = [];
        $no = 1;
        foreach ($list as $key) {
            $row            = array();
            $row['no_id']      = $key->no_id;
            $row['nama_anggota']      = $key->nama_anggota;
            $row['ket']      = $key->ket;
            $row['edit']   = anchor("anggota/edit/$key->id_anggota", 'Edit', ['class' => 'btn btn-sm btn-warning']);
            $row['delete']   = anchor("anggota/delete/$key->id_anggota", 'Hapus', ['class' => 'btn btn-sm btn-danger']);
            $data[]   = $row;
            $no++;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsFiltered"   => $this->anggota->total_entri_terfilter(),
            "recordsTotal"      => $this->anggota->total_entri(),
            "data"              => $data,
        );

        echo json_encode($output);
    }
}
