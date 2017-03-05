<?php

namespace app\core\database;

use PDO;

class DB
{
    protected $pdo;
    public function __construct()
    {
        try {
            $this->pdo = new PDO('sqlite:database.sqlite');
            // die(var_dump($pdo));
            // echo 'ok!';
            return $this->pdo;
        } catch (PDOException $e) {
            die('Could not connect');
        }
    }
     
    public function fetchAll($table)
    {
        $stmt = $this->pdo->prepare("select * from {$table}");
        $stmt->execute();
        return var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
    
    public function fetchCustomEcb($table, $days)
    {   
        //fetching days befor ecb rates from DB
        $stopDate = date('Y-m-d');
        $startDate = date("Y-m-d", strtotime("-$days day"));
        $sql = "select * from {$table} where date < " . "'" . date('Y-m-d') . "'";
        $sql = "select * from {$table} 
                where date BETWEEN '{$startDate}' AND '{$stopDate}' ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );
        //die(var_dump($sql));
        //die(var_dump($parameters));

        try {
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute($parameters);
        } catch (Exception $e) {
            //
        }
    }
}
