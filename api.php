<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "koneksi.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    $result = $conn->query("SELECT * FROM kelompok");
    $data = [];
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    echo json_encode($data);
    break;

  case 'POST':
    $input = json_decode(file_get_contents("php://input"), true);
    $nama = $conn->real_escape_string($input['nama']);
    $conn->query("INSERT INTO kelompok (nama) VALUES ('$nama')");
    echo json_encode(["status" => "success"]);
    break;

  case 'PUT':
    $input = json_decode(file_get_contents("php://input"), true);
    $id   = (int)$input['id'];
    $nama = $conn->real_escape_string($input['nama']);
    $conn->query("UPDATE kelompok SET nama='$nama' WHERE id=$id");
    echo json_encode(["status" => "success"]);
    break;

  case 'DELETE':
    $input = json_decode(file_get_contents("php://input"), true);
    $id   = (int)$input['id'];
    $conn->query("DELETE FROM kelompok WHERE id=$id");
    echo json_encode(["status" => "success"]);
    break;

  default:
    echo json_encode(["error" => "Method not allowed"]);
}
?>
