<?php include $this->resolve("partials/_header.php") ?>

<body>
    <div class="mt-5 d-flex justify-content-center">
        <form method='POST' id="loginForm">
            <div class="mb-3">
                <label for="loginInputEmail" class="form-label">Email address</label>
                <input value="<?php echo escapeData($oldFormData['email'] ?? ''); ?>" name='email' type="email" class="form-control" id="loginInputEmail" required>
                <?php if (array_key_exists('email', $errors)) : ?>
                    <div class="mt-2 p-2 text-danger">
                        <?php echo escapeData($errors['email'][0]); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="loginInputPassword" class="form-label">Password</label>
                <input name='password' type="password" class="form-control" id="loginInputPassword" required>
                <?php if (array_key_exists('password', $errors)) : ?>
                    <div class="mt-2 p-2 text-danger">
                        <?php echo escapeData($errors['password'][0]); ?>
                    </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary" id="loginSubmit">Submit</button>
        </form>
    </div>
    <?php include $this->resolve("partials/_footer.php") ?>