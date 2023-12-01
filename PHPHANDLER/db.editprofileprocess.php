<?php
session_start();
require "../PHPHANDLER/db.connection.php";

if (isset($_SESSION["MountBeeid"])) {
    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
if(strlen($fName)>3){
    Database::iud("UPDATE customer SET `fname`='".$fName."' WHERE `cid`='".$_SESSION["MountBeeid"]."';");
}
if(strlen($lName)>3){
    Database::iud("UPDATE customer SET `lname`='".$lName."' WHERE `cid`='".$_SESSION["MountBeeid"]."';");
}
if(strlen($email)>3){
    Database::iud("UPDATE customer SET `email`='".$email."' WHERE `cid`='".$_SESSION["MountBeeid"]."';");
}
if(strlen($password)>3){
    $hash_Password = password_hash($password, PASSWORD_DEFAULT);
    Database::iud("UPDATE customer SET `lname`='".$hash_password."' WHERE `cid`='".$_SESSION["MountBeeid"]."';");
}
if(isset($_FILES["upimges"])){
    $name = round(microtime(true)) . substr(md5(rand()), 0, 4);
    $newfilename = '../Images/Profile Images/' . $name;
    $imagename = $name . $_FILES["upimges"]['name'];


    if (strlen($imagename) >= 15) {

        $imagespass = "../IMAGES/Profile Images//" . $imagename;

        $imgtmp_name = $_FILES['upimges']['tmp_name'];
        move_uploaded_file($imgtmp_name, $imagespass);
        Database::iud("INSERT INTO profile_image(`cid`,`img_url`)VALUES('" . $_SESSION["MountBeeid"] . "','" . $imagename . "');");
    } 
}
echo'success';
} else {
?>
    <script>
        window.location = "../PHP/signin.php";
    </script>
<?php
}
?>