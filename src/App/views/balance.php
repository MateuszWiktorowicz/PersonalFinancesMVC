<?php include $this->resolve("partials/_header.php"); ?>

<body>
    <main>
        <div class="balanceSection d-flex flex-column m-5 p-5 rounded">
            <form id="balancePeriodForm" action="balanceFunctions.php" method="post">
                <div class="d-flex flex-row-reverse gap-3 justify-content-between mb-3 p-3" id="periodContainer">
                    <div>
                        <label for="balancePeriod" class="form-label">Choose period:</label>
                        <select class="form-select" aria-label="Default select example" id="balancePeriod">
                            <option value="current month" selected>Current month</option>
                            <option value="last month">Last month</option>
                            <option value="current year">Current Year</option>
                            <option value="Custom">Custom</option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="d-flex flex-column flex-lg-row  align-items-center border-bottom rounded-top formsBackground">
                <div class="d-flex flex-column col-lg-4 align-items-center">
                    <div class="fw-bold">Period</div>
                    <div id="choosenBalancePeriod"></div>
                </div>
                <div class="d-flex flex-column align-items-center border-left col-lg-4">
                    <div class="d-flex justify-content-center fw-bold fs-1" id="balanceQuote">Balance</div>
                </div>
            </div>

            <div class="d-flex flex-column flex-lg-row gap-3 justify-content-between pt-5 rounded-bottom formsBackground">
                <div class="d-flex col-lg-6 flex-column mb-5 p-3">
                    <div class="d-flex justify-content-center font-weight-bold fw-bold fs-2" id="expensesTotal">Expenses:</div>
                    <div class="pb-5" id="expensesList"></div>
                </div>
                <div class="d-flex col-lg-6 flex-column mb-5 p-3">
                    <div class="d-flex justify-content-center fw-bold fs-2" id="incomesTotal">Incomes:</div>
                    <div class="pb-5" id="incomesList"></div>
                </div>
            </div>
            <div class="d-flex flex-column gap-3 align-items-center flex-lg-row justify-content-center mb-3 p-3" id="charts">


            </div>
        </div>
    </main>
    <?php include $this->resolve("partials/_footer.php"); ?>