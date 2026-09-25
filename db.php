<?php
// Configuration des accès à la base de données
$host = 'localhost';
$dbname = 'selecto237'; // On enlève le _db pour correspondre exactement à phpMyAdmin // Assure-toi que c'est bien le nom de ta base dans phpMyAdmin
$username = 'root';        
$password = '';            // Laisse vide si tu es sur WampServer par défaut

try {
    // CORRECTION ICI : ATTR_ERRMODE (avec deux R)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>