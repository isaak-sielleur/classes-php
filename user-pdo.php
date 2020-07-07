<?php

    class userpdo
    {
        private $id = "";
        public $login = "";
        public $email = "";
        public $firstname = "";
        public $lastname = "";
        private $password = "";

        public function register($login, $password, $email,$firstname, $lastname)
        {
            $pdo = new PDO("mysql:host=localhost;dbname=user","root","");

            $requette="INSERT INTO user (login, email, firstname, lastname, password) VALUES ('".$login."', '".$password."','".$email."','".$firstname."','".$lastname."')";
            $resultat = $pdo->query($requette);
            
            $array = array
            (
                "login" =>$login ,
                "password" => $password,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email
            );
            return $array;
        }

        public function connect($login, $password)
        {
            $pdo = new PDO("mysql:host=localhost;dbname=user","root","");

            $requettes="SELECT * FROM user WHERE login = '$login' && password = '$password'";
            $resultat = $pdo->query($requettes);
            $aff= $resultat->fetch();

            if(!empty($aff))
            {

                $this->login = $aff['login'];   //stock les info récuperées en bdd dans l'objet user
                $this->id = $aff['id'];
                $this->email = $aff['email'];
                $this->firstname = $aff['firstname'];
                $this->lastname = $aff['lastname'];
                $this->password = $aff['password'];

            }
        }

        public function disconnect()
        {
            session_destroy();
        }

        public function delete()
	    {	
            $bd=new PDO('mysql:host=localhost;dbname=user;charset=utf8', 'root','');
            
		    $requette="DELETE FROM `user` WHERE `id` = ".$this->id.";";
            $resultat = $bd->query($requette);
            
		    session_destroy();
	    }

        public function update($login, $email, $firstname, $lastname)
        {
            $bd = new PDO('mysql:host=localhost;dbname=user;charset=utf8', 'root','');

            $requette="UPDATE user SET login = '".$login."' , email = '".$email."' , firstname = '".$firstname."' , lastname = '".$lastname."' WHERE `id` = ".$this->id.";";
            $resultat = $bd->query($requette);
        }
    
        public function isConnected()
        {
            if(empty($this->id))
            {
                return false;
            }
            else
            {
                return true;
            }
        }

        public function getAllInfos()
        {
            $array = array
            (
                "id" =>$this->id ,
                "login" =>$this->login ,
                "password" => $this->password,
                "firstname" => $this->firstname,
                "lastname" => $this->lastname,
                "email" => $this->email
            );

            return $array;
        }

        public function getLogin()
        {
            return $this->login;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getFirstname()
        {
            return $this->firstname;
        }

        public function getLastname()
        {
            $this->lastname;		
        }

        public function refresh()
        {

            $bd = new PDO('mysql:host=localhost;dbname=user;charset=utf8', 'root','');

            $requette = "SELECT * FROM user WHERE id='".$this->id."';";
            $resultat = $bd->query($requette);
            $aff = $resultat->fetch();

                $this->id = $aff['id'];
                $this->login = $aff['login'];
                $this->password = $aff['password'];
                $this->email = $aff['email'];
                $this->firstname = $aff['firstname'];
                $this->lastname = $aff['lastname'];		
        }

    }
        
    if(!isset($_SESSION['test']))
    {
        $_SESSION['test'] = new userpdo;
    }

?>