<?php

abstract class BaseRepository
{
    function getConnection() {

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

}