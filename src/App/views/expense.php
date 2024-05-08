<?php include $this->resolve("partials/_header.php"); ?>

<body>
    <main>
        <div class="d-flex justify-content-center">
            <div class="d-flex justify-content-center balanceSection rounded mt-5">
                <div class="d-flex flex-column m-5 p-5 formsBackground rounded">
                    <form id="addExpenseForm" action="expense.php" method="post">
                        <div class="mb-3">
                            <label for="expenseAmountInput" class="form-label">Expense amount:</label>
                            <input type="number" step="0.01" min="0" class="form-control" name="expenseAmountInput" id="expenseAmountInput" aria-describedby="expenseAmountInputText" required>
                            <div id="expenseAmountInputText" class="form-text">Enter the number to two decimal places.</div>
                        </div>
                        <div class="mb-3">
                            <label for="expensePaymentMethod" class="form-label">Payment method</label>
                            <div class="expensePaymentMethods" id="expensePaymentMethod">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="expenseDate" class="form-label">Expense date:</label>
                            <input type="text" class="datepicker form-control" name="expenseDate" id="expenseDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="expenseCategory" class="form-label">Expense category:</label>
                            <select class="form-select expenseCategories" aria-label="Expense Category:" name="expenseCategory" id="expenseCategory" required>
                                <option value="" disabled selected hidden>Select an expense category</option>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="expenseTextArea" class="form-label">Comment:</label>
                            <textarea class="form-control" name="expenseTextArea" id="expenseTextArea" rows="3"></textarea>
                        </div>
                        <div class="mb-3 d-flex flex-column flex-sm-row gap-2 formButtons">
                            <button type="submit" class="btn btn-success" id="addExpenseSubmit">Add Expense</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include $this->resolve("partials/_footer.php"); ?>