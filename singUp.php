<?php
    $hostname = 'localhost';
    $username = 'root';
    $pas = '';
    $dbms_name = 'ebh';
    $conn = new mysqli($hostname,$username,$pas,$dbms_name);
    if($conn->connect_errno){
        die("Connection failed:". $conn->connect_errno);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Sing Up</title>
</head>
<body>
<?php
        if(isset($_POST['number'])){
            $num = $_POST['number'];
            $mail = $_POST['email'];
            $pass = $_POST['password'];
            if(!empty($num) && !empty($pass) && !empty($mail)){    //// if(!empty($num) && !empty($pass) && !empty($mail)) any one code
                $len = strlen($num);
                $sql = "INSERT INTO registration(password,number,email)
                        VALUES('$pass','$num','$mail')";
                if($len==11){
                    if($conn->query($sql) == TRUE){
                        echo 'informatiion inserted';      
                    }
                    // alredy gmail and phone number ace kina check..
                    else {
                        $sql = "SELECT number from registration WHERE number=$num";
                        $cheking_row = mysqli_query($conn,$sql);
                        $num_row = mysqli_num_rows($cheking_row);
                        if($num_row==TRUE)
                            echo 'number alredy cretae '."<br>"; /// pore chenge korte hobe
                        $sql = "SELECT email from registration WHERE email='$mail'";
                        $cheking_row = mysqli_query($conn,$sql);
                        $num_row = mysqli_num_rows($cheking_row);
                        if($num_row==TRUE)
                            echo "gmail alredy create";
                    } 
                }
                elseif($len<11){
                    $digit = 11;
                    echo "number digit kom ",$digit-$len; /// english  likhte hobe english ta sajed likhe debe
                }
                elseif($len>11){
                    $digit = 11;
                    echo  "number digit beshi ",$len-$digit; ///english likhte hobe..
                }
                
            }
            else{
               echo "Please enter the information";

            }
        }
    ?>
    <section>
        <h2 style="position: absolute; transform: translate(-50%,-50%); left: 50%;top: 10vh;" class="singup-titel">আপনার হিসাব খুলুন</h2>
        <div class="singup-div">
            <form action="singUp.php" method="POST">
                <!-- <input placeholder="ব্যবহারকারীর নাম" type="text"> -->
                <input placeholder="ফোন নম্বর" type="text" name="number">
                <input placeholder="বৈদ্যুতিক মেইল" type="email" name="email">
                <input placeholder="গুপ্তমন্ত্র" type="password" name="password">
                <!-- <input placeholder="পেশা" type="text"> -->
                <!-- <input placeholder="ধর্মবিশ্বাস" type="text"> -->
                <input class="sub-btn" value="দাখিল" type="submit">
            </form>
        </div>
        <div class="nav-bar">
            <a href="./index.php"><button>home</button></a>

            <a href="./login.php"><button>login</button></a>
        </div>
    </section>
</body>
</html>
