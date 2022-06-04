<?php

    include_once ('basededonnees.php');
    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }

    $bd = Basededonnees::connecter();
    $requete =$bd->prepare('SELECT id_profils,nom,prenoms,
    date2naissance,lieu2naissance,nationalite,situationMatrimoniale,nce,mobile,email,image,users_id FROM profils LEFT JOIN
    users ON id_profils = users_id WHERE users_id = ?');
    $requete->execute(array($id));
    $reponse = $requete->fetch();
    Basededonnees::deconnecter();

    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!--------police------>
    <link href='http://fonts.googleapis.com/css?family=holtwood+One+SC' rel='stylesheet' type='text/css'>  

    <!---------image-------->
    <link rel="shortcut icon" href="images/favicon.ico"/>

    <!---------style-------->
    <link rel="stylesheet" href="style.css">
    <title>cvcomplet</title>
</head>
<body style="font-family:arial,sans-serif;">

    <div class="container" >
       <div class="form-action" style="text-align: right;">
          <a class="btn btn-secondary" href="index.php"> Retour</a>
       </div>

       
                  <nav class="navbar navbar-expand navbar-dark bg-info">
                     <h1 >CV <?php echo '   '.$reponse['nom']; ?><?php echo '   '.$reponse['prenoms']; ?></h1>
                  </nav>

                  <main class="container" style="background-color:#ececed;display:inline-block ">
                     
                     <div class="jumbotron" style="max-width: calc(200vh - 20px);
                  max-height: calc(80vh - 20px);">
                           <div class="row"> 
                              
                              <div class="col-12 ">
                                    
                                    <p><img class=" img img-responsive img-thumbnail rounded-circle rounded float-right" width="200px" src="photo/<?php echo $reponse['image']; ?>" alt=""></p> 
                                    
                                 
                                    <p><strong> Nom :</strong><?php echo '   '.$reponse['nom']; ?></p>
                                    <p><strong>Prenoms :</strong></label><?php echo '   '.$reponse['prenoms']; ?></p> 
                                    <p><strong>Date de naissance :</strong></label><?php echo '   '.$reponse['date2naissance']; ?></p>
                                    <p><strong>Lieu de naissance :</strong></label><?php echo '   '.$reponse['lieu2naissance']; ?></p>
                                    <p><strong>Nationalite :</strong><?php echo '   '.$reponse['nationalite']; ?></p>         
                                    <p><strong>Situation matrimoniale :</strong><?php echo '   '.$reponse['situationMatrimoniale']; ?></p>
                                       <p><strong> NCE :</strong><?php echo '   '.$reponse['nce']; ?></p>
                                    <p><strong> Telephone :</strong><?php echo '   '.$reponse['mobile']; ?></p>
                                    <p><strong> Email :</strong><?php echo '   '.$reponse['email']; ?></p>
                                    </div>
                              
                              </div>
                        </div>
                  </div>
                                    
                  </main>
               </thead>
                        
                  <div class="container">
                  <div class="row">
                     <div class="col">
                     
                        <h4 style ="text-align:center;font-weight: bolder;">Cursus Universitaire</h4>
                        
                        <?php
                        include ('cursuscv.php');
                        ?>
                        <hr>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col">
                        <h4 style ="text-align:center;font-weight: bolder;">Competences</h4>
                     
                        <?php
                        include ('competcv.php');
                        include ('linguistcv.php');
                        ?>
                        <hr>
                     </div>
                     </div>
                     <div class="row">
                        <div class="col">
                        <h4 style ="text-align:center;font-weight: bolder;">Experiences</h4>
                     
                        <?php
                        include ('experiencv.php');
                        ?>
                           <hr>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col">
                        <h4 style ="text-align:center;font-weight: bolder;">Loisirs</h4>
                     
                        <?php
                        include ('loisircv.php');
                        ?>
                        
                        </div>
                     </div>
     
      </div>
</body>
</html>