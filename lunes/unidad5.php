<?php

$servername = "db";
$usernameDB = "appuser";
$passwordDB = "apppass";
$dbname = "appdb";


$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {

    die("Error: " . $conn->connect_error);
} else {
    echo "Conexion Exitosa";
}
echo "<br>";

$sql = "select * from users";
$result = $conn->query($sql);

$result = $result->fetch_all();

$sql = "delete from users where id=2";
$result = $conn->query($sql);

if ($result) {
    echo "se borro exitosamente";
}


$sql = "update users set rol='estudiante' where id=1";
$result = $conn->query($sql);

if ($result) {
    echo "se actualizo exitosamente";
}
print_r($result);


/*
$sql = "insert into users (username,password,rol) values ('klealr','12345','admin') ";
$result = $conn->query($sql);

if ($result) {
    echo "se ingreso exitosamente";
}
print_r($result);
*/


$sql = "select * from users";
$result = $conn->query($sql);

$result = $result->fetch_all();


print_r($result);
