<?php

require_once('../db/connect.php');

if(isset($_GET['id'])) {
    $idStud = $_GET['id'];

    $delete = $db->prepare("DELETE `st`, `ex` FROM `examens` AS `ex` RIGHT JOIN `etudiants` AS `st` ON ex.`id_etudiant` = st.`id_etudiant` WHERE st.`id_etudiant` = :id");
    $delete->bindParam(':id', $idStud);
    $delete->execute();

    header("Location: ../index.php");
} else {
    header("Location: ../index.php");
}