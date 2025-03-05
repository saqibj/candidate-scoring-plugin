# Candidate Scoring Plugin for WordPress

![MIT License](https://img.shields.io/badge/License-MIT-blue.svg)

A secure admin-only plugin for evaluating candidates using weighted scoring metrics. Designed for HR teams and hiring managers.

**Author**: Saqib Jawaid  
**License**: MIT  
**Version**: 1.0

## Features

- 🔐 Admin-only access control
- 🧮 Automatic weighted score calculation
- 📊 Three assessment categories:
  - Core Competencies
  - Role-Specific Skills
  - Behavioral Attributes
- 💾 Secure data storage
- 📈 Real-time score preview
- 📤 CSV-friendly database structure

## Installation

1. Download the plugin ZIP file
2. In WordPress admin, go to **Plugins → Add New → Upload Plugin**
3. Activate the plugin
4. Navigate to **Candidate Scoring** in the admin menu

## Usage

1. **Access Form**:  
   `WP Admin → Candidate Scoring`

2. **Complete Fields**:
   - Candidate information
   - Rate competencies (1-5 scale)
   - Add comments for each category
   - Select overall recommendation

3. **Save Data**:  
   Scores are automatically stored in the database with weighted calculations.

## Configuration

### Custom Skills
Edit in `admin/partials/admin-display.php`:
```php
$role_categories = [
    'Relevant Experience' => 20,
    'Data Analysis & Interpretation' => 20,
    // Modify these lines ↓
    'Cloud Architecture' => 10,  // Example customization
    'DevOps Practices' => 10
];
```

### Permissions
Change capability in `candidate-scoring-plugin.php`:
```php
add_menu_page(..., 'edit_others_posts', ...);  // For editor access
```



## Contributing

1. Fork the repository
2. Create feature branch: `git checkout -b new-feature`
3. Commit changes: `git commit -am 'Add feature'`
4. Push to branch: `git push origin new-feature`
5. Submit pull request

## Support

For issues/questions:  
🐛 [GitHub Issues](https://github.com/saqibjawaid/candidate-scoring-plugin/issues)

```