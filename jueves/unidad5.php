<?php
/*
$hostname = "db";
$database = "appdb";
$usernameDB = "appuser";
$passwordDB = "apppass";


$conn = new mysqli($hostname, $usernameDB, $passwordDB, $database);

if ($conn->connect_error) {

    echo "Conexion error: " . $conn->connect_error;
} else {
    echo "Conexion OKAY!!";
}
/*
$query = "insert into user (username,password,rol) values ('kleal','12345','admin')";
$result = $conn->query($query);

if($result){
    echo "Insert OKAY!";
}

*/
/*
$query = "update user set rol ='profesor' where username='kleal'";
$result = $conn->query($query);

if($result){
    echo "Update OKAY!";
}


$query = "delete from user where id=3";
$result = $conn->query($query);

if($result){
    echo "Delete OKAY!";
}


$query = "select * from user";
$result = $conn->query($query);

echo "<table>
<tr><th>Usuario</th><th>Rol</th></tr>";
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["username"]."</td><td>".$row["rol"]."</th></td>";
    }
}
echo "</table>";

*/

$host = "db";
$dbname = "appdb";
$username = "appuser";
$password = "apppass";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$stmt = $conn->query("SELECT * FROM user");
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table>
<tr><th>Usuario</th><th>Rol</th></tr>";
if (!empty($result)) {
    foreach ($result as $row) {
        echo "<tr><td>" . $row["username"] . "</td><td>" . $row["rol"] . "</th></td>";
    }
}

echo "</table>";

$stmt = $conn->prepare("update user set rol =:rol where username=:username");
$stmt->execute(['rol' => 'admin', 'username' => 'kleal']);


$stmt = $conn->prepare("DELETE FROM user WHERE id = :id");
$stmt->execute(['id' => 3]);

$password = password_hash('12345',PASSWORD_BCRYPT);
$stmt = $conn->prepare("INSERT INTO user (username, password) VALUES (:username, :password)");
$result = $stmt->execute(['username' => 'tleal','password'=> $password]);

print_r($_GET);

$page = $_GET['page'] ?? 'login';

echo $page;