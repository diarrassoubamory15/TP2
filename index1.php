<?php
include_once ('basededonnees.php');

$bd = Basededonnees::connecter();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-----------bootstrap-------->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!----------script------------>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
       crossorigin="anonymous"></script>

    <!--------police------>
    <link href='http://fonts.googleapis.com/css?family=holtwood+One+SC' rel='stylesheet' type='text/css'>  

    <!---------image-------->
    <link rel="shortcut icon" href="images/favicon.ico"/>

    <!---------style-------->
    <link rel="stylesheet" href="style.css">
    <title>index1</title>
</head>
<body>
                <header class="container" style="padding: 10px; text-align:right;">
                     <?php
                        echo'<a class="btn btn-secondary" href="inscription.php">Inscription</a>';
                        echo'  ';
                        echo'<a class="btn btn-secondary" href="connexion.php">Connexion</a>';
                     ?>
                </header>
        <div class="container gx-5" style="background-color:#ececed;">

                        <h1 style="text-align:center ; box-shadow: 8px 8px 8px black; border:3px solid #cc6f47;
                         color:blue; font-family: arial,sans-serif;">Annuaire CV master informatique 2021-2022</h1>
                        <br>
                    <div class="row gx-5">
                                <?php
                                    $requete =$bd->query('SELECT profils.nom,profils.prenoms,profils.image FROM profils LEFT JOIN
                                    users ON profils.users_id = users.id_users');
                                    while($reponse = $requete->fetch()){
                                ?>
                                <div class="col-ms-6 col-md-4">
                                    <div class="thumbnail">
                                        <div class="card" style="box-shadow: 8px 8px 8px black;border-radius: 0px 45px 0px 45px;
                                         border:3px solid #cc6f47;margin-bottom:20px;">
                                            <div class="card-body" style="text-align: center;">
                                    
                                                        <img class=" img img-responsive img-thumbnail rounded-circle" src="photo/<?php echo $reponse['image']; ?>" alt="" width="200px" height="200px">
                                                    <div class="caption" style="font-family: arial,sans-serif;">
                                                        <p><strong><?php echo $reponse['nom'];  ?>
                                                        <?php echo $reponse['prenoms'];  ?></strong></p>
                                                    </div>

                                            
                            
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                        <?php
                                        } 
                                        Basededonnees::deconnecter();                    
                                        ?>
                    </div>
                        
                            
                            
                        


        </div>
</body>
</html>