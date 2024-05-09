<?php include $this->resolve("partials/_header.php"); ?>

<body>
    <main>
        <div class="balanceSection d-flex flex-column m-5 p-5 rounded">
            <form id="balancePeriodForm" method="post">
                <div class="d-flex  gap-3  mb-3 p-3" id="periodContainer">
                    <div>
                        <select class="form-select" aria-label="Default select example" id="balancePeriod">
                            <option value="currentMonth" selected>Current month</option>
                            <option value="lastMonth">Last month</option>
                            <option value="currentYear">Current Year</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>
                    <div class="mb-3 d-flex flex-column flex-sm-row gap-2 formButtons">
                        <button type="submit" class="btn btn-success" id="balance">Get Balance</button>
                    </div>
                </div>
            </form>
            <div class="d-flex flex-column flex-lg-row  align-items-center border-bottom rounded-top formsBackground">
                <div class="d-flex flex-column col-lg-4 align-items-center">
                    <div class="fw-bold">Period</div>
                    <div id="choosenBalancePeriod"></div>
                </div>
                <div class="d-flex flex-column align-items-center border-left col-lg-4">
                    <div class="d-flex justify-content-center fw-bold fs-1" id="balanceQuote">Balance: <?php echo $balance; ?></div>
                </div>
            </div>

            <div class="d-flex flex-column flex-lg-row gap-3 justify-content-between pt-5 rounded-bottom formsBackground">
                <div class="d-flex col-lg-6 flex-column mb-5 p-3">
                    <div class="d-flex justify-content-center font-weight-bold fw-bold fs-2" id="expensesTotal">Expenses: <?php echo $totalExpenses['amount']; ?></div>

                    <div class="d-flex justify-content-between my-4">
                        <div>Amount</div>
                        <div>Date</div>
                        <div>Category</div>
                        <div>Comment</div>
                    </div>
                    <?php foreach ($expenses as $expense) : ?>
                        <div class="d-flex justify-content-between">
                            <div><?php echo $expense['amount']; ?></div>
                            <div><?php echo $expense['date']; ?></div>
                            <div><?php echo $expense['name']; ?></div>
                            <div><?php echo $expense['comment']; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="d-flex col-lg-6 flex-column mb-5 p-3">
                    <div class="d-flex justify-content-center fw-bold fs-2" id="incomesTotal">Incomes: <?php echo $totalIncomes['amount']; ?></div>
                </div>
                <div class="d-flex justify-content-between my-4">
                    <div>Amount</div>
                    <div>Date</div>
                    <div>Category</div>
                    <div>Comment</div>
                </div>
                <?php foreach ($incomes as $income) : ?>
                    <div class="d-flex justify-content-between">
                        <div><?php echo $income['amount']; ?></div>
                        <div><?php echo $income['date']; ?></div>
                        <div><?php echo $income['name']; ?></div>
                        <div><?php echo $income['comment']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="d-flex flex-column gap-3 align-items-center flex-lg-row justify-content-center mb-3 p-3" id="charts">


        </div>
        </div>
    </main>
    <?php include $this->resolve("partials/_footer.php"); ?>