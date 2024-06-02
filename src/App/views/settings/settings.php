<?php include $this->resolve("partials/_header.php"); ?>

<body>
    <main>
        <section class="sectionBox">
            <div class="d-flex justify-content-center">
                <h1>Settings</h1>
            </div>
        </section>
        <section class="sectionBox">
            <div class="d-flex flex-column align-items-center gap-4">
                <div class="border-bottom border-black w-100 text-center">
                    <h2><a class="text-reset text-decoration-none" href="/updateUser">Edit profile</a></h2>
                </div>
                <div class="border-bottom border-black w-100 text-center">
                    <h2><a class="text-reset text-decoration-none" href="/incomeCategories">Edit income categories</a></h2>
                </div>
                <div class="border-bottom border-black w-100 text-center">
                    <h2><a class="text-reset text-decoration-none" href="/expenseCategories">Edit expense categories</a></h2>
                </div>
                <div class="border-bottom border-black w-100 text-center">
                    <h2>Edit payment methods</h2>
                </div>

            </div>

        </section>
    </main>
    <?php include $this->resolve("partials/_footer.php"); ?>