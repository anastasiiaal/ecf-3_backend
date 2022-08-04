<?php

require_once('../db/connect.php');

if(isset($_GET['id'])) {
    $idStud = $_GET['id'];

    if(isset($_GET['id_examen'])) {
        $isExam = $_GET['id_examen'];


        
        header("Location: student.php?id=" . $idStud);
    }

    $delete = $db->prepare("DELETE `st`, `ex` FROM `examens` AS `ex` INNER JOIN `etudiants` AS `st` ON ex.`id_etudiant` = st.`id_etudiant` WHERE st.`id_etudiant` = :id");
    $delete->bindParam(':id', $idStud);
    $delete->execute();

    header("Location: ../index.php");
}