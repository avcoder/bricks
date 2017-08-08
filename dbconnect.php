<?php

$dsn = 'mysql:host=example1.localhost;dbname=avpeace';
$usernm = 'root';
$passwd = 'mustardseed';

// connect to db - dbtype, svr adrs, dbname, username, pwd
try {
    $conn = new PDO($dsn, $usernm, $passwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch (PDOException $error) {
    echo "There was a problem connecting to db";
    echo $error->getMessage();
}

?>