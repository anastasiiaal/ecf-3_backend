<?php 
    require_once('db/connect.php');
    require_once('templates/head.php'); 

    // basic query that will be used to add precisions
    $basicQuery = "SELECT DISTINCT
            st.`id_etudiant`,
            `prenom`,
            `nom`, 
            (SELECT note FROM examens WHERE matiere = 'Mathématiques' AND id_etudiant = st.`id_etudiant`) as `m`,  
            (SELECT note FROM examens WHERE matiere = 'Histoire-Geographie' AND id_etudiant = st.`id_etudiant`) as `hg`,
            ((SELECT note FROM examens WHERE matiere = 'Mathématiques' AND id_etudiant = st.`id_etudiant`)+(SELECT note FROM examens WHERE matiere = 'Histoire-Geographie' AND id_etudiant = st.`id_etudiant`))/2 AS `avg`
        FROM `etudiants` as st 
        INNER JOIN `examens` as ex  
        ON st.`id_etudiant` = ex.`id_etudiant`";

    if(isset($_GET['search'])) {  
        if ($_GET['search'] != '') {           // if search get is not empty, do the query
            $nameQuery = $_GET['search'];
            $students = $db->query("
                $basicQuery 
                WHERE (`prenom` LIKE '%" . $nameQuery . "%') 
                OR (`nom` LIKE '%" . $nameQuery . "%') 
                OR (CONCAT_WS(' ', `nom`, `prenom`) LIKE '%" . $nameQuery . "%') 
                OR (CONCAT_WS(' ', `prenom`, `nom`) LIKE '%" . $nameQuery . "%')
            ");
            $superQuery = $students->fetchAll(PDO::FETCH_ASSOC);
            
            if (sizeof($superQuery) == 0) {   // if no match found 
                ?>   
                <div class="container">
                <?php
                    require_once('templates/search.php');
                ?>
                <h1>Liste des étudiants</h1>
                <h3 style="margin-top: 15px;">Rien à visualiser</h3>  
                <?php                          
                die();                       // message "nothing to show", die function
            }

        } else { ?>
            <div class="container">
        <?php
            require_once('templates/search.php');
        ?>
            <h1>Liste des étudiants</h1>
            <h3 style="margin-top: 15px;">Rien à visualiser</h3> 
        <?php
        die();                             // else if get search is empty => message "nothing to show", die function
        }
        
    } else {
        if(isset($_GET['page'])) {         // if there is get page
            $curPage = intval($_GET['page']);
            if($curPage == 0) {
                header("Location: index.php");
            }
            $offset = ($curPage - 1) * 6;

            $students = $db->query("$basicQuery LIMIT 6 OFFSET " . $offset);
            $superQuery = $students->fetchAll(PDO::FETCH_ASSOC);

        } else {                        // if get page is not defined (e.g., on load of index.php), work as if it was page 1
            $curPage = 1;
            $students = $db->query("$basicQuery LIMIT 6");
            $superQuery = $students->fetchAll(PDO::FETCH_ASSOC);
        }

        $allStudents = $db->query("SELECT `id_etudiant` FROM `etudiants`"); 
        $allStudents = $allStudents->fetchAll(PDO::FETCH_ASSOC);            // small query to count number of students...
        
        $allPages = sizeof($allStudents) / 6;                               // ... to understand how many pages to generate
        if(is_float($allPages)) {                                           // but probably division will not be integer, then round to bigger integer to get all pages
            $allPages = ceil($allPages);
        }

        if($curPage > $allPages) {
            header("Location: index.php");
        }
    }
?>

<body>
    <div class="container">
        <?php
            require_once('templates/search.php');
        ?>
        <h1>Liste des étudiants</h1>
        <table class="main-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Mathématiques</th>
                    <th>Histoire-Geographie</th>
                    <th>Note moyenne</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($superQuery as $student) { ?>
                    <tr>
                        <td><?= $student['nom'] ?></td>
                        <td><?= $student['prenom'] ?></td>
                        <td><?= !is_null($student['m']) ? $student['m'] : '-' ?></td>
                        <td><?= !is_null($student['hg']) ? $student['hg'] : '-' ?></td>
                        <td><?= !is_null($student['avg']) ? $student['avg'] : '-' ?></td>
                        <td><a class="backend backend-change" href="templates/student.php?id=<?= $student['id_etudiant'] ?>">Modifier →</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if(!isset($_GET['search'])) { ?>
            <div class="pagination">
                <?php for($i=1; $i <= $allPages; $i++) { ?>
                    <div class="page"><a class="<?= $curPage === $i ? 'active' : '' ?>" href="index.php?page=<?= $i ?>"><?= $i ?></a></div>
                <?php } ?>
            </div> 
        <?php } ?>
    </div>
</body>
</html>

