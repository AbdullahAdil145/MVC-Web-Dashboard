<?php

class Reminder {

    public function __construct() {
    }

    public function get_all_reminders() {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM reminders WHERE user_id = ?;");
        $statement->execute([$_SESSION['user_id']]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function create_reminder($user_id, $subject) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO reminders (user_id, subject, created_at) VALUES (?, ?, NOW());");
        return $statement->execute([$user_id, $subject]);
    }

    public function update_reminder($id, $subject) {
        $db = db_connect();
        $statement = $db->prepare("UPDATE reminders SET subject = ? WHERE id = ?;");
        return $statement->execute([$subject, $id]);
    }

    public function delete_reminder($id) {
        $db = db_connect();
        $statement = $db->prepare("DELETE FROM reminders WHERE id = ?;");
        return $statement->execute([$id]);
    }

    // Complete reminder is the same as delete
    public function complete_reminder($id) {
        return $this->delete_reminder($id);
    }

    public function count_reminders() {
        $db = db_connect();
        $statement = $db->prepare("SELECT COUNT(*) FROM reminders WHERE user_id = ?;");
        $statement->execute([$_SESSION['user_id']]);
        return $statement->fetchColumn();
    }

    public function get_all_reminders_admin() {
        $db = db_connect();
        $stmt = $db->query("SELECT * FROM reminders");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function user_with_most_reminders() {
        $db = db_connect();
        $stmt = $db->query("
            SELECT users.username, COUNT(reminders.id) AS total
            FROM reminders
            JOIN users ON reminders.user_id = users.id
            GROUP BY users.username
            ORDER BY total DESC
            LIMIT 1
        ");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
