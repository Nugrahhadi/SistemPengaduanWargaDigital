<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tanggapan_model extends CI_Model {

    public function __contruct() {
        parent::__construct();
    }

    public function tambah_tanggapan($data) {
        return $this->db->insert('tanggapan', $data);
    }

    // mengambil tanggapan sesuai id pengaduan
    public function get_tanggapan_by_pengaduan($pengaduan_id) {
        $this->db->select('tanggapan.*, users.nama_lengkap, users.role');
        $this->db->from('tanggapan');
        $this->db->join('users', 'users.id = tanggapan.user_id');
        $this->db->where('pengaduan_id', $pengaduan_id);
        $this->db->order_by('tanggal_tanggapan', 'ASC');
        return $this->db->get()->result();
    }

    // hapus tanggapoan
    public function hapus_tanggapan($id) {
        $this->db->where('id', $id);
        return $this->db->delete('tanggapan');
    }
}