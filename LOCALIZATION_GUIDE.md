# Laravel Localization Guide for Khmer Language
# មគ្រាប់បណ្ណាយ Laravel Localization សម្រាប់ភាសាខ្មែរ

## Overview
This guide shows how to properly set up Laravel localization for Khmer language in your NUMiLaw project, moving away from hardcoded Khmer text to following Laravel's internationalization standards.

## 1. Directory Structure Created

```
lang/
├── km/
│   ├── common.php          # Common translations (navigation, buttons, etc.)
│   ├── admission.php       # Admission-specific translations
│   ├── requirements.php    # Requirements page translations
│   ├── apply.php          # Application form translations
│   └── success.php        # Success page translations
└── en/
    └── (your existing English files)
```

## 2. Configuration Updated

Updated `config/app.php` to include:
```php
'supported_locales' => [
    'en' => 'English',
    'km' => 'ភាសាខ្មែរ',
],
```

## 3. Translation Key Organization

### Common Elements (lang/km/common.php)
- Navigation items
- Common buttons and actions
- Status labels
- Time and date terms
- Academic terms

### Feature-Specific Files
- `admission.php` - All admission page text
- `requirements.php` - Requirements page content
- `apply.php` - Application form labels
- `success.php` - Success page messages

## 4. Using Translation Helpers

### Basic Translations
```php
// Simple translation
{{ __('common.home') }}
{{ __('admission.title') }}

// With parameters
{{ __('common.welcome', ['name' => $userName]) }}
{{ __('messages.application_success', ['program' => $programName]) }}
```

### Pluralization
```php
// In lang/km/common.php
'students_count' => '{0} គ្មាននិស្សិត|{1} :count និស្សិត|[2,*] :count និស្សិត',

// In Blade
{{ trans_choice('common.students_count', $studentCount) }}
{{ trans_choice('common.students_count', $studentCount, ['count' => $studentCount]) }}
```

### Conditional Translations
```php
@if(app()->getLocale() === 'km')
    {{ $item['title_km'] }}
@else
    {{ $item['title_en'] }}
@endif
```

## 5. Dynamic Content Handling

### Custom Helper Functions
Created in `app/Providers/TranslationServiceProvider.php`:

```php
// Khmer date formatting
km_date($carbonDate)

// Khmer number formatting
km_number(1234)

// Khmer currency formatting
km_currency(1234.56)

// Degree type labels
get_degree_type_label('bachelor')
```

### Using in Views
```php
<p>{{ km_date($program->created_at) }}</p>
<p>{{ km_currency($program->tuition_fee) }}</p>
<span>{{ get_degree_type_label($program->degree_type) }}</span>
```

## 6. Migration Examples

### Before (Hardcoded)
```php
<h1>សូមស្វាគមន៍</h1>
<p>កម្មវិធីសិក្សា</p>
```

### After (Using Translations)
```php
<h1>{{ __('messages.welcome') }}</h1>
<p>{{ __('admission.academic_programs') }}</p>
```

## 7. Controller Updates

### Before
```php
return [
    'title_en' => 'Application Opens',
    'title_km' => 'ការដាក់ពាក្យបើក',
];
```

### After
```php
return [
    'title_en' => 'Application Opens',
    'title_km' => __('important_dates.application_opens'),
];
```

## 8. Best Practices

### File Organization
- Group related translations together
- Use descriptive key names
- Follow naming convention: `file_name.key_name`
- Keep English and Khmer versions parallel

### Key Naming
```php
// Good examples
'navigation.home'
'admission.title'
'form.submit_button'
'messages.success_notification'
'validation.required_field'

// Use dots for hierarchy
'admission.requirements.academic'
'form.validation.email_format'
```

### Context-Specific Keys
```php
// Separate similar concepts
'user.greeting'      // Personal greeting
'system.welcome'     // System welcome message
'email.salutation'    // Email greeting

// Use file prefixes
'admission.*'        // All admission-related
'common.*'          // Shared across app
'validation.*'        // Form validation messages
```

### Parameter Handling
```php
// Named parameters (preferred)
'welcome_message' => 'Welcome, :name! You have :count notifications.',
{{ __('common.welcome_message', ['name' => $user->name, 'count' => $notifications]) }}

// Positional parameters (avoid if possible)
'welcome_message' => 'Welcome, %s! You have %d notifications.',
```

### Pluralization Rules
```php
// Khmer pluralization patterns
'item_count' => '{0} គ្មានធាតុ|{1} ធាតុទី|[2,3] ធាតុ២|[4,*] ធាតុ',
```

## 9. Advanced Features

### JSON Translations (Optional)
For JavaScript-heavy applications:
```
lang/km.json
{
    "welcome": "សូមស្វាគមន៍",
    "loading": "កំពុងផ្ទុក",
    "error": "កំហុស"
}
```

### Validation Messages
```php
// In lang/km/validation.php
'required' => 'ត្រូវការត្រូវតមាន :attribute។',
'email' => 'ទម្រង់អ៊ីមែល :attribute មិនត្រូវតមាន។',
'min' => ':attribute ត្រូវតែមាន :min តម្រូវទៅ។',
```

### Using in Controllers
```php
$validated = $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email',
], [
    'name.required' => __('validation.required', ['attribute' => 'ឈ្មោះ']),
    'email.email' => __('validation.email', ['attribute' => 'អ៊ីមែល']),
]);
```

## 10. JavaScript Usage

### Inline Translations
```javascript
// In Blade
<script>
const translations = @json(__('js'));
console.log(translations.welcome);
</script>
```

### Using Laravel Lang JS
```bash
npm install laravel-lang-js
php artisan lang:js
```

```javascript
// In JavaScript files
import __ from 'laravel-lang-js';

console.log(__('messages.welcome'));
console.log(__('common.loading'));
```

## 11. Maintenance Tips

### Keeping Translations Updated
1. **Regular Review**: Check for missing translations monthly
2. **User Feedback**: Ask Khmer speakers to review
3. **Version Control**: Track changes to translation files
4. **Testing**: Test both languages regularly

### Tools and Commands
```bash
# Find missing translations
php artisan trans:missing

# Export to JSON
php artisan trans:export

# Find translation usage
grep -r "__(" resources/views/
```

### Translation Quality
- Use consistent terminology
- Consider cultural context
- Test with actual Khmer users
- Keep sentences natural and readable

## 12. Example Migration Plan

### Phase 1: Core Pages
1. Home page
2. Navigation
3. Common elements

### Phase 2: Feature Areas
1. Admission section
2. Academic programs
3. Faculty directory

### Phase 3: Advanced Features
1. Form validation
2. Email templates
3. Admin panel

### Phase 4: Polish
1. Review all translations
2. Add missing keys
3. Optimize performance

This structure provides a solid foundation for maintaining Khmer translations while following Laravel best practices.