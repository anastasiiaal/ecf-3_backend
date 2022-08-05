<body>
    <div class="container">
        <a href="javascript:history.go(-1)" style="margin-bottom: 40px;">< Retour à la liste</a>
        
<?php 

require_once('../db/connect.php');
require_once('head.php'); 

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $student = $db->query("
        SELECT st.prenom, st.nom, ex.id_examen, ex.matiere, ex.note 
        FROM `etudiants` AS st 
        INNER JOIN `examens` AS ex
        ON st.id_etudiant = ex.id_etudiant
        WHERE st.id_etudiant = $id
    ");
    $student = $student->fetchAll(PDO::FETCH_ASSOC);
    
    if (sizeof($student) == 0) {
        $student = $db->query("
            SELECT st.prenom, st.nom 
            FROM `etudiants` AS st 
            WHERE st.id_etudiant = $id
        ");
        $student = $student->fetch(PDO::FETCH_ASSOC);
        echo "<h1 style='margin-bottom: 40px;'>Fiche personnelle de l'étudiant : " . $student['nom'] . ' ' . $student['prenom'] . "</h1>";
        
        echo "<h3>Notes pour les examens :</h3>";
        echo "<h4 style='margin-top: 20px; opacity: 80%'>Pas d'examen passé</h4>"; ?>
        <div class="btn-wrap" style="margin-top: 40px">
            <a style="margin-right: 15px" class="backend backend-update" href="update.php?id=<?= $id ?>">Modifier le nom</a>
            <a class="backend backend-delete" href="delete-student.php?id=<?= $id ?>">Supprimer étudiant</a>
        </div>
        <?php
        die();
    }

    if(!$student) {
        echo "<h1 style='margin: 20px 0;'>Etudiant n'existe pas</h1>";
        die();
    } else { ?>
        <h1 style="margin-bottom: 40px;">Fiche personnelle de l'étudiant : <?= $student[0]['nom'] . " " . $student[0]['prenom'] ?> </h1>
        
        <h3>Notes pour les examens :</h3>
        <ol>
            <?php foreach($student as $st) { ?>
                <li>
                    <table class="student-table">
                        <tr>
                            <td><?= $st['matiere'] ?></td>
                            <td><b><?= $st['note'] ?></b></td>
                            <td><a class="backend backend-update" href="update.php?id=<?= $id ?>&exam=<?= $st['id_examen'] ?>">Modifier</a></td>
                            <td><a class="backend backend-delete" href="delete-note.php?id=<?= $id ?>&exam=<?= $st['id_examen'] ?>">Supprimer</a></td>
                        </tr>
                    </table>
                </li>
            <?php } ?>
        </ol>

        <h3 style="margin-top: 40px">Gestion de l'étudiant :</h3>
        <div class="btn-wrap" style="margin-top: 40px">
            <a style="margin-right: 15px" class="backend backend-update" href="update.php?id=<?= $id ?>">Modifier le nom</a>
            <a class="backend backend-delete" href="delete-student.php?id=<?= $id ?>">Supprimer étudiant</a>
        </div>
        </div>
        </body>
<?php
    }
}





        