<?php


$bd = Basededonnees::connecter();
$requete =$bd->prepare('SELECT id_competences, domaine, specialite,users_id
 FROM competences LEFT JOIN users ON id_competences = users_id WHERE users_id = ?');
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
            <p><strong>Domaine : </strong><?php echo $reponse['domaine'];?></p>
            <p><strong>Specialite :</strong> <?php echo $reponse['specialite'];?></p>
                    </div>
                </div>
                
            
         </div>

        <?php
        }
        ?>
    </div>