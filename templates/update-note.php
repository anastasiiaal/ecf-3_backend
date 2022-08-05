<?php
    require_once('../db/connect.php');

    if (isset($_POST['submit'])) {
        $idStud = $_POST['id_etudiant'];
        $idExam = $_POST['id_examen'];
        $note = $_POST['note'];

        $edit = $db->prepare("UPDATE `examens` SET `note`= :note WHERE `id_examen`= :idExam AND `id_etudiant`= :idStud");

        $edit->execute([
            'note' => $note,
            'idExam' => $idExam,
            'idStud' => $idStud
        ]);
    }

    if ($edit) {
        header("Location: student.php?id=" . $idStud);
    } else {
        echo "Oops sth went wrong";
    }
