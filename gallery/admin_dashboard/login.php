<?php 
require("halaman/database/functionAdmin.php");
if(isset($_SESSION['admin_id'])){
    header('Location: halaman/database/admin-datalist.php');
    exit();
}

user_data();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Login Admin</title>
    <style>
        body {
            background-color: #76b852;
        }

        .card {
            border-radius: 0px;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
        
    </style>
</head>

<body class="d-flex justify-content-center align-items-center" style="height: 100vh;"s>
    <div class="container   ">
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-6">
                <div class="card p-3">
                    <div class="card-body">
                        <h2 class="text-center mb-3">Admin login</h2>
                        <form class="login-form" method="post">
                            <input type="text" class="form-control mb-3 bg-dark-subtle" placeholder="Username" name="username">
                            <input type="password" class="form-control mb-3 bg-dark-subtle" placeholder="Password" name="password">
                            <button type="submit" class="btn btn-success btn-block w-100 mt-3">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>