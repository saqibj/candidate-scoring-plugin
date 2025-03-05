<?php
class CSP_DB_Handler {
    public static function create_tables() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'candidate_scores';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            candidate_name varchar(255) NOT NULL,
            interviewer varchar(255) NOT NULL,
            position varchar(255) NOT NULL,
            referred_by varchar(255),
            date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            core_competencies text NOT NULL,
            role_specific_skills text NOT NULL,
            behavioral_attributes text NOT NULL,
            weighted_score float NOT NULL,
            overall_recommendation varchar(50) NOT NULL,
            strengths text NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate; ENGINE=InnoDB";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public static function save_score($data) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'candidate_scores';
        
        return $wpdb->insert(
            $table_name,
            [
                'candidate_name' => sanitize_text_field($data['candidate_name']),
                'interviewer' => sanitize_text_field($data['interviewer']),
                'position' => sanitize_text_field($data['position']),
                'referred_by' => sanitize_text_field($data['referred_by']),
                'date' => current_time('mysql'),
                'core_competencies' => json_encode($data['core_competencies']),
                'role_specific_skills' => json_encode($data['role_specific_skills']),
                'behavioral_attributes' => json_encode($data['behavioral_attributes']),
                'weighted_score' => floatval($data['weighted_score']),
                'overall_recommendation' => sanitize_text_field($data['overall_recommendation']),
                'strengths' => sanitize_textarea_field($data['strengths'])
            ],
            ['%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%f', '%s', '%s']
        );
    }
}