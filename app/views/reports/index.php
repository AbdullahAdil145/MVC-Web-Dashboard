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

<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="row mt-5">
    <div class="col-md-12">
        <h4 class="text-center">Total Logins by User</h4>
        <canvas id="loginsChart"></canvas>
    </div>
</div>

<script>
    const loginLabels = <?= json_encode(array_column($loginCounts, 'username')); ?>;
    const loginCounts = <?= json_encode(array_column($loginCounts, 'total_logins')); ?>;

    const ctxLogins = document.getElementById('loginsChart').getContext('2d');
    new Chart(ctxLogins, {
        type: 'bar',
        data: {
            labels: loginLabels,
            datasets: [{
                label: 'Total Logins',
                data: loginCounts,
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>


<?php require_once 'app/views/templates/footer.php'; ?>