<?php
include_once 'model/bdd.php'; 

// Obtenir une connexion à la base de données
$pdo = Bdd::connexion();

try {
    $query = "SELECT * FROM livres";
    $stmt = $pdo->prepare($query); 
    $stmt->execute();
    $mangas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des mangas : " . $e->getMessage());
}
?>

<link rel="stylesheet" href="view/accstyles.css">

<div class="container">
    <h1>Liste des Mangas</h1>
    <div class="manga">
        <?php foreach ($mangas as $manga): ?>
            <div class="manga-carte">
                <img src="<?= htmlspecialchars($manga['photo']) ?>" alt="Couverture de <?= htmlspecialchars($manga['titre']) ?>">
                <h2><?= htmlspecialchars($manga['titre']) ?></h2>
                <p><strong>Auteur :</strong> <?= htmlspecialchars($manga['auteur']) ?></p>
                <p><?= htmlspecialchars($manga['description']) ?></p>
                <p><strong>Prix :</strong> <?= number_format($manga['prix'], 2) ?> €</p>
                <p><strong>Catégorie :</strong> <?= htmlspecialchars($manga['categorie']) ?></p>
                <p><strong>Stock :</strong> <?= htmlspecialchars($manga['stock']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
