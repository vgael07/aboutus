<?php
require_once "includes/connect.php";

if(isset($_GET['delid'])){
    
    $delSQL = "DELETE FROM news WHERE newsID=?";
    $data=array($_GET['delid']);
try {
    $stmDel=$con->prepare($delSQL);
    $stmDel->execute($data);
    header('location:news.php');
    
} catch (PDOException $th) {
    echo $th->getMessage();
}
}


if (isset($_GET['txtTitle'])) {

$title = $_GET['txtTitle'];
$author = $_GET['txtAuthor'];
$datePosted = $_GET['txtDate'];
$Story = $_GET['txtStory'];

try {
    $sql="INSERT INTO news(title,author,datePosted,Story)VALUES(?,?,?,?)";
    $data=array($title,$author,$datePosted,$Story);
    $stmt=$con->prepare($sql);
    $stmt->execute($data);
    header('location:news.php');
} catch (PDOException $th) {
    echo $th->getMessage();
}
}


if (isset($_GET['editid'])) {
    $editid = $_GET['editid'];

    // Get the existing data for the record
    $sql = "SELECT * FROM news WHERE newsID = ?";
    $stmt = $con->prepare($sql);
    $stmt->execute(array($editid));
    $record = $stmt->fetch();

    if ($record) {
        // If the record exists, show the form with existing values
        $title = $record['title'];
        $author = $record['author'];
        $datePosted = $record['datePosted'];
        $Story = $record['story'];
    }
}

// Handle the update action
if (isset($_POST['update'])) {
    $editid = $_POST['editid'];
    $title = $_POST['txtTitle'];
    $author = $_POST['txtAuthor'];
    $datePosted = $_POST['txtDate'];
    $Story = $_POST['txtStory'];

    try {
        $sql = "UPDATE news SET title = ?, author = ?, datePosted = ?, Story = ? WHERE newsID = ?";
        $stmt = $con->prepare($sql);
        $stmt->execute(array($title, $author, $datePosted, $Story, $editid));
        header('location:news.php');
    } catch (PDOException $th) {
        echo $th->getMessage();
    }
}
?> 