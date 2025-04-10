if(isset($_POST['txtTitle'])){
    $id=$_POST['txtid'];
    $title = htmlspecialchars(trim($_POST['txtTitle']));
    $content = trim($_POST['txtContent']);
    $content = filter_var($content, FILTER_SANITIZE_STRING);
    try{
        if($id==0){
            sql="INSERT INTO aboutus(atitle,acontent)VALUES"
        }
    }
}