<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=ecf-3-students;charset=utf8', 'root');
} catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}