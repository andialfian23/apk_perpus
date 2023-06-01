<?php

class MY_Model extends CI_Model
{
    protected $table = '';

    public function __construct()
    {
        parent::__construct();

        if (!$this->table) {
            $this->table = strtolower(str_replace('_model', '', get_class($this)));
        }
    }
    public function validate()
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $validationRules = $this->getValidationRules();
        $this->form_validation->set_rules($validationRules);
        return $this->form_validation->run();
    }
}
