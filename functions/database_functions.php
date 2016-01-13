<?php
function db_connection()
{
    $servername = '127.0.0.1';
    $username = 'root';
    $password = "";
    $database = "music_store";
    $dbport = "3306";
    $dbh = new PDO('mysql:host=' . $servername . ';dbname='. $database, $username, $password);
    return $dbh;
}

function get_beats_for_sale() {
    $dbh = db_connection();

    try {
        $query = $dbh->query("SELECT * FROM beats WHERE deleted = 0 AND exclusive = 0", PDO::FETCH_ASSOC);
        $rows = $query->fetchAll();
    } catch (PDOException $e) {
        //log_error($e->getCode(), $e->getMessage());
        throw new Exception('Internal Server error.');
    }

    return $rows;
}