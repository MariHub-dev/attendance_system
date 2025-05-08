<?php
session_start();
?>


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
<div class="conatiner justify-content-center align-items-center gap-3 vh-100">
        <div class="row">

            <div class="col-md-12 right_side justify-content-center align-items-center vh-100">
                <div class="card p-3">
                <h4>Welcome Back!, Please Login!</h4>
                    <form action="" method="post">

                        <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>
                        <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
                        <p><a href="http://" class="text-muted text-decoration-none text-start">Forgot Password</a></p>
                        <button type="submit" class="signup_btn btn btn-primary">Login</button>
                        <button type="submit" class="google_btn ">Login with Google</button>
                        <p>Not A Member Yet? <a href="../auth/signup.php">Signup</a></p>
                    </form>
                </div>
            </div>
        </div>
</div>

   
    <?php


    include_once '../config/db.php';

    $success = "";
    $erroe = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        if (empty($email) || empty($password)) {
            $error = "Email and password are required.";
        } else {
            $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                $stmt->bind_result($id, $username, $hashed_password);
                $stmt->fetch();
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['user_id'] = $id;
                    $_SESSION['username'] = $username;
                    header("Location:../index.php");
                    exit();
                } else {
                    $error = "Incorrect password.";
                }
            } else {
                $error = "No account found with this email.";
            }
            $stmt->close();
        }

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
            background-color: rgb(2, 21, 84);
            margin: 0;
            padding: 0;
            font-family: Helvetica, sans-serif;
        }

        .card {
            border-radius: 16px;
            padding: 20px;
            width: 40%;
        }

        h4 {
            margin-bottom: 30px;
        }
        .signup_btn {
            padding: 10px 22px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            border: none;
           
            border-radius: 10px;
            transition: 0.25s ease-in-out;
            margin-bottom: 20px;
        }
        .right_side {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                text-align: center;
                padding: 40px;
            }


        p {
            font-size: 12px;
            color: grey;

        }
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