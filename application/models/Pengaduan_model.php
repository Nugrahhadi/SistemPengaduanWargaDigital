<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // menambah pengaduan baru
    public function tambah_pengaduan($data)
    {
        return $this->db->insert('pengaduan', $data);
    }

    // mendapatkan semua pengaduan
    public function get_all_pengaduan()
    {
        $this->db->select('pengaduan.*, users.nama_lengkap as nama_pelapor, kategori_pengaduan.nama_kategori');
        $this->db->from('pengaduan');
        $this->db->join('users', 'users.id = pengaduan.user_id');
        $this->db->join('kategori_pengaduan', 'kategori_pengaduan.id = pengaduan.kategori_id');
        $this->db->order_by('tanggal_pengaduan', 'DESC');
        return $this->db->get()->result();
    }

    // mendapatkan pengaduan berdasarkan ID
    public function get_pengaduan($id)
    {
        $this->db->select('pengaduan.*, users.nama_lengkap as nama_pelapor, kategori_pengaduan.nama_kategori');
        $this->db->from('pengaduan');
        $this->db->join('users', 'users.id = pengaduan.user_id');
        $this->db->join('kategori_pengaduan', 'kategori_pengaduan.id = pengaduan.kategori_id');
        $this->db->where('pengaduan.id', $id);
        return $this->db->get()->row();
    }

    // mendapatkan pengaduan berdasarkan user_id
    public function get_pengaduan_by_user($user_id)
    {
        $this->db->select('pengaduan.*, kategori_pengaduan.nama_kategori');
        $this->db->from('pengaduan');
        $this->db->join('kategori_pengaduan', 'kategori_pengaduan.id = pengaduan.kategori_id');
        $this->db->where('pengaduan.user_id', $user_id);
        $this->db->order_by('tanggal_pengaduan', 'DESC');
        return $this->db->get()->result();
    }

    // update status pengaduan
    public function update_status($id, $status, $user_id)
    {

        $pengaduan = $this->db->get_where('pengaduan', ['id' => $id])->row();
        $status_lama = $pengaduan->status;

        $this->db->where('id', $id);
        $result = $this->db->update('pengaduan', ['status' => $status]);

        if ($result) {
            $log_data = [
                'pengaduan_id' => $id,
                'status_lama' => $status_lama,
                'status_baru' => $status,
                'user_id' => $user_id
            ];
            $this->db->insert('log_status', $log_data);
        }

        return $result;
    }

    // menghapus pengaduan
    public function delete_pengaduan($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('pengaduan');
    }

    // riwayat status
    public function get_log_status($pengaduan_id)
    {
        $this->db->select('log_status.*, users.nama_lengkap');
        $this->db->from('log_status');
        $this->db->join('users', 'users.id = log_status.user_id');
        $this->db->where('pengaduan_id', $pengaduan_id);
        $this->db->order_by('tanggal_perubahan', 'ASC');
        return $this->db->get()->result();
    }

    // jumlah total pengaduan
    public function count_all_pengaduan()
    {
        return $this->db->count_all('pengaduan');
    }

    // jumlah pengaduan berdasarkan status
    public function count_pengaduan_by_status($status)
    {
        $this->db->where('status', $status);
        return $this->db->count_all_results('pengaduan');
    }
}
