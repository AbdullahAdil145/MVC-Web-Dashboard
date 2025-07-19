<?php require_once 'app/views/templates/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center fw-bold">Reports Dashboard</h2>

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

    <div class="alert alert-success fw-bold text-center">
        <?= htmlspecialchars($mostRemindersUser['username']); ?> has the most reminders (<?= $mostRemindersUser['total']; ?> reminders)
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white fw-bold">
            Total Logins by User
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

    <div class="card mb-5">
        <div class="card-header bg-primary text-white fw-bold">
            Total Logins (Chart)
        </div>
        <div class="card-body">
            <canvas id="loginsChart" style="max-height: 400px;"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                backgroundColor: 'rgba(13, 110, 253, 0.7)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        color: '#ffffff'
                    },
                    grid: {
                        color: '#ffffff'
                    }
                },
                x: {
                    ticks: {
                        color: '#ffffff'
                    },
                    grid: {
                        color: '#ffffff'
                    }
                }
            }
        }
    });
</script>


<?php require_once 'app/views/templates/footer.php'; ?>
