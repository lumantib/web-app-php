<!DOCTYPE html>
<head><title>User</title></head>
<body>
<div>
        <table border="1" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
            <?php
            $connection=mysqli_connect("localhost","root","","travel");
            if (!$connection)
            {
                die("connection failed".mysqli_connect_error());
            }
            $query="select * from users";
            $result=mysqli_query($connection,$query);
            if (!$result)
            {
                die("query failed...".mysqli_error($connection));
            }
            while ($row=mysqli_fetch_assoc($result))
            {
                echo "
                <tr>
                <td>$row[ID]</td>
                <td>$row[Username]</td>
                <td>$row[Password]</td>
                ";
            }
            ?>
        </table>
    </div>
</body>
</html>