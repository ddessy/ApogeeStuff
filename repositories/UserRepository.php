<?php

include 'repositories/BaseRepository.php';

class UserRepository extends BaseRepository {

    public function getUserIdByEmail($email) {

        $sql = "SELECT id 
                FROM quiz.users
                WHERE email = '" . $email . "'";

        return BaseRepository::getConnection()->query($sql)->fetch_assoc()['id'];
    }

    public function getUserByEmailAndPassword($email, $password) {

        $password = md5($password);

        $sql = "SELECT id 
                FROM quiz.users
                WHERE email = '" . $email . "' AND password = '" . $password . "' AND status = " . 1;

        return BaseRepository::getConnection()->query($sql)->fetch_assoc()['id'];
    }

    public function registerUser($email, $password, $name) {
        $sql = "INSERT INTO users (user_name, email, password, status, role_id, full_name) VALUES('$email', '$email', '$password', 1, 4, '$name')";

        if (BaseRepository::getConnection()->query($sql) === TRUE) {
            BaseRepository::getConnection()->commit();
            return BaseRepository::getConnection()->insert_id;
        }
    }

}

?>