<?php
function inputField($type, $name,$label,$placeholder, $id=null){
    $Type = $type;
    $Name = $name ?? ucfirst($name);
    $Label = $label ?? ucfirst($name);
    $Id = $id ?? ucfirst($name);
    $Placeholder= $placeholder ?? ucfirst($name);
    $text="
    <label for='$Id'>$Label :</label>
    <input type='$Type' name='$Name' id='$Id' placeholder='$Placeholder'>
        ";
    return($text);
}

?>