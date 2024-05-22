<?php include $this->resolve("partials/_header.php"); ?>

<body>
    <main>
        <div class="d-flex justify-content-center">
            <div class="d-flex justify-content-center balanceSection rounded mt-5">
                <div class="d-flex flex-column m-5 p-5 formsBackground rounded">
                    <form method="post">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Income amount:</label>
                            <input value="<?php echo escapeData($transaction['amount'] ?? ''); ?>" type="number" step="0.01" min="0" class="form-control" name="amount" id="amount" aria-describedby="amountContainer" required>
                            <div id="amountContainer" class="form-text">Enter the number to two decimal places.</div>
                            <?php if (array_key_exists('amount', $errors)) : ?>
                                <div class="mt-2 p-2 text-danger">
                                    <?php echo escapeData($errors['amount'][0]); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Income date:</label>
                            <input value="<?php echo escapeData($transaction['formatted_date'] ?? ''); ?>" type="text" class="datepicker form-control" name="date" id="date" required>
                            <?php if (array_key_exists('date', $errors)) : ?>
                                <div class="mt-2 p-2 text-danger">
                                    <?php echo escapeData($errors['date'][0]); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">

                            <label for="category" class="form-label">Income category:</label>
                            <select value="<?php echo escapeData($transaction['category'] ?? ''); ?>" class="form-select incomeCategories" aria-label="category" name="category" id="category" required>
                                <?php foreach ($incomesCategory as $category) : ?>
                                    <option value="<?php echo escapeData($category['id']); ?>" <?php echo (isset($transaction['income_category_assigned_to_user_id']) && $transaction['income_category_assigned_to_user_id'] == $category['id']) ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
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
                            <button type="submit" class="btn btn-success" id="addIncomeSubmit">Update</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include $this->resolve("partials/_footer.php"); ?>