<?php include $this->resolve('partials/_header.php'); ?>

<body>
    <main>
        <div class="d-flex flex-column justify-content-center rounded mx-5 p-5 mt-5">
            <div class="text-center fs-5">
                <h1> Welcome to Your Financial Management App</h1>
            </div>
            <div class="text-center fs-5 mt-5">
                <h2>Your total balance: </h2>
            </div>

        </div>
        <div class="d-flex flex-column justify-content-center rounded mx-5 p-5 mt-5">
            <table class="table">
                <thead class="">
                    <tr>
                        <th scope="col">
                            Amount
                        </th>
                        <th scope="col">
                            Category
                        </th>
                        <th scope="col">
                            Payment method
                        </th>
                        <th scope="col">
                            Date
                        </th>
                        <th scope="col">
                            Comment
                        </th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction) : ?>
                        <tr class="<?php echo ($transaction['type'] === "Expense" ? 'table-danger' : 'table-success'); ?>">
                            <td><?php echo ($transaction['type'] === "Expense" ? '-' : '') . $transaction['amount'] . " PLN"; ?></td>
                            <td><?php echo $transaction['category']; ?></td>
                            <td><?php echo $transaction['paymentMethod']; ?></td>
                            <td><?php echo $transaction['date']; ?></td>
                            <td><?php echo $transaction['comment']; ?></td>
                            <td>Actions</td>
                        <tr>
                        <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </main>

    <?php include $this->resolve('partials/_footer.php'); ?>