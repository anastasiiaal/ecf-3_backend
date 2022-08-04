<?php
    require_once('../db/connect.php');
    require_once('head.php'); 
?>
<body>
    <div class="container">
        <?php
            if(isset($_GET['id'])) {                 // if there is an ID get parameter
                $idStudent = $_GET['id'];            // put its value into variable

                if(isset($_GET['exam'])) {           // check if there is EXAM get param
                    $idExam = $_GET['exam'];
                    $query = $db->query("
                        SELECT st.prenom, st.nom, ex.id_examen, ex.matiere, ex.note FROM `etudiants` AS st 
                        INNER JOIN `examens` AS ex
                        ON st.id_etudiant = ex.id_etudiant
                        WHERE st.id_etudiant = $idStudent AND ex.id_examen = $idExam
                    ");
                    $query = $query->fetch(PDO::FETCH_ASSOC);
                    var_dump($query);
                } else if(count($_GET) === 1) {     // if EXAM get is not set AND there is only one get parameter (the ID one)
                    $query = $db->query("
                        SELECT * FROM `etudiants` WHERE id_etudiant = $idStudent
                    ");
                    $query = $query->fetch(PDO::FETCH_ASSOC);
                    var_dump($query);
                } else {                           // if there are many get parameters and they are different from ID && EXAM -> back to index.php
                    header("Location: ../index.php");
                }

                if(!$query) {                      // if there is nothing in the query -> back to index.php
                    header("Location: ../index.php");
                }

            } else {                               // if the id parameter is not set -> back to index.php
                header("Location: ../index.php");
            }
        ?>
    </div>
</body>