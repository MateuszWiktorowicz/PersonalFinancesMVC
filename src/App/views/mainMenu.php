<?php include $this->resolve('partials/_header.php'); ?>

<body>
    <main>
        <div class="d-flex justify-content-center formsBackground rounded mx-5 p-5 mt-5">
            <div class="text-center fs-5">
                <h1> Welcome to Your Financial Management App, <span class="text-success" id="welcomeNameBox"></span></h1>
                <p>
                    We're here to help you take control of your finances. Below are some key options to get you started:
                </p>

                <h2>Add Income:</h2>
                <p>
                    Record your sources of income to keep track of your earnings.
                </p>

                <h2>Add Expense:</h2>
                <p>
                    Log your expenses to maintain a detailed record of your spending habits.
                </p>

                <h3>View Balance:</h3>
                <p>
                    Check your overall financial balance to stay informed about your financial health.
                </p>

                <h2>Change Settings:</h2>
                <p>
                    Adjust your account settings according to your preferences.
                </p>

                <h2>Logout:</h2>
                <p>
                    Logout of your account to ensure the security of your information.
                </p>
            </div>

        </div>
    </main>

    <?php include $this->resolve('partials/_footer.php'); ?>