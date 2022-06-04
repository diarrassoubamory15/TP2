<?php
session_start();
include_once('basededonnees.php');
$bd = Basededonnees::connecter();
if(!isset($_SESSION['id_users'])){

    header('Location: index1.php');

}else{
    ?>
    
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-----------bootstrap-------->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!----------script------------>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>

    <!--------police------>
    <link href='http://fonts.googleapis.com/css?family=holtwood+One+SC' rel='stylesheet' type='text/css'>  

    <!---------image-------->
    <link rel="shortcut icon" href="images/favicon.ico"/>

    <!---------style-------->
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!--script src="https:ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script-->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!--script src="ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script-->
    <title>Annuaire</title>
</head>
<body>
    
    <div class="container gx-5" style="background-color:#ececed;">

   
        <h1 style="text-align:center ;box-shadow: 8px 8px 8px black;border:3px solid #cc6f47;
        color:blue; font-family: arial,sans-serif; ">Annuaire CV master informatique 2021-2022</h1>
                 
                
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <ul class="nav nav-pills">
                    <li class="nav-item" ><a class="nav-link active" style="font-family: arial,sans-serif;" href="profil.php" data-toggle="tab">Creer votre CV</a></li>
                    <?php

                    echo '<div style="color:white;font-family: arial,sans-serif;"> 
                    Bienvenue '.$_SESSION['user'].' :) - <a class="btn btn-secondary" href="deconnexion.php"> Se deconnecter</a></div>';
                     ?>
                </ul>
                </nav>
                <nav aria-label="breadcrumb">
                <div style="float:right; font-family:bolder"><a class="btn btn-danger" href="compte.php">SUPPRIMER LE COMPTE</a></div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item 'active'"><a href="afficheprofil.php">PROFIL</a></li>
                <li class="breadcrumb-item 'active'"><a href="affichecursus.php">CURSUS UNIVERSITAIRE</a></li>
                <li class="breadcrumb-item 'active'"><a href="affichecomp.php">COMPETENCE</a></li>
                <li class="breadcrumb-item 'active'"><a href="affichelangue.php">LINGUISTIQUE</a></li>
                <li class="breadcrumb-item 'active'"><a href="afficheexp.php">EXPERIENCE</a></li>
                <li class="breadcrumb-item 'active'"><a href="afficheloi.php">LOISIR</a></li>
                
            </ol>
        </nav>
            <div class="row gx-5" >
                    <?php
                    $requete =$bd->query('SELECT profils.id_profils,profils.nom,
                    profils.prenoms,profils.nce,profils.email, profils.image, users_id FROM profils LEFT JOIN
                     users ON profils.users_id = users.id_users');
                    while($reponse = $requete->fetch()){
                    ?>
            
                 <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div class="card" style="box-shadow: 8px 8px 8px black;
                        border-radius: 0px 45px 0px 45px;border:3px solid #cc6f47;margin-bottom:20px;">
                            <div class="card-body" style="text-align: center ;">
                            
                        
                                <img class=" img img-responsive img-thumbnail rounded-circle" src="photo/<?php echo $reponse['image']; ?>" alt="" width="200px" height="200px">
                             <div class="caption" style="font-family:arial,sans-serif;">
                                <p><strong><?php echo $reponse['nom'];  ?>
                                <?php echo $reponse['prenoms'];  ?></strong></p>
                                <p><strong><?php echo $reponse['nce'];  ?></strong></p>
                                <p> <a href="mailto:<?php echo $reponse['email']; ?>"><?php echo $reponse['email'];?></a> </p>
                                
                                <?php
                                
                                echo'<a class="btn btn-secondary" role="button" 
                                href="cvcomplet.php?id=' .$reponse['users_id'].'">cvcomplet</a>';
                                echo' ';
                                ?>
                                <button data-id="<?php echo $reponse['users_id'];?>" class="minicv btn btn-success">
                                Mini CV
                                </button>
                                
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
     
                         <!-- Modal -->
                  <div class="modal fade" id="empModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mini CV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                      </div>
                      <div class="modal-body">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>

                <script type='text/javascript'>
                    $(document).ready(function(){

                        $('.minicv').click(function(){
                        var mini = $(this).data('id');
                        $.ajax({
                                url: 'ajaxfile.php',
                                type: 'POST',
                                data: {mini: mini},
                                success: function(response){
                                    $('.modal-body').html(response);
                                    $('#empModal').modal('show');
                                    }
                                });
                    
                            });
                     });
                                                
                </script>
    
</body>
</html>

<?php
}

?>

