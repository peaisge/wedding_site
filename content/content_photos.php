<?php
    session_start();
    if ($_SESSION['id'] == 1){
        
    }
    else{
        
    }
?>
<!DOCTYPE html>
<div class="jumbotron margin">
    <h1>Titre qui ne depend pas de la page</h1>
    <p>Détails supplémentaires qui ne dépendent pas de la page</p>
</div>

<div id="content">
    <div>
        <h1><?php $pageTitle ?></h1>
        <p>Les photos des mariés</p>
        <p>Les photos des invités</p>
    </div>

</div>

