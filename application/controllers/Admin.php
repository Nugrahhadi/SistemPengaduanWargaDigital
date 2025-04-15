<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/logout');
        }
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard Admin';
        $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));
        $data['total_pengaduan'] = $this->Pengaduan_model->count_all_pengaduan();
        $data['pengaduan_baru'] = $this->Pengaduan_model->count_pengaduan_by_status('baru');
        $data['pengaduan_diproses'] = $this->Pengaduan_model->count_pengaduan_by_status('diproses');
        $data['pengaduan_selesai'] = $this->Pengaduan_model->count_pengaduan_by_status('selesai');

        $this->load->view('templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function daftar_pengaduan()
    {
        $data['title'] = 'Daftar Pengaduan';
        $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));
        $data['pengaduan'] = $this->Pengaduan_model->get_all_pengaduan();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/daftar_pengaduan', $data);
        $this->load->view('templates/footer');
    }

    public function detail_pengaduan($id)
    {
        $pengaduan = $this->Pengaduan_model->get_pengaduan($id);

        // Cek apakah ada pengaduan
        if (!$pengaduan) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pengaduan tidak ditemukan!</div>');
            redirect('admin/daftar_pengaduan');
        }

        $data['title'] = 'Detail Pengaduan';
        $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));
        $data['pengaduan'] = $pengaduan;
        $data['tanggapan'] = $this->Tanggapan_model->get_tanggapan_by_pengaduan($id);
        $data['log_status'] = $this->Pengaduan_model->get_log_status($id);

        // Form validasi tanggapan
        $this->form_validation->set_rules('tanggapan', 'Tanggapan', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/detail_pengaduan', $data);
            $this->load->view('templates/footer');
        } else {
            // Tambah tanggapan
            $tanggapan_data = [
                'pengaduan_id' => $id,
                'user_id' => $this->session->userdata('user_id'),
                'tanggapan' => htmlspecialchars($this->input->post('tanggapan', true))
            ];

            if ($this->Tanggapan_model->tambah_tanggapan($tanggapan_data)) {

                if ($this->input->post('update_status')) {
                    $this->Pengaduan_model->update_status($id, $this->input->post('status'), $this->session->userdata('user_id'));
                }

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tanggapan berhasil ditambahkan!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan tanggapan!</div>');
            }
            redirect('admin/detail_pengaduan/' . $id);
        }
    }

    public function update_status($id)
    {
        $pengaduan = $this->Pengaduan_model->get_pengaduan($id);

        // Cek ada/tidak pengaduan
        if (!$pengaduan) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pengaduan tidak ditemukan!</div>');
            redirect('admin/daftar_pengaduan');
        }

        // Validasi form
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Status tidak valid!</div>');
            redirect('admin/detail_pengaduan/' . $id);
        } else {
            $status = $this->input->post('status');

            if ($this->Pengaduan_model->update_status($id, $status, $this->session->userdata('user_id'))) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Status pengaduan berhasil diperbarui!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal memperbarui status pengaduan!</div>');
            }
            redirect('admin/detail_pengaduan/' . $id);
        }
    }

    public function hapus_pengaduan($id)
    {
        $pengaduan = $this->Pengaduan_model->get_pengaduan($id);

        if (!$pengaduan) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pengaduan tidak ditemukan!</div>');
            redirect('admin/daftar_pengaduan');
        }

        if ($this->Pengaduan_model->delete_pengaduan($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengaduan berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus pengaduan!</div>');
        }
        redirect('admin/daftar_pengaduan');
    }

    public function daftar_warga()
    {
        $data['title'] = 'Daftar Warga';
        $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));
        $data['warga'] = $this->User_model->get_all_users();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/daftar_warga', $data);
        $this->load->view('templates/footer');
    }
}
