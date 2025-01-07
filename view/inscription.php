<?php
include_once 'model/bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        $bdd = Bdd::connexion();

        $stmt = $bdd->prepare("INSERT INTO users (name, password, cree) VALUES (?, ?, NOW())");
        $stmt->execute([$name, $password]);

        $user_id = $bdd->lastInsertId();
        $stmt = $bdd->prepare("SELECT id, name FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
        ];

        header('Location: index.php?page=accueil');
        exit;
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<form method="POST">
    <h2>Inscription</h2>
    <input type="text" name="name" placeholder="Nom" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">S'inscrire</button>
</form>
