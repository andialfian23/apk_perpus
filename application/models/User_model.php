<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends MY_Model
{
    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required|min_length[4]|max_length[30]|callback_username_unik',
            ],
            [
                'field' => 'nama_user',
                'label' => 'Nama User',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|callback_is_password_required|min_length[4]|max_length[30]',
            ],
            [
                'field' => 'level',
                'label' => 'Level',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'is_blokir',
                'label' => 'Blokir?',
                'rules' => 'trim|required',
            ],
        ];
        return $validationRules;
    }
    public function getDefaultValues()
    {
        return [
            'username' => '',
            'password' => '',
            'nama_user' => '',
            'level' => '',
            'is_blokir' => '',
        ];
    }
    public function getUser($id_user = null)
    {
        return ($id_user == null)
            ? $this->db->get('user')->result()
            :  $this->db->get_where('user', ['id_user' => $id_user]);
    }
}
