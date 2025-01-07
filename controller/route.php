<?php 

$page = isset($_GET['page']) ? $_GET['page'] : 'acceuil'; 

switch ($page) {
    case 'accueil':
        if (file_exists('view/accueil.php')) {
            include 'view/accueil.php';
        } else {
            echo "Page de accueil indisponible.";
        }
        break;
    case 'inscription':
        include 'view/inscription.php';
        break;
    case 'connexion':
        include 'view/connexion.php';
        break;     
    case 'deconnexion':
        include 'view/deconnexion.php';
        break;     
    default:
        include 'view/404.php';
}
