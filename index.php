

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bibliothèque</title>
</head>
<body>
    <h1>Gestion de la bibliothèque</h1>

    <h2>Ajouter un livre</h2>
    <form method="post">
        <input type="text" name="titre" placeholder="Titre" required><br>
        <input type="text" name="auteur" placeholder="Auteur" required><br>
        <input type="submit" name="add_book" value="Ajouter">
    </form>

    <h2>Liste des livres</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Disponibilité</th>
            <th>Action</th>
        </tr>
        <?php foreach ($books as $book): ?>
        <tr>
            <td><?= $book['id'] ?></td>
            <td><?= $book['titre'] ?></td>
            <td><?= $book['auteur'] ?></td>
            
            <td><?= $book['available'] ? 'Disponible' : 'Emprunté' ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $book['id'] ?>">
                    <input type="text" name="titre" value="<?= $book['titre'] ?>" required>
                    <input type="text" name="auteur" value="<?= $book['auteur'] ?>" required>
                    <input type="submit" name="update_book" value="Mettre à jour">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Emprunter un livre</h2>
    <form method="post">
        <input type="number" name="livre_id" placeholder="ID du livre" required><br>
        <input type="text" name="emprunt" placeholder="Nom de l'emprunteur" required><br>
        <input type="date" name="date_emprunt" required><br>
        <input type="submit" name="borrow_book" value="Emprunter">
    </form>

    <h2>Retourner un livre</h2>
    <form method="post">
        <input type="number" name="id" placeholder="ID de l'emprunt" required><br>
        <input type="date" name="date_retour" required><br>
        <input type="submit" name="return_book" value="Retourner">
    </form>
</body>
</html>
