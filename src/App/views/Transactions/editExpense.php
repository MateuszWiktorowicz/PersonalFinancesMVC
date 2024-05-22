<?php include $this->resolve("partials/_header.php"); ?>

<body>
    <main>
        <div class="d-flex justify-content-center">
            <div class="d-flex justify-content-center balanceSection rounded mt-5">
                <div class="d-flex flex-column m-5 p-5 formsBackground rounded">
                    <form method="post">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Expense amount:</label>
                            <input value="<?php echo escapeData($transaction['amount'] ?? ''); ?>" type="number" step="0.01" min="0" class="form-control" name="amount" id="amount" aria-describedby="amountText" required>
                            <div id="amountText" class="form-text">Enter the number to two decimal places.</div>
                            <?php if (array_key_exists('amount', $errors)) : ?>
                                <div class="mt-2 p-2 text-danger">
                                    <?php echo escapeData($errors['amount'][0]); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="paymentMethod" class="form-label">Payment method</label>
                            <div class="paymentMethod" id="paymentMethod">
                                <?php foreach ($paymenthMethods as $method) : ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="<?php echo $method['name']; ?>" value="<?php echo $method['id']; ?>" <?php echo (isset($transaction['payment_method_assigned_to_user_id']) && $transaction['payment_method_assigned_to_user_id'] === $method['id']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="<?php echo $method['name']; ?>">
                                            <?php echo $method['name']; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                                <?php if (array_key_exists('paymentMethod', $errors)) : ?>
                                    <div class="mt-2 p-2 text-danger">
                                        <?php echo escapeData($errors['paymentMethod'][0]); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Expense date:</label>
                            <input value="<?php echo escapeData($transaction['formatted_date'] ?? ''); ?>" type="text" class="datepicker form-control" name="date" id="date" required>
                            <?php if (array_key_exists('date', $errors)) : ?>
                                <div class="mt-2 p-2 text-danger">
                                    <?php echo escapeData($errors['date'][0]); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Expense category:</label>
                            <select class="form-select expenseCategories" aria-label="category" name="category" id="category" required>
                                <option value="" disabled selected hidden>Select an expense category</option>
                                <?php foreach ($expensesCategory as $category) : ?>
                                    <option value="<?php echo escapeData($category['id']); ?>" <?php echo (isset($transaction['expense_category_assigned_to_user_id']) && $transaction['expense_category_assigned_to_user_id'] == $category['id']) ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
                                <?php endforeach; ?>
                                <?php if (array_key_exists('category', $errors)) : ?>
                                    <div class="mt-2 p-2 text-danger">
                                        <?php echo escapeData($errors['category'][0]); ?>
                                    </div>
                                <?php endif; ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Comment:</label>
                            <textarea class="form-control" name="description" id="description" rows="3"><?php echo escapeData($transaction['comment'] ?? ''); ?></textarea>
                            <?php if (array_key_exists('description', $errors)) : ?>
                                <div class="mt-2 p-2 text-danger">
                                    <?php echo escapeData($errors['description'][0]); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 d-flex flex-column flex-sm-row gap-2 formButtons">
                            <button type="submit" class="btn btn-success" id="addExpenseSubmit">Update</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include $this->resolve("partials/_footer.php"); ?>