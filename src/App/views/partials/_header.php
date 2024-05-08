<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PersonalFinances</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="./styles.css" rel="stylesheet">

</head>
<nav class="navbar bg-body-tertiary">
    <div class="container-sm d-flex justify-content-between align-items-center">
        <div class="col-3">
            <a class="navbar-brand" href="/">
                <img src="./images/piggyBank.png" alt="piggy-bank-image" width="50" height="50">
                PersonalFinances
            </a>
        </div>
        <div class="d-flex justify-content-between align-items-center text-center gap-2 p-3 col-3">
            <?php if (!isset($_SESSION['user'])) : ?>
                <div class="menuOptions col-6"><a href="/login">Sign In</a></div>
                <div class="menuOptions col-6"><a href="/register">Sign Up</a></div>
            <?php else : ?>
                <div><a class="text-reset text-decoration-none menuOptions" href="./addIncome.php">Add Income</a></div>
                <div><a class="text-reset text-decoration-none menuOptions" href="./addExpense.php">Add Expense</a></div>
                <div><a class="text-reset text-decoration-none menuOptions" href="./balance.php">Balance</a></div>
                <div><a class="text-reset text-decoration-none menuOptions" href="./settings.php">Settings</a></div>
                <div><a class="text-reset text-decoration-none menuOptions" href="./logout.php">Logout</a></div>
            <?php endif; ?>
        </div>
    </div>
</nav>