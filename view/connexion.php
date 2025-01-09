<?php
include_once 'model/bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $password = $_POST['password'];

    try {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("SELECT * FROM users WHERE name = ?");
        $stmt->execute([$nom]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
            ];
            header('Location: index.php?page=accueil');
            exit;
        } else {
            $error = "Nom ou mot de passe incorrect";
        }
    } catch (Exception $e) {
        $error = "Erreur : " . $e->getMessage();
    }
}
?>

<link rel="stylesheet" href="styles/insconstyles.css">

<form method="POST">
    <h2>Connexion</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
    <p><a href="index.php?page=inscription">Inscrivez-vous</a></p>
</form>
