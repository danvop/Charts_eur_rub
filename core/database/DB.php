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
    
    public function fetchCustom($table, $days)
    {   
        //fetching days befor ecb rates from DB
        $stopDate = date('Y-m-d');
        $startDate = date("Y-m-d", strtotime("-$days day"));
        $sql = "SELECT * FROM {$table} WHERE date < " . "'" . date('Y-m-d') . "'";
        $sql = "SELECT * FROM {$table} 
                WHERE date BETWEEN '{$startDate}' AND '{$stopDate}' ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchCustomLeft($lTable, $rTable, $days)
    {
        $stopDate = date('Y-m-d');
        $startDate = date("Y-m-d", strtotime("-$days day"));

        $sql = "SELECT l.date, r.rate
        FROM {$lTable} l
        LEFT OUTER JOIN {$rTable} r on l.date = r.date
        WHERE l.date BETWEEN '{$startDate}' AND '{$stopDate}' ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // select l.date, r.rate
        // from dates l
        // LEFT OUTER JOIN ecb_rate r on l.date = r.date
        // where l.date between '2017-02-20' and '2017-03-06';
        
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
