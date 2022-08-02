<!DOCTYPE html>
<?php
    $defaults=array(
        "name"=>"john cena",
        "uname"=>"jiji",
        "pw"=>"a"
    )
?>
<head>
    <title>hehe</title>
</head>
<style>
        header nav ul{
            background: lightseagreen;
            width: 40%;
            margin: 0 auto;
            height: 45px;
            line-height: 40px;
            text-align: center;
            border-radius: .7em;
        }

        ul li {
            display: inline;
        }

        ul li a:link, ul li a:visited {
            padding: 1em;
            text-decoration: none;
            color: #fff;
        }

        ul li a:focus{
            color: pink;
        }

        ul li a:hover{
            background: #fff;
            color: brown;
            border-bottom: 2px solid brown;
        }
        body
        {
            background-repeat:no-repeat;
            background-size: 700px 700px;
            background-position: center;
            background-attachment: fixed;
        }

    </style>
<body background="admin.jpg">
<header>
        <nav>
            <ul>
                <li><a href="1.php">|Home|</a></li>
                <li><a href="admin.php">|Admin|</a></li>
                <li><a href="view.php">|Travel package| </a></li>
                <li><a href="login.php">|Price|</a></li>
            </ul>
        </nav>
    </header>
<?php
    if (isset($_POST['formsubmit'])) {
        $defaults=$_POST;
        if ($error = validatedata()) {
            displayerrors($error);
            showform();
        } else {
            savedata();
        }
    } else {
        showform();
    }
    ?>
</body>
</html>
<?php
    function showform()
{
    global $defaults;
    echo <<<__html1__
   <table>
    
        <form action="$_SERVER[PHP_SELF]" method="post">
        <tr>
        
            <td>Name:</td>
            <td><input type="text" name="name" value="$defaults[name]"></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="uname" value="$defaults[uname]"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="pw"></td>
        </tr>
        
        <input type="hidden" value="1" name="formsubmit">
        <tr>
            <td colspan="2"><input type="submit" value="Submit"></td>
        </tr>
        </form>
        </table>
__html1__;
}
function savedata() {
    $connection = mysqli_connect("localhost","root","","travel");
    
    if(!$connection) {
        die("Can not connect to the database server ". mysqli_connect_error());
    }  
    $query = "insert into admin (Name,Username,Password)
        values ('$_POST[name]', '$_POST[uname]', '$_POST[pw]')
    ";

    $query = mysqli_query($connection, $query);

    if(!$query) {
        die("Can not perform query". mysqli_error($connection));
    }

    echo "<h2>Data Inserted Successfully</h2>";

    showForm();
}

    function validatedata()
    {
        $errors = array();
        if (strlen($_POST['name']) < 2 || strlen($_POST['name'])>11) {
            $errors[] = "Name must be Atleast between 2-11 characters long";
        }
        if (strlen($_POST['uname']) < 2 || strlen($_POST['uname'])>10) {
            $errors[] = "UserName must be Atleast between 2-11 characters long";
        }
        if (strlen($_POST['pw']<2))
        {
            $errors[]="at least 2 characters long";
        }
       
        return $errors;
    }
    function displayerrors($errors)
    {
        echo "<strong>Please address these issues:</strong><p style='color:red;'>";
        foreach ($errors as $error) {
            echo "$error</br>";
        }
        echo "</p>";
    }   
?>
