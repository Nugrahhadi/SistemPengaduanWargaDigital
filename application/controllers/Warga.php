<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warga extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        if ($this->session->userdata('role') !== 'warga') {
            redirect('auth/logout');
        }
    }

    public function dashboard()
    {
        $data['title'] = 'Dahboard Warga';
        $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));
        $data['pengaduan'] = $this->Pengaduan_model->get_pengaduan_by_user($this->session->userdata('user_id'));

        $this->load->view('templates/header', $data);
        $this->load->view('warga/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_pengaduan()
    {
        $data['title'] = 'Tambah Pengaduan';
        $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));
        $data['kategori'] = $this->Kategori_model->get_all_kategori();

        $this->form_validation->set_rules('judul', 'Judul Pengaduan', 'required|trim');
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required');
        $this->form_validation->set_rules('isi_laporan', 'Isi Laporan', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('warga/tambah_pengaduan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'user_id' => $this->session->userdata('user_id'),
                'kategori_id' => $this->input->post('kategori_id'),
                'judul' => htmlspecialchars($this->input->post('judul', true)),
                'isi_laporan' => htmlspecialchars($this->input->post('isi_laporan', true))
            ];

            if ($this->Pengaduan_model->tambah_pengaduan($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengaduan berhasil ditambahkan!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan pengaduan!</div>');
            }
            redirect('warga/dashboard');
        }
    }

    public function detail_pengaduan($id)
    {
        $pengaduan = $this->Pengaduan_model->get_pengaduan($id);

        if (!$pengaduan || $pengaduan->user_id != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role+"alert">Pengaduan tidak ditemukan!</div>');
            redirect('warga/dashboard');
        }

        $data['title'] = 'Detail Pengaduan';
        $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));
        $data['pengaduan'] = $pengaduan;
        $data['tanggapan'] = $this->Tanggapan_model->get_tanggapan_by_pengaduan($id);
        $data['log_status'] = $this->Pengaduan_model->get_log_status($id);

        // validasi tanggapan
        $this->form_validation->set_rules('tanggapan', 'Tanggapan', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('warga/detail_pengaduan', $data);
            $this->load->view('templates/footer');
        } else {
            $tanggapan_data = [
                'pengaduan_id' => $id,
                'user_id' => $this->session->userdata('user_id'),
                'tanggapan' => htmlspecialchars($this->input->post('tanggapan', true))
            ];

            if ($this->Tanggapan_model->tambah_tanggapan($tanggapan_data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tanggapan berhasil ditambahkan!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan tanggapan!</div>');
            }
            redirect('warga/detail_pengaduan/' . $id);
        }
    }

    public function profile()
    {
        $data['title'] = 'Profil saya';
        $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('warga/profile', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'no_telp' => htmlspecialchars($this->input->post('no_telp', true))
            ];

            if ($this->User_model->update_profile($this->session->userdata('user_id'), $data)) {
                $this->session->set_userdata('nama_lengkap', $data['nama_lengkap']);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil berhasil diperbarui!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal memperbarui profil!</div>');
            }
            redirect('warga/profile');
        }
    }
}
