<?php
require_once("includes/connect.php");

if(isset($_GET['editid'])){
$strID=0;
$strTitle="";
$strAuthor="";
$strDate="";
$strStory="";
try {
    $id=$_GET['editid'];
    $sqlLoad = "SELECT * FROM news WHERE aboutid=?";
    $dataLoad=array($id);
    $stmtLoad=$con->prepare($slqData);
    $stmtLoad->execute($dataLoad);
    $rowLoad= $stmtLoad->fetch();
    $strID=$rowLoad[0];
    $strTitle=$rowLoad[1];
    $strContent=$rowLoad[2];
    

    
} catch (PDOException $th) {
    echo $th->getMessage();
}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>News</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <!-- Start Top-Navbar -->
         <?php require_once("includes/header.php")?>
         <!-- End Top-Navbar -->
        <div id="layoutSidenav">
           <!-- Start Side-Navbar -->
            <?php require_once("includes/menu.php")?>
            <!-- End side-Navbar -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">News</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">News</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                               This page allows end-user to facilitate adding, modifying, updating, and deleting NEWS records.
                               <br>
                                <button class="btn btn-primary">Add New Records</button> 
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Records</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Data Entry</button>
                                </li>
                                </ul>
                                <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Date</th>
                                            <th>Story</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql="SELECT * FROM news";
                                        $stmt=$con->prepare($sql);
                                        $stmt->execute();
                                        $strTable="";
                                        while($row=$stmt->fetch()){
                                            $strTable.="<tr>";
                                            $strTable.="<td>{$row[0]}</td>";
                                            $strTable.="<td>{$row[1]}</td>";
                                            $content= substr(nl2br($row[2]),0,500);
                                            $strTable.="<td>{$content}...</td>";
                                        
                                            $strEditButton="<button class ='btn btn-success'>
                                                            <a href= 'process_about.php?editid={$row[0]}>
                                                            Edit</a></button>";                                    
                                            $strTable.="
                                                <td>
                                                <button type='button' class='btn btn-warning p-1'>
                                                <a href= 'process_aboutus.php?editid={$row[0]}'>Edit</button>                                               
                                                <button type='button' class='btn btn-danger p-1'> 
                                                <a href='process_aboutus.php?delid={$row[0]}'>Delete</a></button>    
                                                </td>";
                                            $strTable.="</tr>";                                              
                                        }
                                        echo $strTable;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h1>Data Entry :</h1>
                         <div class="tab-pane" id="profile" role="tabpanel" arial-labelledby="profile-tab" tabindex="0" name="entry" action="POST">
                            <div class="mb-3">
                            <form action="savenews.php" method="GET">
                                <label  >Title</label>
                                <input type="text" class="form-control" name="txtTitle" required>
                            </div>
                            <div class="row row-cols-2 mb-3">
                                <div class="col">
                                <label  >Author</label>
                                <input type="text" class="form-control" name="txtAuthor" required>
                            </div>
                            <div class="col">
                                <label  >Date Posted</label>  
                                <input type="date" class="form-control" name="txtDate" required>    
                            </input>
                            </div>
                            </div>
                            <div class="mb-3">
                                <label for="txtStory" class="form-label">Story</label>
                                <textarea class="form-control" name="txtStory" rows="5" required></textarea>
                            </div>
                            Image: <button>Choose File</button>No file chosen<br><br>
                                <button>Submit</button>
                            </form>
                        </div>
                    </div>
                </main>
                <!-- Start Footer -->
                 <?php require_once("includes/footer.php")?>
                 <!-- End Footer -->
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
