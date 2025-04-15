<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect($this->session->userdata('role') == 'admin' ? 'admin/dashboard' : 'warga/dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Sistem Pengaduan Warga';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        } else {
            $this->_login();
        }
    }

    //login
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->login($username, $password);

        if ($user) {
            $data = [
                'user_id' => $user->id,
                'username' => $user->username,
                'nama_lengkap' => $user->nama_lengkap,
                'role' => $user->role,
                'logged_in' => TRUE
            ];

            $this->session->set_userdata($data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil login!</div>');
            redirect($user->role == 'admin' ? 'admin/dashboard' : 'warga/dashboard');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username atau password salah!</div>');
            redirect('auth');
        }
    }

    //register
    public function register()
    {
        if ($this->session->userdata('logged_in')) {
            redirect($this->session->userdata('role') == 'admin' ? 'admin/dashboard' : 'warga/dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password]');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Register Sistem Pengaduan Warga';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => $this->input->post('password'),
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
                'role' => 'warga'
            ];

            if ($this->User_model->register($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendaftaran berhasil! Silakan login.</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mendaftar! Silakan coba lagi.</div>');
                redirect('auth/register');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nama_lengkap');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('logged_in');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil logout!</div>');
        redirect('auth');
    }
}
