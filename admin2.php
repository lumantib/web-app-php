
<!DOCTYPE html>

<head>
    <title>View Records</title>
</head>

<body>

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


    </style>
</head>
<?php


?>
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
<style>
th, td {
  padding: 15px;
  text-align: left;
  border-bottom: 1px solid #ddd;
  
}
th {
  background-color: skyblue;
  color: white;
  text-align: center;
}
a.aa
{
background-color:lawngreen;
padding:1%;
color:black;
text-decoration:none;
font-weight:bold;
width:25%;
}
a.aa:hover
{
    background-color:palevioletred ;
}
a.bb
{
background-color:crimson;
padding:1%;
color:black;
text-decoration:none;
font-weight:bold;
width:25%;
}
a.bb:hover
{
    background-color:yellowgreen ;
}
tr:hover {background-color: coral;}

</style>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <p style="background-color:coral;
        padding:1%; color:white; text-decoration:none; 
        font-weight:bold; width:20%;"><a href="addadmin.php">Add admin</a></p>
        <table class="tbl-full"  cellspacing="0" width="50%" height="15%">
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
    <?php
        if (isset($_GET['action']))
        {
            if($_GET['action'] == "delete") {

                $connection = mysqli_connect("localhost","root","","bim2");
                if(!$connection) {
                    die(mysqli_connect_error());
                }
    
                $query = "delete from student where id=$_GET[id]";
                $result = mysqli_query($connection, $query);
    
                if(!$result) {
                    die(mysqli_error($connection));
                }
            }
        }
        
    ?>
    
            <?php
                $connection = mysqli_connect("localhost","root","","travel");
                
                if(!$connection) {
                    die("Connection Failed... ". mysqli_connect_error());
                }

                $query = "select * from admin";
                $result = mysqli_query($connection, $query);

                if(!$result){
                    die("Query Failed....". mysqli_error($connection));
                }

                while($row = mysqli_fetch_assoc($result)) {
                    echo "
                <tr>
                    <td>$row[id]</td>
                    <td>$row[Name]</td>
                     <td>$row[Username]</td>
                    <td>$row[Password]</td>
                        <td>
                            <a href='$_SERVER[PHP_SELF]?action=delete&id=$row[ID]'>Delete</a>
                            <br>
                            <a href='$_SERVER[PHP_SELF]?action=update&id=$row[ID]'>Update</a>
                        </td>
                    </tr>
                    ";

                }

                mysqli_close($connection);



            ?>
        </table>
    </main>
</body>
</html>
