<?php

/*
*
* PDO database class
* Connect to the database
* Create prepare statements
* Bind values
* return rows and results
*/

class Database{

    private $host = DB_HOST ;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh; // databse handler -> while using the statement of the pdo, we use it.
    private $stmt;
    private $error;

    public function __construct()
    {

        // Set DSN
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;

        $options = array(
            PDO::ATTR_PERSISTENT => true, // this option boost the performance of PDO, 
            //it realizes wheather the connection to the databse has been already estblished
             
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // PDO has 3 types of error modes: silent - warning - exception
        );

        //Create PDO instance
        
        try{

            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);

        }
        catch(PDOException $e){
            $this->error = $e;
            echo $this->error; 
        }
        
    }

    //prepare statement with queries

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    //bind the values
    public function bind($value, $param, $type)
    {

        if(is_null($type))
        {

            switch (true)
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_string($value):
                    $type = PDO::PARAM_STR;
                    break;
                    
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                    
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                    
                default:
                 $type = PDO::PARAM_STR;
                 break;
            }
        }   
        
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute()
    {
        return $this->stmt->execute();
    }


    // Get result set as array of objects
    public function resultSet()
    { 
        $this->execute();
        $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record
    public function single()
    {
        $this->execute();
        $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //Get row count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }




}