<?php


$bd = Basededonnees::connecter();
$requete =$bd->prepare('SELECT id_linguistiques, langues, users_id
 FROM linguistiques LEFT JOIN users ON id_linguistiques = users_id WHERE users_id = ?');
$requete->execute(array($id));

Basededonnees::deconnecter();

?>
    <div class="row">
        <?php
            while($reponse = $requete->fetch()){
        
         ?>
         <div class="col-sm-3">
            <p><strong>Langue :</strong> <?php echo $reponse['langues'];?></p>
           
            
         </div>

        <?php
        }
        ?>
    </div>