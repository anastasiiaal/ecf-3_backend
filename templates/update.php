<?php
    require_once('../db/connect.php');
    $titlePage = "Modifier information";
    require_once('head.php'); 
?>
<body>
    <div class="container">
    <!-- <a href="javascript:history.go(-1)" style="margin-bottom: 40px;">< Retour à la page de l'étudiant</a> -->
        <?php
            if(isset($_GET['id'])) {                 // if there is an ID get parameter
                $idStudent = $_GET['id'];            // put its value into variable

                echo "<a href='student.php?id=" . $idStudent . "' style='margin-bottom: 40px;'>< Retour à la page de l'étudiant</a>";

                if(isset($_GET['exam'])) {           // check if there is EXAM get param
                    $idExam = $_GET['exam'];
                    $query = $db->query("
                        SELECT st.id_etudiant, st.prenom, st.nom, ex.id_examen, ex.matiere, ex.note FROM `etudiants` AS st 
                        INNER JOIN `examens` AS ex
                        ON st.id_etudiant = ex.id_etudiant
                        WHERE st.id_etudiant = $idStudent AND ex.id_examen = $idExam
                    ");
                    $queryExam = $query->fetch(PDO::FETCH_ASSOC);
                    // var_dump($queryExam);
                } else if(count($_GET) === 1) {     // if EXAM get is not set AND there is only one get parameter (the ID one)
                    $query = $db->query("
                        SELECT * FROM `etudiants` WHERE id_etudiant = $idStudent
                    ");
                    $queryStudent = $query->fetch(PDO::FETCH_ASSOC);
                    // var_dump($queryStudent);
                } else {                           // if there are many get parameters and they are different from ID && EXAM -> back to index.php
                    header("Location: ../index.php");
                }

            } else {                               // if the id parameter is not set -> back to index.php
                header("Location: ../index.php");
            }

            if(!isset($queryExam) && isset($queryStudent)) {
                // echo "let's correct student info";
                ?>
                <form class="update-info" action="update-student.php" method="post">
                    <input type="text" name="id" id="id" value="<?= $queryStudent['id_etudiant'] ?>" hidden>
                    <h2 style="margin-bottom: 20px;">Modifier étudiant : <?= $queryStudent['nom'] ?> <?= $queryStudent['prenom'] ?></h2>
                    <div class="input-div">
                        <label for="nom">Nom de l'étudiant</label>
                        <input type="text" name="nom" id="nom" value="<?= $queryStudent['nom'] ?>" required>
                    </div>
                    <div class="input-div">
                        <label for="prenom">Prénom de l'étudiant</label>
                        <input type="text" name="prenom" id="prenom" value="<?= $queryStudent['prenom'] ?>" required>
                    </div>
                    <input type="submit" name="submit" value="Sauvegarder" class="update-btn">
                </form>
                <?php
            } else if (isset($queryExam) && !isset($queryStudent)) {
                // echo "let's correct note";
                ?>
                <form class="update-info" action="update-note.php" method="post">
                    <input type="text" name="id_etudiant" id="id_etudiant" value="<?= $queryExam['id_etudiant'] ?>" hidden>
                    <input type="text" name="id_examen" id="id_examen" value="<?= $queryExam['id_examen'] ?>" hidden>
                    <h2 style="margin-bottom: 5px;">Editer la note de : <?= $queryExam['matiere'] ?></h2>
                    <h3 style="margin-bottom: 20px;">de l'étudiant : <?= $queryExam['nom'] ?> <?= $queryExam['prenom'] ?></h3>
                    <div class="input-div">
                        <label for="note">Note pour <?= $queryExam['matiere'] ?></label>
                       <!-- <input type="text" name="note" pattern="[0-9-.]{1,4}" title="Seulement les chiffres (max 20.0)" id="note" value="<?= $queryExam['note'] ?>"> -->
                        <input type="number" name="note" min="0" max="20" step="0.5" id="note" value="<?= $queryExam['note'] ?>">
                    </div>
                    <input type="submit" name="submit" value="Sauvegarder" class="update-btn">
                </form>
                <?php
            }
        ?>
    </div>
</body>