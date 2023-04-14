<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
    rel="stylesheet"
    />
</head>
<body class="bg-dark">
    <div class="container mt-4">
        <div class="row">
            <div class="col-3">
                <div class="text-center">
                    <a href="login.php">
                        <button class="btn btn-primary text-white mb-3" style="width:200px">Login</button>
                    </a>
                </div>

                <div class="text-center">
                    <a href="register.php">
                        <button class="btn btn-success text-white mb-3" style="width:200px">Register</button>
                    </a>
                </div>

                <div class="text-center">
                    <a href="logout.php">
                        <button class="btn btn-danger text-white mb-3" style="width:200px">Logout</button>
                    </a>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST">

                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="">Confirm Password</label>
                            <input type="password" name="confirmPassword" class="form-control">
                        </div>

                        <button type="submit" name="register" class="btn btn-dark text-white">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    function checkStrongPwd($checkPassword) {
        $upperCase = false;
        $lowerCase = false;
        $numbers = false;
        $specialCharacters = false;

        if (preg_match("/[A-Z]/", $checkPassword)) {
            $upperCase = true;
        }
        if (preg_match("/[a-z]/", $checkPassword)) {
            $lowerCase = true;
        }
        if (preg_match("/[0-9]/", $checkPassword)) {
            $numbers = true;
        }
        if (preg_match("/[!@#$%^&*]/", $checkPassword)) {
            $specialCharacters = true;
        }

        if ($upperCase && $lowerCase && $numbers && $specialCharacters) {
            return true;
        } else {
            return false;
        }
    }
    session_start();
        if (isset($_POST["register"])) {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirmPassword"];

            if ($name != "" && $email != "" && $password != "") {
                if(strlen($password) >= 6) {
                    if ($password == $confirmPassword) {
                        if (checkStrongPwd($password)) {
                            $_SESSION["email"] = $email;
                            $_SESSION["password"] = password_hash($password, PASSWORD_BCRYPT);
                            echo '<script>alert("Success!")</script>';
                        } else {
                            echo '<script>alert("Your password must contain at least one uppercase, one lowercase, a number and a special character.")</script>';
                        } 
                    } else {
                        echo '<script>alert("Passwords are not matched!")</script>';
                    }
                } else {
                    echo '<script>alert("Password must be greater than 6!")</script>';
                    
                }
            } else {
                echo '<script>alert("All the fields must be filled!")</script>';
            }
        }
    ?>
</body>
</html>