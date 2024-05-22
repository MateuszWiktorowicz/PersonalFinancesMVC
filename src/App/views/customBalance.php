<?php include $this->resolve("partials/_header.php"); ?>

<body>
    <main>
        <div class="d-flex justify-content-center mt-5">
            <div class="formsBackground p-5">
                <form method="GET">
                    <div class="mb-3">
                        <label for="date" class="form-label">Start date:</label>
                        <input type="text" class="datepicker form-control" name="startDate" id="startDate" required>
                        <?php if (array_key_exists('startDate', $errors)) : ?>
                            <div class="mt-2 p-2 text-danger">
                                <?php echo escapeData($errors['startDate'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">End date:</label>
                        <input type="text" class="datepicker form-control" name="endDate" id="endDate" required>
                        <?php if (array_key_exists('endtDate', $errors)) : ?>
                            <div class="mt-2 p-2 text-danger">
                                <?php echo escapeData($errors['endDate'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success" id="customBalance">Show Balance</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include $this->resolve("partials/_footer.php"); ?>