<?php


$bd = Basededonnees::connecter();
$requete =$bd->prepare('SELECT id_experiences,annee_travail,entreprise,mission ,users_id
 FROM experiences LEFT JOIN users ON id_experiences = users_id WHERE users_id = ?');
$requete->execute(array($id));

Basededonnees::deconnecter();


?>
    <div class="row">
        <?php
            while($reponse = $requete->fetch()){
        
         ?>
         <div class="col-sm-3">
             <div class="card">
                 <div class="card-body">
                    <p><strong>Annee de travail : </strong><?php echo $reponse['annee_travail'];?></p>
                    <p><strong>Entreprise : </strong><?php echo $reponse['entreprise'];?></p>
                    <p><strong>Poste : </strong><?php echo $reponse['mission'];?></p>
                </div>
             </div>
            
         </div>

        <?php
        }
        ?>
    </div>