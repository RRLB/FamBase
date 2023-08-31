<?php
//from controller Users we rech into model User and from there we reach into our Database Librairy
class User {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    //Register Function
    public function register($data){
        $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
        //Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //when we do an insert update or delete that is when we want to call execute from the database librairy
        //Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    //Login User
    public function login($email, $password){
        $this->db->query('SELECT * FROM users WHERE email= :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)){
            return $row;
        } else {
            return false;
        }
    }

    //Find user by email
    public function findUserByEmail($email){ 
        $this->db->query('SELECT * FROM users WHERE email = :email');
        //bind value to email
        $this->db->bind(':email', $email);

        //create variable called row and call the single method
        $row = $this->db->single();

        //check row if user email is regestired
        // we created row count function in Database Librairy
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    //Find user by id
    public function getUserById($id){ 
        $this->db->query('SELECT * FROM users WHERE id = :id');
        //bind value to email
        $this->db->bind(':id', $id);

        //create variable called row and call the single method
        $row = $this->db->single();

       return $row;
    }
}