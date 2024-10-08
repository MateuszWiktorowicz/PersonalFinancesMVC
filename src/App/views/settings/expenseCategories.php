<?php include $this->resolve("partials/_header.php"); ?>

<body>
    <main>
        <section class="sectionBox">
            <div class="d-flex justify-content-center">
                <h1>Expense categories:</h1>
            </div>
        </section>
        <section class="sectionBox">
            <form method="POST">
                <div class="d-flex gap-3 align-items-end">
                    <div class="col-md-3">
                        <label for="category" class="form-label">Type new Expense Category:</label>
                        <input type="text" class="form-control" name="category" id="category" required>
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
                    <div class="col-md-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>

                </div>
            </form>
        </section>
        <section class="sectionBox text-center">
            <div>
                <div class="d-flex bg-primary rounded p-2 text-white">
                    <div class="col-1">No.</div>
                    <div class="col-3">Category Name</div>
                    <div class="col-2">No Of Transactions</div>
                    <div class="col-2">Spend limit / month</div>
                    <div class="col-4 text-start">Actions</div>
                </div>
                <?php $i = 1; ?>
                <?php foreach ($categories as $category) : ?>
                    <div class="d-flex p-2 border-bottom">
                        <div class="col-1"><?php echo $i; ?></div>
                        <div class="col-3"><?php echo $category['name']; ?></div>
                        <div class="col-2"><?php echo  $category['transactionNo']; ?></div>
                        <div class="col-2"><?php echo $category['spend_limit'] !== null ? $category['spend_limit'] : "Not set"; ?></div>
                        <div class=" col-4">
                            <div class="d-flex gap-3">
                                <div>
                                    <a href="/expenseCategories/<?php echo escapeData($category['id']); ?>">
                                        <i class="fa-solid fa-file-pen"></i>
                                    </a>
                                </div>
                                <div>
                                    <form action="/expenseCategories/<?php echo escapeData($category['id']) ?>" method="POST">
                                        <input type="hidden" name="_METHOD" value="DELETE" />
                                        <button type="submit" class="text-reset text-decoration-none" <?php echo $category['transactionNo'] !== 0 ? 'disabled' : ''; ?>>
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                <div>
                                    <?php echo $category['transactionNo'] !== 0 ? '<a href="/expense/' . $category['id'] . '/transactions"><i class="fa-solid fa-money-bill-transfer fs-4"></i></a>' : ''; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <?php include $this->resolve("partials/_footer.php"); ?>