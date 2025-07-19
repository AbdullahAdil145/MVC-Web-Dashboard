    <?php
    if (!isset($_SESSION['auth'])) {
        header('Location: /login');
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="icon" href="/favicon.png">
        <title>COSC 4806</title>
        <link rel="stylesheet" href="/public/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>

    <div class="page-title">
        COSC 4806 - Assignment 5 - Muhammad Abdullah Adil
    </div>

    <nav>
        <div class="nav-container" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="nav-left" style="display: flex; align-items: center; gap: 10px;">
                <a class="nav-brand" href="/">Dashboard</a>

                <?php
                    $uri = trim($_SERVER['REQUEST_URI'], '/');
                    $segments = explode('/', $uri);

                    if ($uri !== '' && $uri !== 'home') {
                        echo '<nav aria-label="breadcrumb" style="display: inline-block; margin-left: 5px;">';
                        echo '<ol class="breadcrumb mb-0" style="background: transparent; font-size: 0.85rem; color: grey;">';
                        echo '<li class="breadcrumb-item"><a href="/home" style="color: grey; text-decoration: none;">Home</a></li>';

                        if (!empty($segments[0])) {
                            echo '<li class="breadcrumb-item active text-muted" aria-current="page" style="color: grey;">' . ucfirst(htmlspecialchars($segments[0])) . '</li>';
                        }

                        echo '</ol>';
                        echo '</nav>';
                    }
                ?>
            </div>

            <div class="nav-right" style="display: flex; align-items: center; gap: 20px;">
                <a href="/home">Home</a>
                <a href="/about">About Me</a>
                <a href="/reminders">
                    Reminders 
                    <span class="badge bg-secondary">
                        <?= isset($_SESSION['reminder_count']) ? $_SESSION['reminder_count'] : '0'; ?>
                    </span>
                </a>
                <a href="/blog">Blog</a>
                <a href="/reports">Reports</a>
                <a href="/logout">Logout</a>

                <label class="switch" style="margin-bottom: 0;">
                    <input type="checkbox" id="themeToggle">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </nav>

    <script>
    const toggle = document.getElementById('themeToggle');

    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
        toggle.checked = true;
    }

    toggle.addEventListener('change', function () {
        if (this.checked) {
            document.body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    });
    </script>
