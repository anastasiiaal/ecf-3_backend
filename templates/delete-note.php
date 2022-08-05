<?php

require_once('../db/connect.php');

if(isset($_GET['id'])) {
    $idStud = $_GET['id'];

    if(isset($_GET['exam'])) {
        $idExam = $_GET['exam'];

        $delete = $db->prepare("DELETE FROM `examens` WHERE `id_examen` = :idExam AND `id_etudiant` = :idStud");
        $delete->bindParam(':idExam', $idExam);
        $delete->bindParam(':idStud', $idStud);
        $delete->execute();

        header("Location: student.php?id=" . $idStud);
        // header("Location: ../index.php");
    }
} else {
    header("Location: ../index.php");
}