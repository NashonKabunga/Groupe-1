<?php
include('connection.php');

// Ajouter un livre
if (isset($_POST['add_book'])) {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    

    $sql = "INSERT INTO livres (titre, auteur) VALUES ('$titre', '$auteur')";
    $conn->exec($sql);
    echo "Livre ajouté avec succès!";
}

// Mettre à jour un livre
if (isset($_POST['update_book'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    

    $sql = "UPDATE livres SET titre = '$titre', auteur = '$auteur' WHERE id = $id";
    $conn->exec($sql);
    echo "Livre mis à jour avec succès!";
}

// Emprunter un livre
if (isset($_POST['borrow_book'])) {
    $book_id = $_POST['livre_id'];
    $borrower = $_POST['emprunt'];
    $borrow_date = $_POST['date_emprunt'];

    // Vérifier si le livre est disponible
    $stmt = $conn->prepare("SELECT * FROM livres WHERE id = ?");
    $stmt->execute([$livre_id]);
    $book = $stmt->fetch();
    if ($book['available'] == 1) {
        // Emprunter le livre
        $sql = "INSERT INTO emprunt (livre_id, emprunt, date_umprunt) VALUES ('$livre_id', '$emprunt', '$date_emprunt')";
        $conn->exec($sql);
        
        // Marquer le livre comme emprunté (disponible = false)
        $sql = "UPDATE livres SET available = 0 WHERE id = $livre_id";
        $conn->exec($sql);
        
        echo "Livre emprunté avec succès!";
    } else {
        echo "Désolé, ce livre n'est pas disponible.";
    }
}

// Retourner un livre
if (isset($_POST['return_book'])) {
    $borrow_id = $_POST['borrow_id'];
    $date_retour = $_POST['date_retour'];

    // Marquer l'emprunt comme retourné
    $sql = "UPDATE umprunt SET date_retour = '$date_retour' WHERE id = $borrow_id";
    $conn->exec($sql);

    // Rendre le livre disponible
    $stmt = $conn->prepare("SELECT * FROM umprunt WHERE id = ?");
    $stmt->execute([$borrow_id]);
    $emprunt = $stmt->fetch();
    $livre_id = $emprunt['livre_id'];

    $sql = "UPDATE livres SET available = 1 WHERE id = $livre_id";
    $conn->exec($sql);
    
    echo "Livre retourné avec succès!";
}

// Récupérer la liste des livres
$stmt = $conn->prepare("SELECT * FROM livres");
$stmt->execute();
$livres = $stmt->fetchAll();
?>