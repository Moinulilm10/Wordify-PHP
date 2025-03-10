<?php

include_once '../classes/Register.php';
$rs = new Register();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addUser = $rs->addUser($_POST);
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Sign Up</title>
</head>

<body>
    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <span>
                    <?php
                    if (isset($addUser)) {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?php $addUser; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    }
                    ?>
                </span>
                <div class="card">
                    <h5 class="card-header">
                        Sign Up
                    </h5>
                    <div class="card-body">
                        <form action="" method="POST">

                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="name" name="username" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-success">Sign Up</button>
                            <a href="/admin/login.php" class="btn btn-primary">Login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>