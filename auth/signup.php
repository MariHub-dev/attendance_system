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
                    <h4>Hello, Please Signup!</h4>
                    <form action="" method="post">

                        <select class="form-select mb-3" id="role" name="role" required>
                            <option value="" disabled selected>User Role</option>
                            <option value="1">Admin</option>
                            <option value="2">Tecaher</option>

                        </select>
                        <input type="text" name="username" placeholder="Username" class="form-control mb-3" required>
                        <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>
                        <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control mb-3" required>

                        <button type="submit" class="signup_btn btn btn-primary">Signup</button>
                        <p>Already A Member? <a href="../auth/login.php">Login</a></p>
                    </form>

                </div>
            </div>
        </div>

        <?php

        $success = "";
        $error = "";


        include_once '../config/db.php';



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);   
            $email = trim($_POST['email']);
            $password = trim($_POST['password']); 
            $role =  trim($_POST['role']);
            $confirm_password = trim($_POST['confirm_password']);

            if ($password !== $confirm_password) {
                $error = "Passwords do not match.";
            } else {
                
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            }

            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $username, $email, $hashed_password, $role);
            if ($stmt->execute()) {
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