<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PersonalFinances</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="/assets/js/dataPicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">

</head>
<nav class="navbar bg-body-tertiary">
    <div class="container-sm d-flex justify-content-between align-items-center">
        <div class="col-3">
            <a class="navbar-brand" href="/">
                <img src="/assets/images/piggyBank.png" alt="piggy-bank-image" width="50" height="50">
                PersonalFinances
            </a>
        </div>
        <div class="d-flex align-items-center text-center justify-content-end gap-3 p-3 col-3">
            <?php if (!isset($_SESSION['user'])) : ?>
                <div><a class="text-reset text-decoration-none col-6" href="/login">Sign In</a></div>
                <div><a class="text-reset text-decoration-none col-6" href="/register">Sign Up</a></div>
            <?php else : ?>
                <div><a class="text-reset text-decoration-none fs-4" href="/settings">&#9881;</a></div>
                <div><a class="text-reset text-decoration-none fs-4" href="/logout">&#10150;</a></div>
            <?php endif; ?>
        </div>
    </div>
</nav>