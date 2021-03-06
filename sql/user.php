<?php

class User{
    public $login;
    public $password;
    public $id;
    public $nom;
    public $prenom;
    public $birthdate;
    public $email;
    public $tel;
    public $wedding;
    
    public function __toString(){
        if ($this->tel == NULL){
            $separator = "";
        }
        else {
            $separator = "$this->tel,";
        }
        return "[$this->login] $this->prenom $this->nom, né le $this->birthdate, $this->email, $separator pour le mariage $this->wedding, a les droits $this->id";
    }
    
    public static function getUser($dbh, $login){
        $sth = $dbh->prepare("SELECT * from `users` WHERE `login`=?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'User');
        $sth->execute(array($login));
        if ($sth -> rowCount() != 1) { return null; }
        $user = $sth->fetch();
        return $user;
    }
    
    public static function insertUser($dbh, $login, $password, $id, $nom, $prenom, $birthdate, $email, $tel){
        if (User::getUser($dbh, $login) == null){
            $sth = $dbh->prepare("INSERT INTO `users` (`login`, `password`, `id`, `nom`, `prenom`, `birthdate`, `email`, `tel`, `wedding`) VALUES(?,SHA1(?),?,?,?,?,?,?,?)");
            $sth->execute(array($login, $password, $id, $nom, $prenom, $birthdate, $email, $tel, "NULL")); 
            echo "Votre compte a été ajouté, vous pouvez maintenant vous connecter";
        }
        else{
            echo "Ce login est déjà utilisé";
        }
    }
    
    public static function testPassword($user, $password){
        $mdp = $user->password;
        return ($mdp == SHA1($password));
    }
    
    public static function updatePassword($dbh, $login, $passwordCrypte){
        $sth = $dbh->prepare("UPDATE `users` SET `password`=? WHERE `login`=?");
        $sth->execute(array($passwordCrypte, $login));
        echo "Votre mot de passe a été modifié";
    }
    
    public static function deleteAccount($dbh, $login){
        $sth = $dbh->prepare("DELETE FROM `users` WHERE `login`=?");
        $sth->execute(array($login));
        echo "Votre compte a été supprimé";
    }
}