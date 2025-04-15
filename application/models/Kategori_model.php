<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_kategori() {
        return $this->db->get('kategori_pengaduan')->result();
    }
    
    public function get_kategori($id) {
        return $this->db->get_where('kategori_pengaduan', ['id' => $id])->row();
    }
}