<body class="d-flex flex-column">
    <nav class="navbar bg-body-tertiary">
        <div class="container-sm d-flex justify-content-between align-items-center">
            <div class="col-3">
                <a class="navbar-brand" href="./index.php">
                    <img src="./images/piggyBank.png" alt="piggy-bank-image" width="50" height="50">
                    PersonalFinances
                </a>
            </div>
            <div class="d-flex justify-content-between align-items-center text-center gap-2 p-3 col-3">
                <div class="menuOptions col-6" data-bs-toggle="modal" data-bs-target="#loginLabel">Sign In</div>
                <div class="menuOptions col-6" data-bs-toggle="modal" data-bs-target="#registerLabel">Sign Up</div>
            </div>
        </div>
    </nav>
    <main>
        <div class="d-flex flex-column align-items-center mt-5 mx-5 p-4 balanceSection rounded">
            <div class="d-flex text-center col-12 col-md-6 flex-column gap-3 fw-bold formsBackground rounded mt-5 p-3 mx-2">
                <div class="fs-4">Why you should start using our app?</div>
                <div>1. Increased Financial Awareness</div>
                <div>2. Real-Time Monitoring and Visibility</div>
                <div>3. Goal Setting and Planning</div>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center m-5 gap-5">
                <div class="d-flex col-12 col-md-6 flex-column align-items-center justify-content-between gap-3 formsBackground rounded p-3 buttonContainer">
                    <div>Have You account already?</div>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginLabel">Sign In</button>
                </div>
                <div class="d-flex col-12 col-md-6 flex-column align-items-center justify-content-between gap-3 formsBackground rounded p-3 buttonContainer">
                    <div>Don't you have account yet? Don't worry!</div>
                    <button class="btn btn-info text-light" data-bs-toggle="modal" data-bs-target="#registerLabel">Sign Up</button>
                </div>
            </div>

        </div>

        <div class="modal fade" id="registerLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="signUpForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="signUpForm">Sign Up Form</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="registerForm" action="register.php" method="post">
                            <div class="mb-3">
                                <label for="registerInputName" class="form-label">Name</label>
                                <input type="text" class="form-control" name="registerInputName" id="registerInputName" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerInputEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control registerEmail" name="registerInputEmail" id="registerInputEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerInputPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" name="registerInputPassword" id="registerInputPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmRegisterInputPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control confirmPassword" name="confirmRegisterInputPassword" id="confirmRegisterInputPassword" required>
                            </div>
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="registerSubmit">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="loginLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="signInForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="signInForm">Sign In Form</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

    </main>
</body>