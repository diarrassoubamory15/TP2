<?php 
    session_start();
    require ('basededonnees.php');
    $bd = Basededonnees::connecter();
    class inscription{
        private $user;
        private $mdp;
        private $mdp2;

        public function __construct($user, $mdp, $mdp2){

            $user = htmlspecialchars($user);
            //$mdp = sha1($user);
            //$mdp2 = sha1($user);

            $this->user = $user;
            $this->mdp = $mdp;
            $this->mdp2 = $mdp2;
            
            }

            public function verif($user){
                if(strlen($user) >= 4 AND strlen($user) < 20  ){

                    if(strlen($this-> mdp) >= 5 AND strlen($this-> mdp) < 45  ){
                        if($this-> mdp === $this-> mdp2){
                            return 'ok';
                        }else{
                            $erreur = "Les mots de passe doivent-être identiques";
                            return $erreur;
                        }

                        return 'ok';
                    }else{
                        $erreur = "Le mot de passe doit-être entre 5 et 20 caracteres";
                        return $erreur; 
                    }


                    return 'ok';
                }else{
                    $erreur = "Le nom d'utilisateur doit-être entre 6 et 20 caracteres";
                    return $erreur;
                }

        }

            public function enregistrement($bd){
                $requete = $bd->prepare('INSERT INTO users(user, mdp) VALUES(:user, :mdp)');
                $requete->execute([
                    'user' => $this-> user,
                    'mdp'=> $this-> mdp,
                ]);
                return 1;
            }

            public function session($bd){
                $requete = $bd->prepare('SELECT id_users FROM users WHERE user = :user');
                $requete->execute([ 'user' => $this->user ]);
                $reponse = $requete->fetch();
                $_SESSION['id_users'] = $reponse['id_users'];
                $_SESSION['user'] = $this->user;
                return 1;
            }
    }
?>