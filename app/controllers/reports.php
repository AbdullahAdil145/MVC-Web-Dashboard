<?php

class Reports extends Controller {

    public function index() {
        
        $reminder = $this->model('Reminder');
        $user = $this->model('User');

        $allReminders = $reminder->get_all_reminders_admin();
        $mostRemindersUser = $reminder->user_with_most_reminders();
        $loginCounts = $user->get_login_counts();

        $this->view('reports/index', [
            'allReminders' => $allReminders,
            'mostRemindersUser' => $mostRemindersUser,
            'loginCounts' => $loginCounts
        ]);
    }
}
