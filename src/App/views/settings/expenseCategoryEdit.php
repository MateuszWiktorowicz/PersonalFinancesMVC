<?php include $this->resolve("partials/_header.php"); ?>

<body>
    <main>
        <section class="sectionBox">
            <div class="d-flex justify-content-center">
                <h1>Expense category:</h1>
            </div>
        </section>
        <section class="sectionBox">
            <form method="POST">
                <div class="d-flex gap-3 align-items-end">
                    <div class="col-4">
                        <label for="category" class="form-label">Edit Expense Category:</label>
                        <input value="<?php echo escapeData($category[0]['name'] ?? ''); ?>" type="text" class="form-control" name="category" id="category" required>
                        <?php if (array_key_exists('category', $errors)) : ?>
                            <div class="mt-2 p-2 text-danger">
                                <?php echo escapeData($errors['category'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3 d-flex align-items-center justify-content-end">
                        <label for="limitCheckbox">Set limit: </label>
                        <input type="checkbox" class="mx-2 form-check-input" name="limitCheckbox" id="limitCheckbox" />
                    </div>
                    <div class="col-md-3">
                        <label for="limit" class="form-label">Category monthly spend limit:</label>
                        <input class="form-control" min="0" step="0.01" name="limit" id="limit" disabled />
                        <?php if (array_key_exists('limit', $errors)) : ?>
                            <div class="mt-2 p-2 text-danger">
                                <?php echo escapeData($errors['limit'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>

                </div>
            </form>
        </section>
    </main>

    <?php include $this->resolve("partials/_footer.php"); ?>