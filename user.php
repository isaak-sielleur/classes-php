<?php

    class user
    {
        private $id = "";
        public $login = "";
        public $email = "";
        public $firstname = "";
        public $lastname = "";
        private $password = "";

        public function register($login, $password, $email,$firstname, $lastname)
        {
            $link= mysqli_connect("127.0.0.1", "root", "", "user");

            $requete="INSERT INTO user (id,	login, email, firstname, lastname, password) VALUES (NULL, '$login', '$email', '$firstname', '$lastname', '$password')";
            $query= mysqli_query($link, $requete);

            echo $requete;

            $tabinfo= array
            (
                'login'=>$login,
                'email'=>$email,
                'firstname'=>$firstname,
                'lastname'=>$lastname,
                'password'=>$password
            );

            return $tabinfo;
        }

        public function connect($login, $password)
        {
            $link= mysqli_connect("127.0.0.1", "root", "", "user");

            $requete="SELECT * FROM user WHERE login = '$login' && password = '$password'";
            $query= mysqli_query($link, $requete);
            $resultat= mysqli_fetch_all($query, MYSQLI_ASSOC);

            $this->login = $resultat[0]['login'];   //stock les info récuperer en bdd dans l'objet user
            $this->id = $resultat[0]['id'];
            $this->email = $resultat[0]['email'];
            $this->firstname = $resultat[0]['firstname'];
            $this->lastname = $resultat[0]['lastname'];
            $this->password = $resultat[0]['password'];
        }

        public function disconnect()
        {
            session_destroy();
        }
        
        public function delete()
        {
            $link= mysqli_connect("127.0.0.1", "root", "", "user");
            $requete="DELETE FROM `user` WHERE `id` = $this->id";
            $query= mysqli_query($link, $requete);

            session_destroy();
        }

        public function update($login, $password, $email, $firstname,$lastname)
        {
            $link= mysqli_connect("127.0.0.1", "root", "", "user");
            $requete="UPDATE user SET login = '$login',password='$password',email='$email',firstname='$firstname',lastname='$lastname' WHERE `id` = $this->id";
            $query= mysqli_query($link, $requete);
        }

        public function isConnected()
        {
            if(!empty($this->id))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getAllInfos()
        {
            $tabinfo= array
            (
                'login'=>$this->login,
                'email'=>$this->email,
                'firstname'=>$this->firstname,
                'lastname'=>$this->lastname,
                'password'=>$this->password
            );

            return $tabinfo;
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
             return $this->lastname;
       }

       public function refresh()
       {
            $link= mysqli_connect("127.0.0.1", "root", "", "user");

            $requete="SELECT * FROM user WHERE id = $this->id";
            $query= mysqli_query($link, $requete);
            $resultat= mysqli_fetch_all($query, MYSQLI_ASSOC);

            $this->login = $resultat[0]['login'];   //stock les info récuperer en bdd dans l'objet user
            $this->email = $resultat[0]['email'];
            $this->firstname = $resultat[0]['firstname'];
            $this->lastname = $resultat[0]['lastname'];
            $this->password = $resultat[0]['password'];
       }
    }

    session_start();

    // $_SESSION['user'] = new user();
    //$tab= $_SESSION['user']->register("arture","cuillere","lefeu@stp.com","boullette","sauvage");
    //$_SESSION['user']->connect("arture","cuillere");
    //$_SESSION['user']->disconnect();
    // $_SESSION['user']->delete();
    // $_SESSION['user']->update("isaak","iii","iii","iii","iii");
    //$connexion=$_SESSION['user']->isConnected();
    //var_dump($connexion);
    //$allinfo=$_SESSION['user']->getAllInfos();
    // var_dump($allinfo);
    //$_SESSION['user']->refresh();
    //var_dump($_SESSION['user']);
    // var_dump($tab);

?>