<?php include $this->resolve("partials/_header.php") ?>

<body>
    <div class="mt-5 d-flex justify-content-center">
        <form id="loginForm">
            <div class="mb-3">
                <label for="loginInputEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="loginInputEmail" required>
            </div>
            <div class="mb-3">
                <label for="loginInputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginInputPassword" required>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="loginSubmit">Submit</button>
        </form>
    </div>
</body>
<?php include $this->resolve("partials/_footer.php") ?>