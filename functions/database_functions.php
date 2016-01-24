<?php
function db_connection()
{
    $servername = '127.0.0.1';
    $username = 'root';
    $password = "";
    $database = "music_store";
    $dbport = "3306";
    
    try {
        $dbh = new PDO('mysql:host=' . $servername . ';dbname=' . $database, $username, $password);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        throw new Exception('Database Connection Error');
    }

    return $dbh;
}

/*
* ######################################################################
* #                         MUSIC PLAYER
* ######################################################################
*/

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

/*
* ######################################################################
* #                         ADMINISTRATIVE FUNCTIONS
* ######################################################################
*/

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

function add_beat($title, $category, $filename, $leasePrice, $exclusivePrice) {
    $dbh = db_connection();
    $dbh->beginTransaction(); //Ensures all querys are successful before changes are made to the database.

    try {
        $query = $dbh->prepare("INSERT INTO beats VALUES (NULL, ?, ?, DEFAULT, DEFAULT, ?, 0, ?, ?)");
        $query->execute(array($title, $category, $filename, $leasePrice, $exclusivePrice));

        $lastId = $dbh->lastInsertId();

        $query = $dbh->prepare("UPDATE beats SET orderNum = ? WHERE beatID = ?");
        //$query->bindParam(':id', $lastId, PDO::PARAM_STR);
        $query->execute(array($lastId, $lastId));

        $dbh->commit();
    } catch (PDOException $e) {
        //log_error($e->getCode(), $e->getMessage());
        echo $e->getMessage();
        throw new Exception('Internal Server error.');
    }

    $lastId = $dbh->lastInsertId();

    $query = null;
    $dbh = null;

    return $lastId;
}

function delete_beat($id) {
    $dbh = db_connection();

    try {
        $query = $dbh->query("UPDATE beats SET deleted = 1 WHERE beatID = ?");
        $query->execute(array($id));
    } catch (PDOException $e) {
        //log_error($e->getCode(), $e->getMessage());
        throw new Exception('Internal Server error.');
    }

    $query = null;
    $dbh = null;
}

function restore_beat($id) {
    $dbh = db_connection();

    try {
        $query = $dbh->query("UPDATE beats SET deleted = 0 WHERE beatID = ?");
        $query->execute(array($id));
    } catch (PDOException $e) {
        //log_error($e->getCode(), $e->getMessage());
        throw new Exception('Internal Server error.');
    }

    $query = null;
    $dbh = null;
}

/*
* ######################################################################
* #                         SHOPPING CART
* ######################################################################
*/

/*
* When supplied an id a beat is returned in the form of an array.
* @args $id int
* @returns $beat array()
*/
function get_beat($id) {
    $dbh = db_connection();

    try {
        $query = $dbh->query("select beatID, title, category, leasePrice, exclusivePrice FROM beats WHERE beatID = ? AND deleted = 0");
        $query->execute(array($id));
        $beat = $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        //log_error($e->getCode(), $e->getMessage());
        throw new Exception('Internal Server error.');
    }    

    $query = null;
    $dbh = null;

    return $beat;
}

/*
* ######################################################################
* #                         ANALYTICS
* ######################################################################
*/
function add_song_analytic($beatID, $browser, $version, $os, $ip)
{
    //Initialize the ipv4 and ipv6 feilds.
    if(empty($ip['ipv4']))
    {
        $ipv4 = null;
        $ipv6 = null;
    }
    elseif($ip['ipv4'])
    {
        $ipv4 = $ip['address'];
        $ipv6 = null;
    }
    else
    {
        $ipv4 = null;
        $ipv6 = $ip['address'];
    }

    if(isset($ip['lookup']))
        $lookup = $ip['lookup'];
    else
        $lookup = null;

    $dbh = db_connection();

    //check if the same user accessed the page.
    if($lookup != null)
    {
        try{
            $query = $dbh->prepare("SELECT beatAnalyticID FROM beatsAnalytics WHERE hostname = ?");
            $query->execute(array($lookup));
        } catch (PDOException $e) {
            //log_error($e->getCode(), $e->getMessage());
            throw new Exception('Internal Server error.');
        }
        if($query->rowCount())
            try {
                $query = $dbh->prepare("UPDATE beatsAnalytics SET frequency = frequency + 1 WHERE hostname = ?");
                $query->execute(array($lookup));
            } catch (PDOException $e) {
                //log_error($e->getCode(), $e->getMessage());
                throw new Exception('Internal Server error.');
            }
        else
            try {
                $query = $dbh->prepare("INSERT INTO beatsAnalytics VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, DEFAULT)");
                $query->execute(array($browser, $version, $os, $ipv4, $ipv6, $lookup, $beatID));
            } catch (PDOException $e) {
                //log_error($e->getCode(), $e->getMessage());
                throw new Exception('Internal Server error.');
            }
    }
    else
        try {
            $query = $dbh->prepare("INSERT INTO beatsAnalytics VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, DEFAULT)");
            $query->execute(array($browser, $version, $os, $ipv4, $ipv6, $lookup, $beatID));
        } catch (PDOException $e) {
            //log_error($e->getCode(), $e->getMessage());
            throw new Exception('Internal Server error.');
        }

    $query = null;
    $dbh = null;
}

/*
* ######################################################################
* #                         SECURITY/VALIDATION
* ######################################################################
*/

/*
* Returns a hash of the beats table. Allows the users cart to be updated in the case of
* any modifications to the beat database.
*/
function checksum_beats() {
    $dbh = db_connection();

    try {
        $query = $dbh->query("CHECKSUM TABLE beats");
        $query->execute();
        $checksum = $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        //log_error($e->getCode(), $e->getMessage());
        throw new Exception('Internal Server error.');
    }    

    $query = null;
    $dbh = null;

    return $checksum['Checksum'];
}