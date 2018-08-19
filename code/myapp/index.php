<?php
    $pdo = new \PDO('mysql:host=mysql;port=3306;dbname=sample_docker', 'root', 'password');
        
    $res = $pdo->query('select name, last_name from users');
    foreach ($res as $user) {
        echo '<p>' . $user[0] . ' - ' . $user[1];
    }

    //phpinfo();
?>
