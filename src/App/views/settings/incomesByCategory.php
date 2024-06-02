<?php include $this->resolve("partials/_header.php"); ?>

<body>
    <section class="sectionBox">
        <div class="d-flex justify-content-center">
            <h1>Incomes assigned to category:</h1>
        </div>
    </section>
    <section class="sectionBox">
        <main class="mx-3">
            <table class="table">
                <thead class="">
                    <tr>
                        <th scope="col">
                            Amount
                        </th>
                        <th scope="col">
                            Category
                        </th>
                        <th scope="col">
                            Payment method
                        </th>
                        <th scope="col">
                            Date
                        </th>
                        <th scope="col">
                            Comment
                        </th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction) : ?>
                        <?php if ($transaction['type'] === "Income") : ?>
                            <tr class="table-success">
                                <td><?php echo $transaction['amount'] . " PLN"; ?></td>
                                <td><?php echo $transaction['category']; ?></td>
                                <td><?php echo $transaction['paymentMethod']; ?></td>
                                <td><?php echo $transaction['date']; ?></td>
                                <td><?php echo $transaction['comment']; ?></td>
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
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>

            </table>
    </section>
    </main>
    <?php include $this->resolve("partials/_footer.php"); ?>