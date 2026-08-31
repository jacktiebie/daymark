<?php

class Database
//A class is a blueprint for creating objects (class).
{
private string $host = 'localhost';
private string $database = 'daymark';
private string $username = 'root';
private string $password = '';
//I use private so that only $host can be used or edited in the class. 'Encapsulation' 

public function connect(): PDO
{
$dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
//DSN = Data Source Name. A DSN tells PDO: which datbase system are we using, where, which one and what character encoding.
//$this refers to the CURRENT Database object.
 $pdo = new PDO(
    $dsn, 
    $this->username,
    $this->password
 );

 $pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
 );
 //setAttribute() changes a setting of my PDO object.
 //PDO:ATTR_ERRMODE  -> changing PDO's error handling mode.
 //PDO::ERRMODE_EXCEPTION -> if database errors occur, PDO should throw an exception

return $pdo;
}
}