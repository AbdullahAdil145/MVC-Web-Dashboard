<?php require_once 'app/views/templates/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center fw-bold">Reports Dashboard</h2>

    <div class="accordion" id="reportsAccordion">

        <div class="accordion-item mb-4">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    All Reminders
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#reportsAccordion">
                <div class="accordion-body">

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

                </div>
            </div>
        </div>

        <div class="accordion-item mb-4">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    User with Most Reminders
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#reportsAccordion">
                <div class="accordion-body">
                    <div class="alert alert-success fw-bold text-center">
                        <?= htmlspecialchars($mostRemindersUser['username']); ?> has the most reminders (<?= $mostRemindersUser['total']; ?> reminders)
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item mb-4">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Total Logins by User
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#reportsAccordion">
                <div class="accordion-body">

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

                </div>
            </div>
        </div>

        <div class="accordion-item mb-5">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Total Logins (Chart)
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#reportsAccordion">
                <div class="accordion-body">

                    <div class="card mb-5">
                        <div class="card-header bg-primary text-white fw-bold">
                            Total Logins (Chart)
                        </div>
                        <div class="card-body">
                            <canvas id="loginsChart" style="max-height: 400px;"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
function getAxisColor() {
    return document.body.classList.contains('dark-mode') ? '#ffffff' : '#000000';
}

function renderChart() {
    const axisColor = getAxisColor();

    const loginLabels = <?= json_encode(array_column($loginCounts, 'username')); ?>;
    const loginCounts = <?= json_encode(array_column($loginCounts, 'total_logins')); ?>;

    const ctxLogins = document.getElementById('loginsChart').getContext('2d');
    if (window.loginChart) {
        window.loginChart.destroy();
    }
    window.loginChart = new Chart(ctxLogins, {
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
                    ticks: { stepSize: 1, color: axisColor },
                    grid: { color: axisColor }
                },
                x: {
                    ticks: { color: axisColor },
                    grid: { color: axisColor }
                }
            }
        }
    });
}

renderChart();

const themeToggle = document.getElementById('themeToggle');
themeToggle.addEventListener('change', function () {
    setTimeout(renderChart, 200); 
});
</script>


<?php require_once 'app/views/templates/footer.php'; ?>
