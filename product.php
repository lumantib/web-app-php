<!DOCTYPE html>
<head>User</head>
<body>
<div>
        <table border="1" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Price</th>
                <th>Productname</th>
            </tr>
            <?php
            $connection=mysqli_connect("localhost","root","","travel");
            if (!$connection)
            {
                die("connection failed".mysqli_connect_error());
            }
            $query="select * from product";
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
                <td>$row[Price]</td>
                <td>$row[Productname]</td>
                ";
            }
            ?>
        </table>
    </div>
</body>
</html>