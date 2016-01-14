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
        $query = $dbh->query("SELECT * FROM beats WHERE deleted = 0 AND exclusive = 0 ORDER BY orderNum", PDO::FETCH_ASSOC);
        $rows = $query->fetchAll();
    } catch (PDOException $e) {
        //log_error($e->getCode(), $e->getMessage());
        throw new Exception('Internal Server error.');
    }

    $query = null;
    $dbh = null;

    return $rows;
}

function get_beats() {
    $dbh = db_connection();

    try {
        $query = $dbh->query("SELECT * FROM beats WHERE deleted = 0 ORDER BY orderNum", PDO::FETCH_ASSOC);
        $rows = $query->fetchAll();
    } catch (PDOException $e) {
        //log_error($e->getCode(), $e->getMessage());
        throw new Exception('Internal Server error.');
    }

    $query = null;
    $dbh = null;

    return $rows;
}

function get_deleted_beats() {
    $dbh = db_connection();

    try {
        $query = $dbh->query("SELECT * FROM beats WHERE deleted = 1", PDO::FETCH_ASSOC);
        $rows = $query->fetchAll();
    } catch (PDOException $e) {
        //log_error($e->getCode(), $e->getMessage());
        throw new Exception('Internal Server error.');
    }

    $query = null;
    $dbh = null;

    return $rows;
}

function add_beat($title, $category, $filename) {
    $dbh = db_connection();
    $dbh->beginTransaction(); //Ensures all querys are successful before changes are made to the database.

    try {
        $query = $dbh->prepare("INSERT INTO beats VALUES (NULL, ?, ?, DEFAULT, DEFAULT, ?, 0)");
        $query->execute(array($title, $category, $filename));

        $lastId = $dbh->lastInsertId();

        $query = $dbh->prepare("UPDATE beats SET orderNum = :id WHERE beatID = :id");
        $query->bindParam(':id', $lastId);
        $query->execute();

        $dbh->commit();
    } catch (PDOException $e) {
        //log_error($e->getCode(), $e->getMessage());
        throw new Exception('Internal Server error.');
    }

    $lastId = $dbh->lastInsertId();

    $query = null;
    $dbh = null;

    return $lastId;
}