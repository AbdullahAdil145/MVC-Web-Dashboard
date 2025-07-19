<?php require_once 'app/views/templates/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Reports Dashboard</h2>

    <!-- All Reminders -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white fw-bold">
            All Reminders
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Reminder</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allReminders as $reminder): ?>
                        <tr>
                            <td><?= $reminder['user_id']; ?></td>
                            <td><?= htmlspecialchars($reminder['username']); ?></td>
                            <td><?= htmlspecialchars($reminder['subject']); ?></td>
                            <td><?= $reminder['created_at']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- User with Most Reminders -->
    <div class="alert alert-success fw-bold text-center">
        <?= htmlspecialchars($mostRemindersUser['username']); ?> has the most reminders (<?= $mostRemindersUser['total']; ?> reminders)
    </div>

    <!-- Total Logins by User -->
    <div class="card">
        <div class="card-header bg-primary text-white fw-bold">
            Total Logins
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Username</th>
                        <th>Total Logins</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($loginCounts as $login): ?>
                        <tr>
                            <td><?= htmlspecialchars($login['username']); ?></td>
                            <td><?= $login['total_logins']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
