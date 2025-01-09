<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/navstyles.css">
</head>
<body>
<nav class="navbar">
    <li class="nav-item">
        <a class="nav-link" href="index.php?page=accueil">Accueil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?page=panier">Panier</a>
    </li>
    <?php if (!isset($_SESSION['user'])): ?>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=connexion">Connexion</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=inscription">Inscription</a>
        </li>
    <?php else: ?>
        <li class="nav-item">
            <span class="navbar-text">Bonjour, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=deconnexion">Déconnexion</a>
        </li>
    <?php endif; ?>
</ul>
</nav>


        


