<?php

namespace Crud\App;
include 'Database.php';

class User
{
    private $name;
    private $age;
    private $email;

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function registration($name,$age,$email)
    {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;

        $this->db->saveData([
            'id' => uniqid(),
            'name' => $this->name,
            'age' => $this->age,
            'email' => $this->email
        ]);
    }

    public function pick_user_information($id)
    {
        return $this->db->search_user_info($id);
    }

    public function update($id, $name, $age, $email)
    {
        $this->db->updateData($id, $name, $age, $email);
    }

    public function delete($id)
    {
        $this->db->deleteInfo($id);
    }

}