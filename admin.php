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
                <li><a href="admin.php">|User|</a></li>
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
        <h1>Manage User</h1>
        <p style="background-color:coral;
        padding:1%; color:white; text-decoration:none; 
        font-weight:bold; width:20%;"><a href="register.php">Add User</a></p>
       <div>
        <table border="1" cellspacing="0" width="50%">
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
            <?php
            $connection=mysqli_connect("localhost","root","","travel");
            if (!$connection)
            {
                die("connection failed".mysqli_connect_error());
            }
            $query="select *from users";
            $result=mysqli_query($connection,$query);
            if (!$result)
            {
                die("query failed...".mysqli_error($connection));
            }
            $count=mysqli_num_rows($result);
            if ($count>0)
            {
                while($rows=mysqli_fetch_assoc($result))
                {
                    $Username=$rows['username'];
                    $Password=$rows['password'];
                    ?>
                    <tr>
                <td><?php echo $Username; ?></td>
                <td><?php echo $Password; ?></td>
                <td>
                                <a href='$_SERVER[PHP_SELF]?action=delete&ID=$row[id]' class="aa">Delete User</a>
                                <a href='$_SERVER[PHP_SELF]?action=update&ID=$row[id]' class="bb">Update User</a>
                            </td>
            </tr>
                    <?php   
                }
            }
            else
            {

            }
            ?>
        </table>
    </div>
      
    <?php
    if (isset($_GET['action']))
    {
        if($_GET['action'] == "delete") {
            $connection = mysqli_connect("localhost","root","","travel");
            if(!$connection) {
                die(mysqli_connect_error());
            }

            $query = "delete from admin where ID=$_GET[id]";
            $result = mysqli_query($connection, $query);

            if(!$result) {
                die(mysqli_error($connection));
            }
        }
    }
    ?>