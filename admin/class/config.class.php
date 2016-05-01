<?php


class DB
{
    public $con;
    public $table;
    public $job;
    public $tbl;
    public $now;

    public function __construct()
    {
        include 'config/index.php';
        $this->con = new PDO('mysql:host=' . HOST . ';dbname=' . DB, USER, PASS);
        try {
            $this->con;
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "connected";
        } catch (PDOException $e) {
            echo "Something went wrong";
        }
    }

    /**
     * @param $tableName
     */
    public function select($tableName)
    {
        if ($this->con) {
            $data = $this->con->query("SELECT * FROM $tableName ORDER BY id DESC");
            $this->table = $data;
        } else {
            echo "something went wrong";
        }
        $this->tbl = $tableName;
    }

    /**
     * @param $name
     * @param $data
     */
    public function formInsert($name, $data)
    {
        $stmt = $this->con->prepare("INSERT INTO form(name,data) VALUES (:name, :data)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':data', $data, PDO::PARAM_STR);
        try {
            $stmt->execute();

            return true;
        } catch (PDOException $e) {

            return false;
        }
    }

    /**
     * @param $name : Form name that would be shown
     */
    public function showForm($name)
    {
        try {
            $data = $this->con->query("SELECT * FROM form WHERE name='$name'");
        } catch (PDOException $e) {
            die("<div align='center'><h1>Attack detected</h1> <img src='admin/img/hacktroll.jpg'></div>");
        }
        foreach ($data as $d) {
            echo $d['data'];
        }
    }

    /**
     * @param $field
     */

    public function settings($field)
    {
        $data = $this->con->query("SELECT * FROM settings WHERE field='$field'");
        foreach ($data as $d) {
            return $d['value'];
        }

        $this->now = $field;
    }

    /**
     * @param $tbl
     * @param $col
     * @param $data
     * @return bool
     */

    public function get($tbl, $col, $data)
    {
        $data = $this->con->query("SELECT * FROM " . $tbl . " WHERE " . $col . "='$data'");
        foreach ($data as $d) {
            return $d['value'];
        }
        return false;

    }
}


