<?php require_once 'app/views/templates/headerPublic.php' ?>

<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">You are not logged in</h1>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php
            if (isset($_SESSION['loginError'])) {
                echo "<p style='color:red; font-weight:bold; text-align:center;'>" . $_SESSION['loginError'] . "</p>";
                unset($_SESSION['loginError']);
            }
            if (isset($_SESSION['registerSuccess'])) {
                echo "<p style='color:green; font-weight:bold; text-align:center;'>" . $_SESSION['registerSuccess'] . "</p>";
                unset($_SESSION['registerSuccess']);
            }
            ?>

            <div class="p-4 rounded bg-white shadow-sm">
                <form action="/login/verify" method="post">
                    <fieldset>
                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input required type="text" class="form-control" name="username">
                        </div>

                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input required type="password" class="form-control" name="password" id="passwordField">
                                <button type="button"
                                        onclick="togglePassword()"
                                        class="btn btn-outline-secondary">
                                    Show
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a href="/create" class="btn btn-secondary">Register</a>
                        </div>
                    </fieldset>
                </form>
            </div>

            <script>
                function togglePassword() {
                    const passwordInput = document.getElementById('passwordField');
                    const toggleBtn = event.target;

                    if (passwordInput.type === "password") {
                        passwordInput.type = "text";
                        toggleBtn.innerText = "Hide";
                    } else {
                        passwordInput.type = "password";
                        toggleBtn.innerText = "Show";
                    }
                }
            </script>

            <?php include 'app/views/templates/footer.php'; ?>

        </div>
    </div>
</main>
