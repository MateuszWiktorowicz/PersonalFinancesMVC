<?php include $this->resolve('partials/_header.php'); ?>

<body>
    <main>
        <div class="d-flex flex-column justify-content-center rounded mx-5 p-5 mt-5">
            <div class="text-center fs-5">
                <h1> Welcome to Your Financial Management App</h1>
            </div>
            <div class="text-center fs-5 mt-5">
                <h2>Your total balance: <span><?php echo $balance . " PLN"; ?></span></h2>
            </div>

        </div>
        <div class="d-flex flex-column justify-content-center rounded mx-5 p-5 mt-5">
            <div class="d-flex flex-row-reverse justify-content-between gap-3 align-items-center mb-5">
                <div class="d-flex align-items-center">
                    <form id="balancePeriodForm" method="post">
                        <div class="d-flex gap-3" id="periodContainer">
                            <div>
                                <select name='period' class="form-select" aria-label="Default select example" id="balancePeriod">
                                    <option value="currentMonth" selected>Current month</option>
                                    <option value="lastMonth">Last month</option>
                                    <option value="currentYear">Current Year</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>

                            <div class="d-flex flex-column flex-sm-row gap-2 formButtons">
                                <button type="submit" class="btn btn-success" id="balance">Get Balance</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="d-flex gap-3">
                    <div class="circle bg-success">
                        <div><a class="circle-content" href="/income">&#43;</a></div>
                    </div>
                    <div class="circle bg-danger">
                        <div><a class="circle-content" href="/expense">&#9866;</a></div>
                    </div>

                </div>
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