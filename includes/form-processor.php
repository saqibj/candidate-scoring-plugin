<?php
add_action('admin_init', 'csp_handle_form_submission');
function csp_handle_form_submission() {
    if (!isset($_POST['csp_score_submit']) || !current_user_can('manage_options')) return;

    check_admin_referer('csp_score_nonce');

    // Validate ratings
    $valid_ratings = [1, 2, 3, 4, 5];
    foreach (['core_competencies', 'role_specific_skills', 'behavioral_attributes'] as $section) {
        if (!isset($_POST[$section]) || !is_array($_POST[$section])) {
            wp_die('Invalid form data structure');
        }
        foreach ($_POST[$section] as $category => $values) {
            if (!in_array($values['rating'], $valid_ratings)) {
                wp_die('Invalid rating value for ' . $category);
            }
        }
    }

    // Calculate weighted score
    $core_total = 0;
    foreach ($_POST['core_competencies'] as $category => $values) {
        $core_total += ($values['rating'] * $values['weight']);
    }

    $role_total = 0;
    foreach ($_POST['role_specific_skills'] as $category => $values) {
        $role_total += ($values['rating'] * $values['weight']);
    }

    $behavior_total = 0;
    foreach ($_POST['behavioral_attributes'] as $category => $values) {
        $behavior_total += ($values['rating'] * $values['weight']);
    }

    $total_weight = array_sum(array_column($_POST['core_competencies'], 'weight')) 
                  + array_sum(array_column($_POST['role_specific_skills'], 'weight')) 
                  + array_sum(array_column($_POST['behavioral_attributes'], 'weight'));

    $weighted_score = ($core_total + $role_total + $behavior_total) / $total_weight;

    // Prepare data
    $data = [
        'candidate_name' => sanitize_text_field($_POST['candidate_name']),
        'interviewer' => sanitize_text_field($_POST['interviewer']),
        'position' => sanitize_text_field($_POST['position']),
        'referred_by' => sanitize_text_field($_POST['referred_by']),
        'core_competencies' => $_POST['core_competencies'],
        'role_specific_skills' => $_POST['role_specific_skills'],
        'behavioral_attributes' => $_POST['behavioral_attributes'],
        'weighted_score' => round($weighted_score, 2),
        'overall_recommendation' => sanitize_text_field($_POST['overall_recommendation']),
        'strengths' => sanitize_textarea_field($_POST['strengths'])
    ];

    // Save to database
    if (CSP_DB_Handler::save_score($data)) {
        add_action('admin_notices', function() {
            echo '<div class="notice notice-success"><p>Score saved successfully!</p></div>';
        });
    } else {
        add_action('admin_notices', function() {
            echo '<div class="notice notice-error"><p>Error saving score!</p></div>';
        });
    }
}