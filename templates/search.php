<form action="index.php?search" method="GET" class="search-form">
    <?php if(isset($_GET['search'])) { ?>
        <a style="display: inline-block; margin-right: 15px" href="index.php">Clear <i class="fa fa-times"></i></a>
    <?php } ?>
    <input type="text" name="search" placeholder="Rechercher l'étudiant.."><button type="submit"><i class="fa fa-search"></i></button>
</form>

<?php

