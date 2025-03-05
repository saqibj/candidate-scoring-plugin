jQuery(document).ready(function($) {
    // Calculate weighted score dynamically
    function calculateScore() {
        let total = 0;

        // Core Competencies
        $('[name^="core_competencies"]').each(function() {
            if ($(this).attr('name').includes('[rating]')) {
                const weight = $(this).closest('tr').find('input[type="hidden"]').val();
                total += ($(this).val() * weight);
            }
        });

        // Role-Specific Skills
        $('[name^="role_specific_skills"]').each(function() {
            if ($(this).attr('name').includes('[rating]')) {
                const weight = $(this).closest('tr').find('input[type="hidden"]').val();
                total += ($(this).val() * weight);
            }
        });

        // Behavioral Attributes
        $('[name^="behavioral_attributes"]').each(function() {
            if ($(this).attr('name').includes('[rating]')) {
                const weight = $(this).closest('tr').find('input[type="hidden"]').val();
                total += ($(this).val() * weight);
            }
        });

        $('#weighted-score-display').text(total.toFixed(2));
    }

    // Update on any rating change
    $('select[name$="[rating]"]').on('change', calculateScore);
    
    // Initial calculation
    calculateScore();
});