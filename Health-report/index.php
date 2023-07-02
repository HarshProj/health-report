<?php 
include 'db.php';
// isset is checks that is the siubmit button is clicked or not
if(isset($_POST['submit'])){
    $username=mysqli_real_escape_string($con,$_POST['username']);
    $age=mysqli_real_escape_string($con,$_POST['age']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $weight=mysqli_real_escape_string($con,$_POST['weight']);
    $document=$_POST['document'];
    $emailquerry="select * from healthreport where email='$email'";
    $query=mysqli_query($con,$emailquerry);
    $emailcount=mysqli_num_rows($query);
    print_r($_FILES["document"]["name"]);
    $filename=$_FILES["document"]["name"];
    $tempname=$_FILES["document"]["tmp_name"];
    $folder="images/".$filename;
    move_uploaded_file($tempname,$folder);
    if($emailcount>0){
        echo "Email already exist";
    }
    else{
        $insertquerry="insert into healthreport(username,age,weight,email,document) value('$username','$age','$weight','$email','$document')";
        $iquery=mysqli_query($con,$insertquerry);
        if($iquery){
            ?>
            
            <script>
                alert("inserted Successful");
                </script>
            <?php
        }
        else{
            ?>
            <script>
                alert("unable to insert");
                </script>
            <?php
        }
    }
    
}
?>

<?php
    if(isset($_POST['sear'])){
        $search=$_POST['search'];
        $exist="select `document` from `healthreport` where email='$search'";
        $found=mysqli_query($con,$exist);
        // $row=mysqli_fetch_array($con,$found);
        $fi=$found->fetch_assoc()['document'];
        if($found){
            ?>
            <a  href=".\images\<?php echo $fi ?>">Click here</a>
            <?php
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <style>
        body{
            background: url('./asset/bg_image.jpg');
            background-size:cover;
            font-family: 'Balsamiq Sans', cursive;
            background-repeat: no-repeat;
            height: 80vh;
        }
        .main{
            display: flex;
            align-items: start;
            justify-content: space-around;
           flex-direction: column;
           gap: 2rem;
           width: 40%;
        }
        .box{
            display: flex;
            height: 70vh;
            align-items: center;
            justify-content: center;
        }
        .btn{
            width: 100%;
            display: flex;
            justify-content: space-around;
        }
        button{
            padding: 5px 10px;
            
            background-color: rgb(148, 97, 184);
            border: 2px solid gray;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover{
            background-color: #ff6a6a;
        }
        .imge{
            width: 30%;
            height: 40%;
        }
        .pdf{
            display: block;
            border: 0px;
        }
        input{
            padding: 5px;
            border: 2px solid gray;
            border-radius: 5px;
            font-size: medium;
        }
        @media (max-width:456px){
            .imge{
                display: none;
            }
        }
    </style>
</head>
<body>
    
    <form action="" method="POST" enctype="multipart/form-data">
            <div class="box">
            <div class="main">
            <div class="inps">
                Name:<input type="username"  name="username" placeholder="Enter your name" class="" required >
                
            </div>
            <div class="inps">
                
                Age:<input type="Age" placeholder="Enter your age" name="age" class="" required>
            </div>
            <div class="inps">
                weight(in kg):<input type="number" name="weight" placeholder="Your weight in Kg" class="" required>
                
            </div>
            <div class="inps">
                
                Email:<input type="email" name="email" class="" placeholder="Enter your Email" required>
            </div>
            <div class="inps">
                Upload your health report:<input name="document" type="file" placeholder="" class="pdf" required>
                
            </div>
            <div class="btn">
                <button class="inps btni " name="submit" type="submit" >Submit</button>

            </div>
        </div>
            <img src="./asset/user.png" class="imge" alt="">
        </div>
        </form>
        <form action="" method="POST">
            Search for report: <input type="search" placeholder="Search for your report" name="search">
            <button name="sear">search</button>
        </form>

</body>
</html>