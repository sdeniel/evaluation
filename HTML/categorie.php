<?php
// Calcul des différentes catégories en fonction de l'age
$age = date("Y")-$donneesResult['birthdate'];
switch ($age) {
    case 10 : case 11 :
        echo "Poussin";
        break;
    case 12 : case 13 :
        echo "Benjamin";
        break;
    case 14 : case 15 :
        echo "Minime";
        break;
    case 16 : case 17 :
        echo "Cadet";
        break;
    case 18 : case 19 :
        echo "Junior";
        break;
    case 20 : case 22 :
        echo "Espoir";
        break;
    case 23 : case 40 :
        echo "Sénior";
        break;
    default :
        echo "Master";
}
?>
