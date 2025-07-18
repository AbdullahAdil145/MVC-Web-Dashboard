<?php require_once 'app/views/templates/headerPublic.php' ?>

<main role="main" class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="page-header" id="banner">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="text-center">Register</h1>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_SESSION['registerError'])) {
                echo "<p style='color:red; font-weight:bold; text-align:center;'>" . $_SESSION['registerError'] . "</p>";
                unset($_SESSION['registerError']);
            }
            ?>

            <div style="margin-bottom: 40px;">
                <form action="/create/submit" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input required type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <small class="form-text text-muted" style="margin-top: -4px; margin-bottom: 6px;">(Password must be at least 8 characters)</small>
                            <input required type="password" class="form-control" name="password" minlength="8">
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </fieldset>
                </form>
            </div>

            <p class="text-muted text-center" style="margin-top: 20px;">&copy; 2025</p>

        </div>
    </div>

</main>
