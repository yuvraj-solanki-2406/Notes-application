<?php 

    $update=false;
    $insert=false;
    $delete=false;

    $servername='localhost';
    $username ='root';
    $password='';
    $database='notes';

    $conn = mysqli_connect($servername,$username,$password,$database);

    if(!$conn){
        echo "Database notconnected" . mysqli_connect_error();
    }else{
        // echo "Database connected";
    }

    if(isset($_GET['delete'])){
        $sno = $_GET['delete'];

        $sql = " DELETE FROM `user_notes` WHERE `user_notes`.`Id` = $sno ";
        $insert = mysqli_query($conn, $sql);

        $delete=true;

    }

//Adding new Note in the application 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['snoEdit'])){
            $sno=$_POST["snoEdit"];
            $tit=$_POST["titleEdit"];
            $desc=$_POST["descriptionEdit"];
    
            $sql="UPDATE `user_notes` SET `title` = '$tit ', `description` = '$desc' WHERE `user_notes`.`Id` = $sno";
    
            $insert = mysqli_query($conn, $sql);        
            if($insert){
                $update=true;
            }else{
                echo "Some error". mysqli_connect_error();
            }
        
        }
        
        else{
            $tit=$_POST["title"];
            $desc=$_POST["description"];
    
            $sql="INSERT INTO `user_notes` (`title`, `description`) VALUES ('$tit', '$desc')";
    
            $insert = mysqli_query($conn, $sql);
    
            if($insert){
                $insert=true;
            }else{
                echo "Some error". mysqli_connect_error();
            }
        }
    }

?>