<?php
// 1. Inclure le fichier de connexion à la base de données
require_once 'db.php';

// 2. Récupérer l'ID de l'article depuis l'URL et s'assurer que c'est un nombre entier
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 3. Préparer la requête pour éviter les injections SQL
$query = $pdo->prepare("SELECT * FROM articles WHERE id = :id");
$query->execute(['id' => $id]);
$article = $query->fetch();

// 4. Si aucun article ne correspond à cet ID, on redirige vers le catalogue ou affiche une erreur
if (!$article) {
    die("<h1>Erreur : Cet article n'existe pas ou a été retiré du catalogue.</h1><p><a href='articles.html'>Retourner au catalogue</a></p>");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['nom']); ?> | Selecto237</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- BARRE DE NAVIGATION (HEADER) -->
    <header>
        <div class="logo-badge">Selecto<span>237</span></div>
        <nav>
            <ul>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="articles.html" class="active">Articles</a></li>
                <li><a href="apropos.html">À Propos</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- BOUTON RETOUR -->
    <div class="back-nav">
        <a href="articles.html" class="back-link">&larr; Retourner au catalogue</a>
    </div>

    <!-- CONTENEUR PRINCIPAL DE LA FICHE PRODUIT DYNAMIQUE -->
    <main class="detail-container">
        
        <!-- COLONNE GAUCHE : L'IMAGE DE L'ARTICLE -->
        <div class="detail-image-block">
            <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="<?php echo htmlspecialchars($article['nom']); ?>">
        </div>

        <!-- COLONNE DROITE : LES INFORMATIONS DE L'ARTICLE -->
        <div class="detail-info-block">
            <span class="detail-category"><?php echo htmlspecialchars($article['categorie']); ?></span>
            <h1><?php echo htmlspecialchars($article['nom']); ?></h1>
            
            <!-- Formatage propre du prix (ex: 550 000) -->
            <p class="detail-price"><?php echo number_format($article['prix'], 0, ',', ' '); ?> FCFA</p>
            
            <div class="detail-description">
                <h3>Présentation de l'article</h3>
                <p><?php echo htmlspecialchars($article['description']); ?></p>
            </div>

            <!-- FICHE TECHNIQUE DYNAMIQUE -->
            <div class="tech-specs">
                <h3>Fiche Technique</h3>
                <table>
                    <tr>
                        <td><strong>Écran</strong></td>
                        <td><?php echo htmlspecialchars($article['ecran']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Processeur</strong></td>
                        <td><?php echo htmlspecialchars($article['processeur']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Mémoire RAM</strong></td>
                        <td><?php echo htmlspecialchars($article['ram']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Stockage</strong></td>
                        <td><?php echo htmlspecialchars($article['stockage']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Batterie / Alim</strong></td>
                        <td><?php echo htmlspecialchars($article['batterie']); ?></td>
                    </tr>
                </table>
            </div>

            <!-- ACTION -->
            <div class="detail-action">
                <a href="contact.html?article=<?php echo urlencode($article['nom']); ?>" class="btn">Se renseigner sur cet article</a>
            </div>
        </div>

    </main>

    <!-- PIED DE PAGE (FOOTER) -->
    <footer>
        <p>&copy; 2026 Selecto237. Tous droits réservés. Présentation d'articles High-Tech de qualité.</p>
    </footer>

</body>
</html>