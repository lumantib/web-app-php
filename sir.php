<!DOCTYPE html>
<html lang="en">

<?php

$defaults = array(
    "fullName" => "John Doe",
    "age" => 32,
    "weight" => 78.5,
    "gender" => "Male",
    "country" => "Nepal",
    "hobby" => array("Dancing", "Singing"),
    "dish" => array("Chowmein", "Pasta"),
    "username" => "jacksparrow",
    "password" => "blackpearl",
    "confirm" => "blackpearl"
);

$genders = array("Male", "Female");
$countries = array("India", "Pakistan", "Nepal", "Bangladesh", "Srilanka", "Bhutan", "Maldives");
$hobbies = array("Reading", "Dancing", "Singing", "Gaming", "Sports");
$dishes = array("Momo", "Chowmein", "Pasta", "Pizza", "Chat", "Samosa");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIM 4B</title>
    <style>
        header nav ul{
            background: #9c9;
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

<body>

    <header>
        <nav>
            <ul>
                <li><a href="index.php">Insert</a></li>
                <li><a href="view.php">View </a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <?php
    if (isset($_POST['__CHECK__'])) {
        $defaults = $_POST;
        sanitizeDatas();
        if($error = validateForm()) {
            showErrors($error);
            showForm();
        }else{
            saveData();
        }
    } else {
        showForm();
    }


    ?>



</body>

</html>

<?php

function showErrors($errors){
    echo <<< ERROR_TEXT
    <h2>Plese Correct These Errors</h2>
    <ul>
    ERROR_TEXT;

    foreach($errors as $error) {
        echo "<li>$error</li>";
    }

    echo "</ul>";
}

function validateForm() {
    $errors = array();

    if(strlen($_POST['fullName']) < 2) {
        $errors[] = "Name must be at least two characters long";
    }

    if($_POST['age'] != strval(intval($_POST['age']))){
        $errors[] = "Age must be a number";
    }

    if($_POST['weight'] != strval(floatval($_POST['weight']))){
        $errors[] = "Weight must be a float number";
    }

    if(!in_array($_POST['gender'], $GLOBALS['genders'])){
        $errors[] = "Invalid gender value";
    }

    if(!in_array($_POST['country'], $GLOBALS['countries'])){
        $errors[] = "Invalid country value";
    }

    foreach($_POST['hobby'] as $hobby){
        if(!in_array($hobby, $GLOBALS['hobbies'])){
            $errors[] = "Invalid hobby $hobby";
        }
    }

    foreach($_POST['dish'] as $dish){
        if(!in_array($dish, $GLOBALS['dishes'])){
            $errors[] = "Invalid dish $dish";
        }
    }

    if(strlen($_POST['username']) < 3) {
        $errors[] = "Username must be at least 3 characters long";
    }

    if(strlen($_POST['password']) < 8) {
        $errors[] = "Password must be at least 8 characters long ";
    }

    if($_POST['password'] != $_POST['confirm']) {
        $errors[] = "Passwords must match";
    }

    
    return $errors;
}

function sanitizeDatas() {
        $_POST['fullName'] = htmlentities($_POST['fullName']);
        $_POST['age'] = htmlentities($_POST['age']);
        $_POST['weight'] = htmlentities($_POST['weight']);
        $_POST['gender'] = htmlentities($_POST['gender']);
        $_POST['country'] = htmlentities($_POST['country']);
        $_POST['username'] = htmlentities($_POST['username']);
        $_POST['password'] = htmlentities($_POST['password']);
        $_POST['confirm'] = htmlentities($_POST['confirm']);

        $i=0;
        foreach($_POST['hobby'] as $hobby) {
            $_POST['hobby'][$i] = htmlentities($hobby);
            ++$i;
        }

        for($i=0; $i<count($_POST['dish']); $i++) {
            $_POST['dish'][$i] = htmlentities($_POST['dish'][$i]);
        }

}

function saveData() {
    /*
        Step 1: Connect to the database server
        Step 2: Select the desired database
        Step 3: Perform Database Query
        Step 4: Use the returned values
        Step 5: Close the connection
    */

    // 1 and 2. Connect to the database server & Select the database
    $connection = mysqli_connect("localhost","root","","bim");
    
    if(!$connection) {
        die("Can not connect to the database server ". mysqli_connect_error());
    }

    // 3. Perform Database Query
    $hobbiesStr = implode(", ", $_POST['hobby']);
    $dishesStr = implode(", ", $_POST['dish']);
    $query = "insert into students (FullName, Age, Weight, Gender, Hobbies, Dishes, Username, Password, Country)
        values ('$_POST[fullName]', $_POST[age], $_POST[weight], '$_POST[gender]', '$hobbiesStr', '$dishesStr', '$_POST[username]','$_POST[password]','$_POST[country]')
    ";

    $query = mysqli_query($connection, $query);

    if(!$query) {
        die("Can not perform query". mysqli_error($connection));
    }

    echo "<h2>Data Inserted Successfully</h2>";

    showForm();
}


function showForm()
{
    global $genders;
    global $defaults;

    echo <<<__HTML1__
        <form action="$_SERVER[PHP_SELF]" method="post">
        <table>
            <tr>
                <td>Full Name : </td>
                <td><input type="text" name="fullName" value="$defaults[fullName]"></td>
            </tr>
            <tr>
                <td>Age : </td>
                <td><input type="text" name="age" value="$defaults[age]"></td>
            </tr>
            <tr>
                <td>Weight : </td>
                <td><input type="text" name="weight" value="$defaults[weight]">
                </td>
            </tr>
            <tr>
                <td>Gender : </td>
                <td>

__HTML1__;

    foreach ($genders as $gender) {
        echo "<input type='radio' name='gender' value='$gender' ";

        if($gender == $defaults['gender']) {
            echo "checked";
        }

        echo " > $gender";
    }

    echo <<< __HTML2__
                
                </td>
            </tr>
            <tr>
                <td>Country : </td>
                <td>
                    <select name="country">

__HTML2__;

    foreach ($GLOBALS['countries'] as $country) {
        echo "<option value='$country' ";

        if($country == $defaults['country']){
            echo "selected";
        }

        echo ">$country</option>";
    }

    echo <<< __HTML3__
                    </select>
                </td>
            </tr>
            <tr>
                <td>Hobbies : </td>
                <td>

__HTML3__;

    foreach ($GLOBALS['hobbies'] as $hobby) {
        echo "<input type='checkbox' name='hobby[]' value='$hobby' ";

        if(in_array($hobby, $defaults['hobby'])) {
            echo "checked";
        }

        echo "> $hobby";
    }
    echo <<<__HTML4__
                </td>
            </tr>
            <tr>
                <td>Preferred Dishes</td>
                <td>
                    <select name="dish[]" multiple>
__HTML4__;
                foreach($GLOBALS['dishes'] as $dish) {
                    echo "<option value='$dish' name='dish[]' ";

                    if(in_array($dish, $defaults['dish'])){
                        echo "selected";
                    }

                    echo ">$dish</option>";
                }
                echo <<< __HTML5__
                    </select>
                </td>
            </tr>
            <tr>
                <td>Username : </td>
                <td><input type="text" name="username" value="$defaults[username]"/>
            </tr>
            <tr>
                <td>Password : </td>
                <td><input type="password" name="password" value="$defaults[password]" />
            </tr>
            <tr>
                <td>Confirm : </td>
                <td><input type="password" name="confirm" value="$defaults[confirm]"/>
            </tr>
            <input type="hidden" value="1" name="__CHECK__" />
            <tr>
                <td colspan="2">
                    <button>Submit</button>
                </td>
            </tr>
        </table>

    </form>

__HTML5__;
}
?>