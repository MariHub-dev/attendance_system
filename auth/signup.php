<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Signup Page </title>
</head>

<body>
    <div class="conatiner  justify-content-center align-items-center gap-3 vh-100">
        <div class="row">

            <div class="col-md-12 right_side justify-content-center align-items-center vh-100">
                <div class="col-md-4 ">
                    <h4>Hello, Please Signup!</h4>
                    <form action="" method="post">
                        <div class="row">
                            
                                <select class="form-select mb-3" id="role" name="role" required>
                                    <option value="" disabled selected>User Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Tecaher 2</option>
                                </select>
                            
                            <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>
                            <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
                            <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control mb-3" required>

                            <button type="submit" class="signup_btn btn btn-primary">Signup</button>
                            <p>Already A Member? <a href="../auth/login.php">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    $success = "";
    $error = "";


    include_once '../config/db.php';



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            $error = "Passwords do not match.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        }

        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$hashed_password')";
        if (mysqli_query($conn, $sql)) {
            header("Location:../index.php");
            $success = "Signup successful! You can now login.";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }



        $success = "";
        $error = "";
        if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif;
    }


    ?>




    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Helvetica, sans-serif;
        }

        h4 {
            margin-bottom: 30px;
        }


        .left_side {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .left_side,
        img {
            width: 45%;
        }

        .right_side {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            padding: 40px;
        }

        .signup_btn {


            padding: 10px 22px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            border-radius: 10px;
            transition: 0.25s ease-in-out;
            margin-bottom: 20px;
        }

        p {
            font-size: 12px;
            color: grey;
        }

        input {
            border: 1px solid #ccc;
        }

        /*-----------------------------------*/

        .google_btn {
            background-color: #010432;
            border: none;
            color: rgb(255, 255, 255);
            padding: 10px 22px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            border-radius: 10px;
            transition: 0.25s ease-in-out;
            margin-bottom: 20px;
        }
    </style>
</body>

</html>