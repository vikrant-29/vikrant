<?php
$cookie_name1 = "num";
$cookie_value1 = "";
$cookie_name2 = "op";
$cookie_value2 = "";
$msg = "";

if (isset($_POST['num'])) {
    $num = $_POST['input'] . $_POST['num'];
} else {
    $num = "";
}

if (isset($_POST['op'])) {
    $cookie_value1 = $_POST['input'];
    setcookie($cookie_name1, $cookie_value1, time() + (86400 * 30), "/");

    $cookie_value2 = $_POST['op'];
    setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/");
} else {
    $msg = "Enter value first";
}

if (isset($_POST['equal'])) {
    // Check if input is empty
    if (!empty($_POST['input'])) {
        $num = $_POST['input'];

        // Ensure cookies are set before proceeding with calculations
        if (isset($_COOKIE['num']) && isset($_COOKIE['op'])) {
            switch ($_COOKIE['op']) {
                case '+':
                    $result = $_COOKIE['num'] + $num;
                    break;
                case '-':
                    $result = $_COOKIE['num'] - $num;
                    break;
                case '*':
                    $result = $_COOKIE['num'] * $num;
                    break;
                case '/':
                    // Check for division by zero
                    if ($num != 0) {
                        $result = $_COOKIE['num'] / $num;
                    } else {
                        $msg = "Error: Division by zero!";
                    }
                    break;
                default:
                    $msg = "Invalid operator!";
                    break;
            }
            $num = $result; // Update the input field with the result
        } else {
            $msg = "Invalid operation or value!";
        }
    } else {
        $msg = "Please enter a number!";
    }
} else if (isset($_POST['op']) && $_POST['op'] == 'C') {
    // Clear Cookies on 'C' button press
    setcookie($cookie_name1, "", time() - 3600, "/");
    setcookie($cookie_name2, "", time() - 3600, "/");
    $num = "";
    $msg = "Calculator reset!";
} else {
    $msg = "Enter value first";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calc.css">
    <title>PHP calculator</title>
</head>

<body>
    <h1 style="text-align: center; font-family: 'Courier New', Courier, monospace; text-decoration: underline;">calculator by using PHP</h1>
    <h4><?php echo @$msg ?></h4>
    <div class="container">
        <form action="" method="post">
            <br>
            <div class="maininput">
                <input type="text" name="input" id="in" class="main_input" value="<?php echo @$num ?>">
            </div>
            <br>
            <div class="btns">
                <input type="submit" value="9" name="num" class="numbtn">
                <input type="submit" value="8" name="num" class="numbtn">
                <input type="submit" value="7" name="num" class="numbtn">
                <input type="submit" value="*" name="op" class="opbtn"><br><br>
                <input type="submit" value="6" name="num" class="numbtn">
                <input type="submit" value="5" name="num" class="numbtn">
                <input type="submit" value="4" name="num" class="numbtn">
                <input type="submit" value="-" name="op" class="opbtn"><br><br>
                <input type="submit" value="3" name="num" class="numbtn">
                <input type="submit" value="2" name="num" class="numbtn">
                <input type="submit" value="1" name="num" class="numbtn">
                <input type="submit" value="+" name="op" class="opbtn"><br><br>
                <input type="submit" value="0" name="num" class="numbtn">
                <input type="submit" value="C" name="op" class="clrbtn">
                <input type="submit" value="=" name="equal" class="eqbtn">
                <input type="submit" value="/" name="op" class="opbtn">

            </div>

        </form>
    </div>
</body>

</html>