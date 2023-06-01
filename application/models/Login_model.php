<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends MY_Model
{
    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'username',
                'labe;' => 'Username',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password',
                'labe;' => 'Password',
                'rules' => 'trim|required',
            ],
        ];
        return $validationRules;
    }
    public function getDefaultValues()
    {
        return [
            'username' => '',
            'password' => ''
        ];
    }
    public function login($input)
    {
        $input->password = md5($input->password);
        $user = $this->db->where('username', $input->username)
            ->where('password', $input->password)->where('is_blokir', 'n')
            ->limit(1)->get('user')->row();

        if (count($user)) {
            $data = [
                'nama_user' => $user->nama_user,
                'username' => $user->username,
                'level' => $user->level,
                'is_login' => true
            ];
            $this->session->set_userdata($data);
            return true;
        }

        return false;
    }
}
