<?php
    
class UserRepository {
    
    private function getConnection() {
        
        DEFINE ('DB_USER', 'root');
        DEFINE ('DB_PASSWORD', 'root');
        DEFINE ('DB_HOST', '127.0.0.1:33077');
        DEFINE ('DB_NAME', 'quiz');
        
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        
        if(!$dbc){
            die('error connecting to database');    
        }
        
        return $dbc;
    }
    
    public function getUserIdByEmail($email) {
                
        $sql = "SELECT id 
                FROM quiz.users
                WHERE email = '" . $email . "'";
            
        return UserRepository::getConnection()->query($sql)->fetch_assoc()['id'];
    }
    
    public function getUserByEmailAndPassword($email, $password) {
        
        $password = md5($password);
                
        $sql = "SELECT id 
                FROM quiz.users
                WHERE email = '" . $email . "' AND password = '" . $password . "' AND status = " . 1;

        return UserRepository::getConnection()->query($sql)->fetch_assoc()['id'];
    }
    
    public function registerUser($email, $password, $name) {
        $sql = "INSERT INTO users (user_name, email, password, status, role_id, full_name) VALUES('$email', '$email', '$password', 1, 4, '$name')";

        if (UserRepository::getConnection()->query($sql) === TRUE) {
            UserRepository::getConnection()->commit();
            return UserRepository::getConnection()->insert_id;
        }
    }
    
}

?>