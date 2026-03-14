<?php
/*
$servername = "db";
$usernameDB = "appuser";
$passwordDB = "apppass";
$database = "appdb";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $database);

if ($conn->connect_error) {
    echo "Error de conexion: " . $conn->connect_error;
} else {
    echo "Conexion OKAY";
}

$sql = "insert into users (username,password, rol) values ('tleal','12345','admin')";

if ($conn->query($sql)) {
    echo "Inserto OKAY!";
}


$sql = "update users set rol='estudiante' where username = 'tleal'";

if ($conn->query($sql)) {
    echo "Update OKAY!";
}


$sql = "delete from users where id=3";

if ($conn->query($sql)) {
    echo "DELETE OKAY!";
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
echo "<table>
<tr><th>Usuario</th><th>Rol</th></tr>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //print_r($row); // arreglo asociativa
        echo "<tr><td>".$row["username"]."</td><td>". $row["rol"]."</td></tr>";
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

