<?php

namespace app\models;

class Connection extends \Illuminate\Database\Eloquent\Model{

    function getConnection() {
        $dbhost="127.0.0.1";
        $dbuser="root";
        $dbpass= "root";
        $dbname="blogslim";
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }

    function getUsers($conn) {
        $sql =  'SELECT * from utilisateurs';
        foreach  ($conn->query($sql) as $row) {
            print $row['pseudo'] . "\t";
            print  $row['nom'] . "\t";
            print $row['prenom'] . "\n";
        }
    }

    function addUser($conn, $valueArray) {
        $sql =  'SELECT * from utilisateurs';
    }
}
?>