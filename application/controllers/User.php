<?php defined('BASEPATH') or  exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->halaman = 'user';
        $level      = $this->session->userdata('level');
        $is_login   = $this->session->userdata('is_login');

        if (!$is_login) {
            redirect(base_url());
            return;
        }

        if ($level != 'admin') {
            redirect(base_url());
            return;
        }
    }
    public function index()
    {
        $users = $this->user->getUser();
        $halaman = $this->halaman;
        $main_view = 'user/index';
        $title = 'Data User';
        $this->load->view('template', compact('halaman', 'main_view', 'users', 'title'));
    }
    public function create()
    {
        $input = (!$_POST)
            ? (object) $this->user->getDefaultValues()
            : (object) $this->input->post(null, true);


        if (!$this->user->validate()) {
            $halaman = $this->halaman;
            $main_view = 'user/form';
            $form_action = 'user/create';
            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input'));
            return;
        }

        $input->password = md5($input->password);

        ($this->db->insert('user', $input))
            ? $this->session->set_flashdata('success', 'Data user berhasil disimpan.')
            : $this->session->set_flashdata('error', 'Data user gagal disimpan.');


        redirect('user');
    }
    public function is_password_required()
    {
        $edit = $this->uri->segment(2);

        if ($edit != 'edit') {
            $password = $this->input->post('password', true);
            if (empty($password)) {
                $this->form_validation->set_message('is_password_required', '%s harus diisi.');
                return false;
            }
        }
        return true;
    }
    public function username_unik()
    {
        $username = $this->input->post('username');
        $id_user = $this->input->post('id_user');

        if ($this->db->get_where('user', ['username' => $username, 'id_user !=' => $id_user])->num_rows()) {
            $this->form_validation->set_message('username_unik', '%s sudah digunakan.');
            return false;
        }
        return true;
    }
    //EDIT
    public function edit($id_user = null)
    {
        if ($id_user == null) {
            $this->session->set_flashdata('error', 'ID Tidak diketahui.');
            redirect('user');
        }

        $user = $this->user->getUser($id_user);
        if ($user->num_rows() < 1) {
            $this->session->set_flashdata('warning', 'Data user tidak ada.');
            redirect('user');
        }

        if (!$_POST) {
            $input = (object) $user->row();
            $input->password = '';
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->user->validate()) {
            $halaman = $this->halaman;
            $main_view = 'user/form';
            $form_action = "user/edit/$id_user";
            $title = 'Edit User';
            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input', 'title'));
            return;
        }

        if (!empty($input->password)) {
            $input->password = md5($input->password);
        } else {
            unset($input->password);
        }

        ($this->db->where('id_user', $id_user)->update('user', $input))
            ? $this->session->set_flashdata('success', 'Data user berhasil diupdate.')
            : $this->session->set_flashdata('error', 'Data user gagal diupdate.');


        redirect('user');
    }
    //DELETE
    public function delete($id_user = null)
    {
        if ($id_user == null) {
            $this->session->set_flashdata('error', 'ID User tidak diketahui.');
            redirect('user');
        }

        if ($this->user->getUser($id_user)->num_rows() < 1) {
            $this->session->set_flashdata('warning', 'Data user tidak ada.');
            redirect('user');
        }

        ($this->db->delete('user', ['id_user' => $id_user]))
            ? $this->session->set_flashdata('success', 'Data user berhasil dihapus.')
            : $this->session->set_flashdata('error', 'Data user gagal dihapus.');

        redirect('user');
    }
}
