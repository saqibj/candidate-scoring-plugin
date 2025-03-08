<div class="wrap">
    <h1>Candidate Scoring Form</h1>
    
    <?php settings_errors(); ?>
    
    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
        <?php wp_nonce_field('csp_score_nonce'); ?>
        
        <!-- Basic Info Section -->
        <div class="postbox">
            <div class="inside">
                <h2>Candidate Information</h2>
                <table class="form-table">
                    <tr>
                        <th><label>Candidate Name</label></th>
                        <td><input type="text" name="candidate_name" class="regular-text" required></td>
                    </tr>
                    <tr>
                        <th><label>Interviewer</label></th>
                        <td><input type="text" name="interviewer" class="regular-text" required></td>
                    </tr>
                    <tr>
                        <th><label>Position Applied For</label></th>
                        <td><input type="text" name="position" class="regular-text" required></td>
                    </tr>
                    <tr>
                        <th><label>Referred By</label></th>
                        <td><input type="text" name="referred_by" class="regular-text"></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Core Competencies -->
        <div class="postbox">
            <div class="inside">
                <h2>I. Core Competencies</h2>
                <table class="form-table">
                    <?php 
                    $core_categories = [
                        'Analytical Skills' => 20,
                        'Technical Skills' => 20,
                        'Communication Skills' => 15,
                        'Business Acumen' => 15,
                        'Problem Solving' => 15
                    ];
                    
                    foreach ($core_categories as $category => $weight) : ?>
                    <tr>
                        <th><?php echo esc_html($category); ?> (<?php echo $weight; ?>%)</th>
                        <td>
                            <select name="core_competencies[<?php echo esc_attr($category); ?>][rating]" required>
                                <option value="">Select Rating</option>
                                <?php for ($i=1; $i<=5; $i++) : ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                            <input type="hidden" name="core_competencies[<?php echo esc_attr($category); ?>][weight]" value="<?php echo $weight/100; ?>">
                            <textarea name="core_competencies[<?php echo esc_attr($category); ?>][comments]" placeholder="Comments" class="regular-text"></textarea>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

        <!-- Role-Specific Skills & Experience -->
        <div class="postbox">
            <div class="inside">
                <h2>II. Role-Specific Skills & Experience</h2>
                <table class="form-table">
                    <?php 
                    $role_categories = [
                        'Relevant Experience' => 20,
                        'Data Analysis & Interpretation' => 20,
                        'Reporting & Presentation' => 15,
                        '[Add Specific Skill]' => 10,
                        '[Add Specific Skill]' => 10
                    ];
                    
                    foreach ($role_categories as $category => $weight) : ?>
                    <tr>
                        <th><?php echo esc_html($category); ?> (<?php echo $weight; ?>%)</th>
                        <td>
                            <select name="role_specific_skills[<?php echo esc_attr($category); ?>][rating]" required>
                                <option value="">Select Rating</option>
                                <?php for ($i=1; $i<=5; $i++) : ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                            <input type="hidden" name="role_specific_skills[<?php echo esc_attr($category); ?>][weight]" value="<?php echo $weight/100; ?>">
                            <textarea name="role_specific_skills[<?php echo esc_attr($category); ?>][comments]" placeholder="Comments" class="regular-text"></textarea>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

        <!-- Behavioral Attributes & Cultural Fit -->
        <div class="postbox">
            <div class="inside">
                <h2>III. Behavioural Attributes & Cultural Fit</h2>
                <table class="form-table">
                    <?php 
                    $behavior_categories = [
                        'Teamwork & Collaboration' => 15,
                        'Initiative & Proactiveness' => 15,
                        'Adaptability & Flexibility' => 10,
                        'Time Management' => 10,
                        'Cultural Fit' => 10
                    ];
                    
                    foreach ($behavior_categories as $category => $weight) : ?>
                    <tr>
                        <th><?php echo esc_html($category); ?> (<?php echo $weight; ?>%)</th>
                        <td>
                            <select name="behavioral_attributes[<?php echo esc_attr($category); ?>][rating]" required>
                                <option value="">Select Rating</option>
                                <?php for ($i=1; $i<=5; $i++) : ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                            <input type="hidden" name="behavioral_attributes[<?php echo esc_attr($category); ?>][weight]" value="<?php echo $weight/100; ?>">
                            <textarea name="behavioral_attributes[<?php echo esc_attr($category); ?>][comments]" placeholder="Comments" class="regular-text"></textarea>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

        <!-- Overall Assessment -->
        <div class="postbox">
            <div class="inside">
                <h2>IV. Overall Assessment</h2>
                <table class="form-table">
                    <tr>
                        <th>Overall Recommendation</th>
                        <td>
                            <?php $options = ['Highly Recommended', 'Recommended', 'Neutral', 'Not Recommended']; ?>
                            <?php foreach ($options as $option) : ?>
                            <label><input type="radio" name="overall_recommendation" value="<?php echo esc_attr($option); ?>" required> <?php echo $option; ?></label><br>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Strengths</th>
                        <td><textarea name="strengths" class="large-text" rows="4" required></textarea></td>
                    </tr>
                </table>
            </div>
        </div>

        <?php submit_button('Save Score', 'primary', 'csp_score_submit'); ?>
    </form>
</div>