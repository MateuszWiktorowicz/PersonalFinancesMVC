<?php include $this->resolve("partials/_header.php"); ?>

<body>
    <main>
        <div class="d-flex justify-content-center">
            <div class="d-flex justify-content-center balanceSection rounded mt-5">
                <div class="d-flex flex-column m-5 p-5 formsBackground rounded">
                    <form id="addIncomeForm" action="income.php" method="post">
                        <div class="mb-3">
                            <label for="incomeAmountInput" class="form-label">Income amount:</label>
                            <input type="number" step="0.01" min="0" class="form-control" name="incomeAmountInput" id="incomeAmountInput" aria-describedby="incomeAmountInputContainer" required>
                            <div id="incomeAmountInputContainer" class="form-text">Enter the number to two decimal places.</div>
                        </div>
                        <div class="mb-3">
                            <label for="incomeDate" class="form-label">Income date:</label>
                            <input type="text" class="datepicker form-control" name="incomeDate" id="incomeDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="incomeCategory" class="form-label">Income category:</label>
                            <select class="form-select incomeCategories" aria-label="Income Category:" name="incomeCategory" id="incomeCategory" required>
                                <option value="" disabled selected hidden>Select an income category</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="incomeTextArea" class="form-label">Comment:</label>
                            <textarea class="form-control" name="incomeTextArea" id="incomeTextArea" rows="3"></textarea>
                        </div>
                        <div class="mb-3 d-flex flex-column flex-sm-row gap-2 formButtons">
                            <button type="submit" class="btn btn-success" id="addIncomeSubmit">Add Income</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include $this->resolve("partials/_footer.php"); ?>