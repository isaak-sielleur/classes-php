<?php

    class lpdo
    {
        
        private $connection;
        private $query=false;
        private $resultat=false;
        private $bd;

        
        function constructeur($host="localhost", $username="root", $password="", $db="user")
        {
            $this->bd=$db;
		    $this->connection = mysqli_connect($host, $username, $password, $this->bd);
        }

        function connect($host="localhost", $username="root", $password="", $db)
        {
            if(!empty($this->connection))
            {
                mysqli_close($this->connection);
            }
            $this->bd=$db;
		    $this->connection = mysqli_connect($host, $username, $password, $this->bd);
        }

        function destructeur()
        {
            mysqli_close($this->connection);
        }

        function execute($query)
        {   
            $this->query=$query;
            $envoi= mysqli_query($this->connection, $query);
            $resultat= mysqli_fetch_all($envoi, MYSQLI_ASSOC);
            $this->resultat=$resultat;
            return $resultat;
        }

        function getLastQuery()
        {
            return $this->query;
        }

        function getLastResult()
        {
            return $this->resultat;
        }

        function getTables()
        {
            $envoi= mysqli_query($this->connection, "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE table_schema='".$this->bd."';");
            $resultat= mysqli_fetch_all($envoi, MYSQLI_ASSOC);
            return $resultat;
        }

        function getFields($table)
        {
            $envoi= mysqli_query($this->connection, "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema='".$this->bd."' && TABLE_NAME='".$table."';");
            $resultat= mysqli_fetch_all($envoi, MYSQLI_ASSOC);
            return $resultat;
        }

    }


    //$test = new lpdo;
    //var_dump($test);
    //$test->constructeur();
    //var_dump($test);
    //$res=$test->execute("SELECT login FROM user");
    //var_dump($res);
    //$lastreq=$test->getLastQuery();
    //echo $lastreq;
    //$lastres=$test->getLastResult();
    //var_dump($lastres);
    //var_dump($test->getTables());
    //var_dump($test->getFields('user'));
?>
