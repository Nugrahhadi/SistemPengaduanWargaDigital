<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // memeriksa login
    public function login($username, $password)
    {
        $this->db->where('username', $username);
        $user = $this->db->get('users')->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    // register user baru
    public function register($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->db->insert('users', $data);
    }

    // mengambil data user based ID
    public function get_user($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    // update profil user
    public function update_profile($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function get_all_users()
    {
        $this->db->where('role', 'warga');
        return $this->db->get('users')->result();
    }
}
