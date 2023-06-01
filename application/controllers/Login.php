<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function index()
    {
        $input = (!$_POST)
            ? (object) $this->login->getDefaultValues()
            : (object) $this->input->post(null, true);


        if (!$this->login->validate()) {
            $this->load->view('login_form', compact('input'));
            return;
        }

        ($this->login->login($input))
            ? redirect(base_url())
            : $this->session->set_flashdata('error', 'Username atau password salah, atau akun anda sedang di blokir');

        redirect('login');
    }
    public function logout()
    {
        $data_session = [
            'username' => null,
            'level' => null,
            'is_login' => null
        ];
        $this->session->unset_userdata($data_session);
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
