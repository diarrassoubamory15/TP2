<?php
session_start();
require ('basededonnees.php');
$bd = Basededonnees::connecter();

class connexion{
    private $user;
    private $mdp;
    private $bd;

    public function __construct($user, $mdp){
        
        $this-> user = $user;
        $this-> mdp = $mdp;

    }

    public function verif($bd){
        $requete = $bd->prepare('SELECT * FROM users WHERE user = :user');
        $requete->execute([ 'user' => $this->user ]);
        $reponse = $requete->fetch();
        if($reponse){
          if($this-> mdp == $reponse['mdp']){
              return 'ok';
            }else{
             $erreur = "Le mot de passe est incorrect !"; 
             return $erreur;
            }

        }else{
                $erreur = "L'utilisateur n'est pas inscrit !";
                return $erreur;
        }
            
    }

    public function session($bd){
        $requete = $bd->prepare('SELECT id_users FROM users WHERE user = :user');
        $requete->execute([ 'user' => $this->user ]);
        $requete = $requete->fetch();
        $_SESSION['id_users'] = $requete['id_users'];
        $_SESSION['user'] = $this->user;
        return 1;
    }
    
}

?>