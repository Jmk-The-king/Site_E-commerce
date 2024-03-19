<form action="catalogue.php" method="GET">
    <div class="price_text">
        <p>Price :</p>
    </div>
    <div class="price_value d-flex justify-content-center">
        <input type="text" class="js-input-from" name="min_price" id="amount" readonly />
        <span>to</span>
        <input type="text" class="js-input-to" name="max_price" id="amount" readonly />
    </div>
    <button type="submit">Filter</button>
</form>


<?php
// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=test01;charset=utf8';
$username = '';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des valeurs minimales et maximales du prix depuis les paramètres GET
    $minPrice = $_GET['min_price'];
    $maxPrice = $_GET['max_price'];

    // Construction de la requête SQL filtrée par prix
    $sql = "SELECT * FROM produits WHERE prix BETWEEN :min_price AND :max_price";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':min_price', $minPrice);
    $stmt->bindParam(':max_price', $maxPrice);
    $stmt->execute();

    // Affichage des produits filtrés
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Afficher les informations du produit ici
        echo $row['nom_produit'];
        echo $row['prix'];
        // ...
    }
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

// Fermeture de la connexion à la base de données
$pdo = null;
?>