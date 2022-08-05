<?php
    require_once('../db/connect.php');

    if (isset($_POST['submit'])) {
        $idStud = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];

        $edit = $db->prepare("UPDATE `etudiants` SET `prenom`= :prenom,`nom`= :nom WHERE `id_etudiant`= :idStud");
        $edit->execute([
            'prenom' => $prenom,
            'nom' => $nom,
            'idStud' => $idStud
        ]);
    }

    if ($edit) {
        header("Location: student.php?id=" . $idStud);
    } else {
        echo "Oops sth went wrong";
    }
