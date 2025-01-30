<?php
    $DBSN= "mysql:host=localhost;dbname=cc3";
    $DBUSER="root";
    $DBPASSWORD= "";

    try{
        $connect = new PDO($DBSN,$DBUSER,$DBPASSWORD);
    }
    catch(PDOException){
        echo "Failed to connect";
    }
?>