<?php require_once 'app/views/templates/header.php'; ?>

<div class="container my-5">

    <h1 class="mb-4 text-center fw-bold">Reports Dashboard</h1>

    <!-- All Reminders Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white fw-bold">
            All Reminders
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Subject</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allReminders as $reminder): ?>
                            <tr>
                                <td><?= $reminder['id']; ?></td>
                                <td><?= $reminder['user_id']; ?></td>
                                <td><?= htmlspecialchars($reminder['subject']); ?></td>
                                <td><?= $reminder['created_at']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- User with Most Reminders -->
    <div class="alert alert-success fw-bold">
        <?= $mostRemindersUser['username']; ?> has the most reminders (<?= $mostRemindersUser['total']; ?> reminders)
    </div>

    <!-- Total Logins by User -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white fw-bold">
            Total Logins by User
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Username</th>
                            <th>Total Logins</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($loginCounts as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['username']); ?></td>
                                <td><?= $user['total_logins']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php require_once 'app/views/templates/footer.php'; ?>
