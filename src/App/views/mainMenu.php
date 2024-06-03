<?php include $this->resolve('partials/_header.php'); ?>

<body>
    <main>
        <section class="sectionBox">
            <div class="d-flex flex-column justify-content-center rounded pt-3">
                <div class="text-center fs-5">
                    <h1> Welcome to Your Financial Management App</h1>
                </div>
                <div class="text-center fs-5 mt-5">
                    <h2>Your total balance: <span><?php echo $balance . " PLN"; ?></span></h2>
                </div>
            </div>
        </section>
        <section class="sectionBox">
            <div class="d-flex flex-column justify-content-center p-4">
                <div class="d-flex flex-row-reverse justify-content-between gap-3 align-items-center mb-5">
                    <div class="d-flex align-items-center">
                        <form id="balancePeriodForm" method="get" action="./balance">
                            <div class="d-flex gap-3" id="periodContainer">
                                <div>
                                    <select name='period' class="form-select" aria-label="Default select example" id="balancePeriod" required>
                                        <option value="" disabled selected hidden>Select period</option>
                                        <option value="currentMonth">Current month</option>
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
                        <div>
                            <a href="/income"><i class="fa-solid fa-circle-plus text-success fs-3"></i></a>
                        </div>


                        <div><a href="/expense"><i class="fa-solid fa-circle-minus text-danger fs-3"></i></a></div>
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
                        <th scope="col" class="element-to-disable">
                            Payment method
                        </th>
                        <th scope="col">
                            Date
                        </th>
                        <th scope="col" class="element-to-disable">
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
                            <td class="element-to-disable"><?php echo $transaction['paymentMethod']; ?></td>
                            <td><?php echo $transaction['date']; ?></td>
                            <td class="element-to-disable"><?php echo $transaction['comment']; ?></td>
                            <td>
                                <div class="d-flex gap-3">
                                    <div>
                                        <a href="/transaction/<?php echo escapeData($transaction['type']) . '/' . escapeData($transaction['id']); ?>">
                                            <i class="fa-solid fa-file-pen"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="/transaction/<?php echo escapeData($transaction['type']) . '/' . escapeData($transaction['id']) ?>" method="POST">
                                            <input type="hidden" name="_METHOD" value="DELETE" />
                                            <button type="submit" class="text-reset text-decoration-none">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        <tr>
                        <?php endforeach; ?>
                </tbody>

            </table>
            </div>
        </section>
    </main>

    <?php include $this->resolve('partials/_footer.php'); ?>