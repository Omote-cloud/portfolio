<?php
require_once("config/config.php");

require_once(ROOT_PATH.'/libs/function.php');
//Object creation
$userdata=new DB_con();
if(isset($_POST['submit']))
{
    //Posted Values
    $fname = $_POST['fullname'];
    $uname = $_POST['username'];
    $uemail = $_POST['email'];
    $password = md5($_POST['password']);
    
    //Function Calling
    $sql = $userdata->registration($fname, $uname, $uemail, $password);
        if($sql)
        {
            header("Location:index.php");
        }
        else
        {
           //Message for unsuccessful insertion
           echo "Something went wrong. Please try again";
           header("Location:index.php");
        }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>Login Registration With Remember me</title>
    <style>
        
    </style>
    </head>
    <body>
        
        <div class="container p-4">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-6 border p-4 bg-light">
                    <form action="" method="post" id="login" onsubmit="return checkall();">
                        <h4> PHP Registration with oops Concept</h4>
                        
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input name="fullname" type="text" class="form-control" id="fullname" placeholder="" required="true">
                            </div>
                            
                            <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" id="username" name="username" onkeyup="check_uname()" class="form-control" required="true">
                                <span id="name_status"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" onkeyup="checkemail()" placeholder="" class="form-control" required="true">
                                <span id="email_status"></span>
                            </div>
                            
                            <div class="col-sm-12 text-right">
                                <button class="btn btn-primary" type="submit" id="submit" name="submit">Register</button>
                            </div>
                            
                            <div class="col-12 pt-4">
                                <em>
                                    <p><b>Below username and email is already available:</b></p>
                                    <p>User: admin</p>
                                    <p>Email: bootstrapfriendly@gmail.com</p>
                                </em>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    function check_uname()
    {
        var uname=document.getElementById("Username").value;
        
        if(uname)
        {
            $.ajax({
                type: 'post',
                url: 'libs/checkdata.php',
                data: {
                    username: uname,
                },
                success: function (response) {
                    $( '#name_status' ).html(response);
                    if(response=="Available")
                    {
                        $(".form-group span").addClass("text-success");
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
            });
        }
        
        else
        {
            $('#name_status').html("");
            return false;
        }
    }
    
    function checkemail()
    {
        var uemail = document.getElementById( "Email").value;
        
        if(email)
        {
            $.ajax({
                type: 'post',
                url: 'libs/checkdata.php',
                data: {
                    email:uemail,
                },
                success: function(response) {
                    $( '#email_status' ).html(response);
                    if(response == "Available")
                    {
                        $(".form-group span").addClass("text-success");
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
            });
        }
        else
        {
            $( '#email_status' ).html("");
            return false;
        }
    }
    
    function checkall()
    {
        var namehtml = document.getElementById("name_status").innerHTML;
        var emailhtml = document.getElementById("email_status").innerHTML;
        
        if((namehtml && emailhtml) == "Available")
        {
            $(".form-group span").addClass("text-success");
            return true;
        }
        else
        {
            return false;
        }
    }
</script>