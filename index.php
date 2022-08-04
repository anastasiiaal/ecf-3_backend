<?php 
    require_once('db/connect.php');
    require_once('templates/head.php'); 

    if(isset($_GET['search'])) {
        if ($_GET['search'] != '') {
            $nameQuery = $_GET['search'];
            $students = $db->query("
                SELECT * FROM `etudiants` 
                WHERE (`prenom` LIKE '%" . $nameQuery . "%') 
                OR (`nom` LIKE '%" . $nameQuery . "%') 
                OR (CONCAT_WS(' ', `nom`, `prenom`) LIKE '%" . $nameQuery . "%') 
                OR (CONCAT_WS(' ', `prenom`, `nom`) LIKE '%" . $nameQuery . "%')
            ");
            $students = $students->fetchAll(PDO::FETCH_ASSOC);
            
            if (sizeof($students) == 0) {  ?>
                <div class="container">
                <?php
                    require_once('templates/search.php');
                ?>
                <h1>Liste des étudiants</h1>
                <h3 style="margin-top: 15px;">Rien à visualiser</h3>
                <?php
                die();
            }

        } else { ?>
            <div class="container">
        <?php
            require_once('templates/search.php');
        ?>

            <h1>Liste des étudiants</h1>
            <h3 style="margin-top: 15px;">Rien à visualiser</h3>
        <?php
        die();
        }
        
    } else {
        if(isset($_GET['page'])) {
            $curPage = intval($_GET['page']);
            if($curPage == 0) {
                header("Location: index.php");
            }
            $offset = ($curPage - 1) * 6;

            $students = $db->query("SELECT * FROM `etudiants` LIMIT 6 OFFSET " . $offset);
            $students = $students->fetchAll(PDO::FETCH_ASSOC);

        } else {
            $curPage = 1;
            $students = $db->query("SELECT * FROM `etudiants` LIMIT 6");
            $students = $students->fetchAll(PDO::FETCH_ASSOC);
        }

        $allStudents = $db->query("SELECT `id_etudiant` FROM `etudiants`");
        $allStudents = $allStudents->fetchAll(PDO::FETCH_ASSOC);
        
        $allPages = sizeof($allStudents) / 6;

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
                    <th>En savoir plus</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($students as $student) { ?>
                    <tr>
                        <td><?= $student['nom'] ?></td>
                        <td><?= $student['prenom'] ?></td>
                        <td><a href="templates/student.php?id=<?= $student['id_etudiant'] ?>">Voir les notes</a> →</td>
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

