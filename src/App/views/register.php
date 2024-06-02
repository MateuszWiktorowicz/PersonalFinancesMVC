<?php include $this->resolve("partials/_header.php") ?>

<body>
    <div class="mt-5 d-flex justify-content-center">
        <div class="formsBackground p-4">
            <form id="registerForm" method="post">
                <div class="mb-3">
                    <label for="registerInputName" class="form-label">Name</label>
                    <input value="<?php echo escapeData($oldFormData['name'] ?? ''); ?>" type="text" class="form-control" name="name" id="registerInputName" required>
                    <?php if (array_key_exists('name', $errors)) : ?>
                        <div class="mt-2 p-2 text-danger">
                            <?php echo escapeData($errors['name'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input value="<?php echo escapeData($oldFormData['email'] ?? ''); ?>" type="email" class="form-control registerEmail" name="email" id="registerInputEmail" required />
                    <?php if (array_key_exists('email', $errors)) : ?>
                        <div class="mt-2 p-2 text-danger">
                            <?php echo escapeData($errors['email'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="registerInputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="registerInputPassword" required>
                    <?php if (array_key_exists('password', $errors)) : ?>
                        <div class="mt-2 p-2 text-danger">
                            <?php echo escapeData($errors['password'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="confirmRegisterInputPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control confirmPassword" name="confirmPassword" id="confirmRegisterInputPassword" required>
                    <?php if (array_key_exists('confirmPassword', $errors)) : ?>
                        <div class="mt-2 p-2 text-danger">
                            <?php echo escapeData($errors['confirmPassword'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Reset</button>
                <button type="submit" class="btn btn-primary" id="registerSubmit">Submit</button>
            </form>
        </div>
    </div>
    <?php include $this->resolve("partials/_footer.php") ?>