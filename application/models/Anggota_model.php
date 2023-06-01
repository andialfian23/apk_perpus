<?php defined('BASEPATH') or exit('No direct script access allowed');

class Anggota_model extends MY_Model
{
    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'no_id',
                'label' => 'Nomor ID',
                'rules' => 'trim|required|numeric|exact_length[4]|callback_no_id_unik',
            ],
            [
                'field' => 'nama_anggota',
                'label' => 'Nama Anggota',
                'rules' => 'trim|required|max_length[50]|callback_alpha_coma_dash_dot_space',
            ],
            [
                'field' => 'jenis_kelamin',
                'label' => 'Jenis Kelamin',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'ket',
                'label' => 'Keterangan',
                'rules' => 'trim|required|callback_alpha_numeric_coma_dash_dot_space',
            ],
        ];
        return $validationRules;
    }
    public function getDefaultValues()
    {
        return [
            'no_id' => '',
            'nama_anggota' => '',
            'jenis_kelamin' => '',
            'ket' => '',
        ];
    }
    public function getAnggota($id_anggota = null)
    {
        return ($id_anggota == null)
            ?  $this->db->order_by('no_id', 'ASC')->get('anggota')
            :   $this->db->get_where('anggota', ['id_anggota' => $id_anggota]);
    }
    //DATATABLE
    protected $table = 'anggota';
    protected $order            = ['no_id' => 'asc'];
    protected $column_order     = ['no_id', 'nama_anggota', 'ket'];
    protected $column_search    = ['no_id', 'nama_anggota', 'ket'];
    private function _get_query()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            if ($query) {
                return $query->result();
            }
        } else {
            $query = $this->db->get();
            if ($query) {
                return $query->result();
            }
        }
    }
    function total_entri_terfilter()
    {
        $this->_get_query();
        return $this->db->get()->num_rows();
    }
    function total_entri()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
