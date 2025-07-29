# Red-Knot Immigration Website - BigRock Deployment Guide

## Pre-Deployment Checklist

### 1. Domain and Hosting Setup

- [ ] Domain configured and pointed to BigRock servers
- [ ] cPanel access credentials ready
- [ ] SSL certificate installed (Let's Encrypt or purchased)
- [ ] Email accounts created (info@redknot.ae, etc.)

### 2. File Preparation

- [ ] All placeholder phone numbers updated (+971-XX-XXX-XXXX)
- [ ] Email addresses verified (info@redknot.ae)
- [ ] Business license number added
- [ ] WhatsApp numbers updated

## Deployment Steps

### Step 1: Upload Files via cPanel File Manager

1. **Upload Website Files**

   ```
   Upload all files from /docs/ directory to public_html/
   Maintain the following structure:

   public_html/
   ├── index.html
   ├── about.html
   ├── contact.html
   ├── careers.html
   ├── css/
   ├── js/
   ├── images/
   ├── forms/
   │   ├── contact-form.php
   │   ├── config.php
   │   └── file-handler.php
   └── .htaccess
   ```

2. **Set Correct File Permissions**
   ```
   Directories: 755
   HTML/CSS/JS files: 644
   PHP files: 644
   .htaccess: 644
   ```

### Step 2: Create Upload Directories

Via cPanel File Manager, create:

```
public_html/forms/uploads/
public_html/forms/uploads/resumes/
public_html/forms/uploads/assessments/
```

Set permissions to 755 for directories.

### Step 3: Configure Email Settings

1. **In cPanel Email section:**

   - Create email account: info@redknot.ae
   - Set up email forwarding if needed
   - Configure SMTP settings if using external email

2. **Test email functionality:**
   - Submit a test form
   - Verify emails are received at info@redknot.ae

### Step 4: PHP Configuration

1. **Check PHP version** (7.4+ recommended)
2. **Verify PHP extensions:**
   - fileinfo (for file type detection)
   - gd (for image handling)
   - curl (for external API calls)

### Step 5: Security Configuration

1. **Upload Protection:**

   - Verify .htaccess in upload directories
   - Test that PHP files cannot be executed in upload dirs

2. **Form Security:**
   - Test rate limiting
   - Verify file upload restrictions

## Testing Checklist

### Forms Testing

- [ ] Contact form submission (index.html)
- [ ] Contact form submission (contact.html)
- [ ] Career application form (careers.html)
- [ ] Visa assessment form (index.html)
- [ ] File upload functionality
- [ ] Email delivery to info@redknot.ae
- [ ] Thank you page redirects
- [ ] Error page redirects

### File Upload Testing

- [ ] PDF upload (valid)
- [ ] DOC upload (valid)
- [ ] DOCX upload (valid)
- [ ] Oversized file rejection (>5MB)
- [ ] Invalid file type rejection
- [ ] File storage in correct directories

### Security Testing

- [ ] Rate limiting (try submitting >5 forms rapidly)
- [ ] SQL injection attempts (form fields)
- [ ] File upload security (try uploading .php files)
- [ ] Direct access to upload directories (should be blocked)

## Environment-Specific Configuration

### BigRock Hosting Specifics

1. **Email Configuration:**

   ```php
   // In config.php, ensure these are set:
   define('ADMIN_EMAIL', 'info@redknot.ae');
   define('FROM_EMAIL', 'noreply@redknot.ae');
   ```

2. **File Path Adjustments:**

   - All paths are relative to public_html/
   - Upload directories under forms/uploads/

3. **Error Logging:**
   - Check cPanel Error Logs section
   - Monitor form submission logs

## Post-Deployment Monitoring

### Daily Checks (First Week)

- [ ] Form submissions working
- [ ] Email delivery
- [ ] File uploads successful
- [ ] Error logs clean

### Weekly Checks

- [ ] Log file sizes (prevent overflow)
- [ ] Upload directory space usage
- [ ] Newsletter subscriber list

## Troubleshooting

### Common Issues

1. **Forms not submitting:**

   - Check file permissions
   - Verify PHP error logs
   - Ensure upload directories exist

2. **Emails not sending:**

   - Verify email account exists
   - Check SMTP settings
   - Review email logs in cPanel

3. **File uploads failing:**
   - Check directory permissions
   - Verify file size limits
   - Review PHP upload settings

### Contact Information

- **Technical Support:** [Your Developer Contact]
- **Domain/Hosting:** BigRock Support
- **Email Issues:** Check cPanel or contact hosting provider

## Maintenance

### Regular Tasks

- **Monthly:** Review and archive log files
- **Quarterly:** Update contact information if needed
- **Yearly:** Renew SSL certificate and domain

### Backup Recommendations

- **Files:** Backup via cPanel File Manager monthly
- **Database:** Not applicable (file-based storage)
- **Email:** Regular email backups if using cPanel email

## Security Updates

Keep monitoring for:

- PHP version updates
- Security patches
- SSL certificate renewal
- Regular password changes for cPanel access
