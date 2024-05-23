<?php include $this->resolve("partials/_header.php"); ?>

<body>
    <main>
        <section class="sectionBox">
            <div class="d-flex justify-content-center">
                <h1>Income categories:</h1>
            </div>
        </section>
        <section class="sectionBox">
            <div>
                <div class="d-flex bg-primary rounded p-2 text-white">
                    <div class="col-2">No.</div>
                    <div class="col-5">Category Name</div>
                    <div class="col-5">Actions</div>
                </div>
                <?php $i = 1; ?>
                <?php foreach ($categories as $category) : ?>
                    <div class="d-flex p-2 border-bottom">
                        <div class="col-2"><?php echo $i; ?></div>
                        <div class="col-5"><?php echo $category['name']; ?></div>
                        <div class="col-5">Actions</div>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <?php include $this->resolve("partials/_footer.php"); ?>