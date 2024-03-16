<?php
session_start();
if (!isset($_SESSION["id"]))
{
    header("Location: login.php");
    die;
}
require_once 'connection.php';
require_once 'functions.php';
global $conn;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create bets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<section class="vh-100 bg-image"
         style="background-color: #04243D">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px; background-color: white;">
                        <div class="card-body p-5">
                            <h2 style="color: #080A0B" class="text-uppercase text-center mb-5">Create bet</h2>
                            <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                                <div class="form-outline mb-4">
                                    <textarea name="description" id="description" class="form-control form-control-lg" maxlength="100" placeholder="description" required></textarea>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="number" id="points" name="points" class="form-control form-control-lg" placeholder="points" min="<?php echo getMinPointsValue($conn); ?>" max="<?php echo getMaxPointsValue($conn); ?>" required/>
                                    <label class="form-label" for="points">Points</label>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" style="background-color: teal;" class="btn btn-primary btn-lg">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</section>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $description = $_POST['description'];
    $points = $_POST['points'];

    //var_dump($description);
    //var_dump($points);
    //var_dump($_SESSION['id']);

    if (!isset($description) || !isset($points))
    {
        exit();
    }
    if (insertBet($description,$points,$_SESSION["id"],$conn))
    {
        header('Location: bacheca.php');
    }
    $conn->close();
}
?>
</body>
</html>
