<?php include $this->resolve("partials/_header.php"); ?>

<body>
    <main>
        <div class="text-center fs-5 my-5">
            <h1>Your total balance: <span><?php echo $balance . " PLN"; ?></span></h1>
        </div>
        <div>
            <div class="text-center mt-5 pb-3">
                <h2>Your incomes: <span><?php echo $totalIncomes['amount'] . " PLN"; ?></span></h2>
            </div>
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
                        <?php if ($transaction['type'] === "Income") : ?>
                            <tr class="table-success">
                                <td><?php echo $transaction['amount'] . " PLN"; ?></td>
                                <td><?php echo $transaction['category']; ?></td>
                                <td><?php echo $transaction['paymentMethod']; ?></td>
                                <td><?php echo $transaction['date']; ?></td>
                                <td><?php echo $transaction['comment']; ?></td>
                                <td>Actions</td>
                            <tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                </tbody>

            </table>
            <div class="my-5">
                <h3>Earning Categories</h3>
            </div>
            <div class="d-flex gap-5">
                <?php foreach ($incomesCategoryBalance as $categoryBalance) : ?>
                    <div class="d-flex col-2 categoryBox p-2 rounded">
                        <div class="col-8 p-1">
                            <div><?php echo $categoryBalance['value'] . " PLN"; ?></div>
                            <div><?php echo $categoryBalance['name']; ?></div>
                        </div>
                        <div class="col-4 p-1 d-flex flex-row-reverse">
                            <div><?php echo round(($categoryBalance['value'] / $totalIncomes['amount']) * 100, 0) . "%"; ?></div>
                        </div>

                    </div>
                <?php endforeach; ?>

            </div>

        </div>
        <div>
            <div class="text-center mt-5 pb-3">
                <h2>Your expenses: <span><?php echo $totalExpenses['amount'] . " PLN"; ?></span></h2>
            </div>
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
                        <?php if ($transaction['type'] === "Expense") : ?>
                            <tr class="table-danger">
                                <td><?php echo "-" . $transaction['amount'] . " PLN"; ?></td>
                                <td><?php echo $transaction['category']; ?></td>
                                <td><?php echo $transaction['paymentMethod']; ?></td>
                                <td><?php echo $transaction['date']; ?></td>
                                <td><?php echo $transaction['comment']; ?></td>
                                <td>Actions</td>
                            <tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                </tbody>
            </table>
            <div class="my-5">
                <h3>Spending Categories</h3>
            </div>
            <div class="d-flex gap-5">
                <?php foreach ($expensesCategoryBalance as $categoryBalance) : ?>
                    <div class="d-flex col-2 categoryBox p-2 rounded">
                        <div class="col-8 p-1">
                            <div><?php echo $categoryBalance['value'] . " PLN"; ?></div>
                            <div><?php echo $categoryBalance['name']; ?></div>
                        </div>
                        <div class="col-4 p-1 d-flex flex-row-reverse">
                            <div><?php echo round(($categoryBalance['value'] / $totalExpenses['amount']) * 100, 0) . "%"; ?></div>
                        </div>

                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </main>
    <?php include $this->resolve("partials/_footer.php"); ?>