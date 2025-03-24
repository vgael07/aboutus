<?php
require_once "includes/connect.php";

if(isset($_GET['delid'])){
    
    $delSQL = "DELETE FROM aboutus WHERE aboutid=?";
    $data=array($_GET['delid']);
try {
    $stmDel=$con->prepare($delSQL);
    $stmDel->execute($data);
    header('location:aboutus.php');
    
} catch (PDOException $th) {
    echo $th->getMessage();
}
}


if (isset($_GET['txtTitle'])) {

$title = $_GET['txtTitle'];
$content = $_GET['txtContent'];

try {
    $sql="INSERT INTO aboutus(title,content)VALUES(?,?)";
    $data=array($title,$content);
    $stmt=$con->prepare($sql);
    $stmt->execute($data);
    header('location:aboutus.php');
} catch (PDOException $th) {
    echo $th->getMessage();
}
}


// if (isset($_GET['editid'])) {
//     $editid = $_GET['editid'];

//     // Get the existing data for the record
//     $sql = "SELECT * FROM aboutus WHERE aboutid = ?";
//     $stmt = $con->prepare($sql);
//     $stmt->execute(array($editid));
//     $record = $stmt->fetch();

//     if ($record) {
//         // If the record exists, show the form with existing values
//         $title = $record['title'];
//         $content = $record['content'];
//     }
// }

// // Handle the update action
// if (isset($_POST['update'])) {
//     $editid = $_POST['editid'];
//     $title = $_POST['txtTitle'];
//     $content = $_POST['txtContent'];

//     try {
//         $sql = "UPDATE aboutus SET title = ?, content = ? WHERE aboutid = ?";
//         $stmt = $con->prepare($sql);
//         $stmt->execute(array($title, $content, $editid));
//         header('location:aboutus.php');
//     } catch (PDOException $th) {
//         echo $th->getMessage();
//     }
// }
?>