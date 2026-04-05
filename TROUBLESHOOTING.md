# Article CRUD Troubleshooting Guide

## Issues to Check:

### 1. Authentication Issues
- Make sure you're logged in with admin credentials
- Check if AdminMiddleware is working correctly
- Verify session is maintained

### 2. Route Issues
- Check if routes are registered correctly
- Verify middleware is applied
- Test basic route accessibility

### 3. Database Issues
- Check if database tables exist
- Verify relationships are working
- Test basic model operations

### 4. View Issues
- Check if blade templates exist
- Verify form actions are correct
- Test form validation

## Testing Steps:

### Step 1: Basic Access Test
1. Go to: http://127.0.0.1:8000/admin/login
2. Login with: admin@lawuniversity.edu / admin123
3. Go to: http://127.0.0.1:8000/admin/articles
4. Check if page loads correctly

### Step 2: Create Article Test
1. Click "New Article" button
2. Fill in required fields (English title, content, Khmer title, content)
3. Select status as "Draft"
4. Submit form
5. Check if article is created

### Step 3: Edit Article Test
1. Click on an existing article
2. Click "Edit" button
3. Modify content
4. Submit form
5. Check if changes are saved

### Step 4: Delete Article Test
1. Click on an article
2. Click delete button
3. Confirm deletion
4. Check if article is removed

## Common Issues:

### Issue 1: Redirect to Login
**Solution**: Check AdminMiddleware and authentication

### Issue 2: Form Validation Error
**Solution**: Check form fields match validation rules

### Issue 3: 404 Not Found
**Solution**: Check routes and controller methods

### Issue 4: Database Error
**Solution**: Check migrations and model relationships

## Debug Commands:

```bash
# Check routes
php artisan route:list --name=admin.articles

# Check database
php artisan tinker
\App\Models\Article::count()

# Clear cache
php artisan cache:clear
php artisan config:clear
```

## Quick Fix Checklist:

1. ✅ Login with admin credentials
2. ✅ Navigate to /admin/articles
3. ✅ Try creating a simple article
4. ✅ Check error messages in Laravel logs
5. ✅ Verify form submission data
6. ✅ Test with minimal required fields only