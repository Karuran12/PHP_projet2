<?php
include_once 'model/bdd.php';

// Vérification de connexion de l'utilisateur
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=connexion');
    exit;
}

$pdo = Bdd::connexion();
$userId = $_SESSION['user']['id'];


if (empty($_SESSION['cart'])) {
    $query = "SELECT livre_id, quantite FROM panier WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId]);
    $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['cart'] = [];
    foreach ($cart as $item) {
        for ($i = 0; $i < $item['quantite']; $i++) {
            $_SESSION['cart'][] = $item['livre_id'];
        }
    }
} else {
    $cart = $_SESSION['cart'];
}

$mangas = [];
if (!empty($cart)) {
    $placeholders = str_repeat('?,', count($cart) - 1) . '?';
    $query = "SELECT * FROM livres WHERE id IN ($placeholders)";
    $stmt = $pdo->prepare($query);
    $stmt->execute($cart);
    $mangas = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valider_panier'])) {
    $cartCount = array_count_values($cart);
    foreach ($cartCount as $livreId => $quantite) {
        $query = "INSERT INTO panier (user_id, livre_id, quantite) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$userId, $livreId, $quantite]);
    }

    unset($_SESSION['cart']);
    $message = "Votre panier a été validé avec succès.";
}
?>

<link rel="stylesheet" href="view/accstyles.css">

<div class="container">
    <h1>Votre Panier</h1>
    <?php if (isset($message)): ?>
        <p style="color: green;"><?= $message; ?></p>
    <?php endif; ?>
    <?php if (empty($mangas)): ?>
        <p>Votre panier est vide, achetez des livres.</p>
    <?php else: ?>
        <div class="manga">
            <?php foreach ($mangas as $manga): ?>
                <div class="manga-carte">
                    <img src="<?= htmlspecialchars($manga['photo']) ?>" alt="Couverture de <?= htmlspecialchars($manga['titre']) ?>">
                    <h2><?= htmlspecialchars($manga['titre']) ?></h2>
                    <p><strong>Auteur :</strong> <?= htmlspecialchars($manga['auteur']) ?></p>
                    <p><strong>Prix :</strong> <?= number_format($manga['prix'], 2) ?> €</p>
                    <p><strong>Catégorie :</strong> <?= htmlspecialchars($manga['categorie']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <form method="POST">
            <button type="submit" name="valider_panier" class="btn-valider">Valider le Panier</button>
        </form>
    <?php endif; ?>
</div>


