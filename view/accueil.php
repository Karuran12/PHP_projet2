<?php
include_once 'model/bdd.php';

$pdo = Bdd::connexion();

try {
    $query = "SELECT * FROM livres";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $mangas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des mangas : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['manga_id'])) {
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=connexion');
        exit;
    }

    $mangaId = $_POST['manga_id'];

    $query = "UPDATE livres SET stock = stock - 1 WHERE id = :id AND stock > 0";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $mangaId]);

    $_SESSION['cart'][] = $mangaId;

    header('Location: index.php?page=panier');
    exit;
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
                <?php if (isset($_SESSION['user']) && $manga['stock'] > 0): ?>
                    <form method="POST">
                        <input type="hidden" name="manga_id" value="<?= $manga['id'] ?>">
                        <button type="submit" class="btn-acheter">Acheter</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
