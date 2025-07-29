# CI/CD Setup Guide: GitHub → BigRock cPanel

Complete guide for setting up continuous integration and deployment from GitHub to BigRock cPanel hosting.

## 🎯 Available CI/CD Options

### Option 1: GitHub Actions (Recommended)
**Best for:** Full automation, flexibility, and control
**Complexity:** Medium
**Cost:** Free (GitHub Actions included)

### Option 2: cPanel Git Integration (If Available)
**Best for:** Simple setup, native cPanel integration
**Complexity:** Low
**Cost:** Free (built into cPanel)

### Option 3: Webhook + Deploy Script
**Best for:** Custom deployment logic
**Complexity:** Medium-High
**Cost:** Free

### Option 4: Third-party Services
**Best for:** Enterprise workflows
**Complexity:** Low-Medium
**Cost:** Paid services

---

## 🚀 Method 1: GitHub Actions Deployment (Recommended)

This method automatically deploys your code to BigRock hosting whenever you push to GitHub.

### Step 1: Create GitHub Actions Workflow

Create `.github/workflows/deploy.yml` in your repository:

```yaml
name: Deploy to BigRock cPanel

on:
  push:
    branches: [ main ]
  pull_request:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    
    steps:
    - name: Checkout code
      uses: actions/checkout@v3
      
    - name: Setup Node.js (if needed)
      uses: actions/setup-node@v3
      with:
        node-version: '18'
        
    - name: Install dependencies (if needed)
      run: |
        # npm install
        # composer install
        echo "Installing dependencies..."
        
    - name: Build project (if needed)
      run: |
        # npm run build
        # php artisan optimize
        echo "Building project..."
        
    - name: Deploy to cPanel
      uses: SamKirkland/FTP-Deploy-Action@4.3.3
      with:
        server: ${{ secrets.FTP_HOST }}
        username: ${{ secrets.FTP_USERNAME }}
        password: ${{ secrets.FTP_PASSWORD }}
        local-dir: ./docs/
        server-dir: public_html/
        exclude: |
          **/.git*
          **/.git*/**
          **/node_modules/**
          **/.env
          **/README.md
```

### Step 2: Configure GitHub Secrets

In your GitHub repository:

1. Go to **Settings** → **Secrets and variables** → **Actions**
2. Click **New repository secret**
3. Add these secrets:

```
FTP_HOST = your-domain.com (or IP address)
FTP_USERNAME = your-cpanel-username
FTP_PASSWORD = your-cpanel-password
```

### Step 3: Alternative: SFTP Deployment

For better security, use SFTP instead of FTP:

```yaml
- name: Deploy via SFTP
  uses: wlixcc/SFTP-Deploy-Action@v1.2.4
  with:
    server: ${{ secrets.SFTP_HOST }}
    username: ${{ secrets.SFTP_USERNAME }}
    password: ${{ secrets.SFTP_PASSWORD }}
    port: 22
    local_path: './docs/*'
    remote_path: '/public_html/'
    exclude: '.git*, node_modules*, .env'
```

---

## 🔧 Method 2: cPanel Git Integration

If BigRock supports cPanel Git Version Control, this is the simplest option.

### Step 1: Check cPanel Git Support

1. Login to your BigRock cPanel
2. Look for **"Git Version Control"** under **Files** section
3. If available, proceed with setup

### Step 2: Setup Pull Deployment

```bash
# 1. Create .cpanel.yml in your repository root
---
deployment:
  tasks:
    - export DEPLOYPATH=/home/username/public_html/
    - /bin/cp -R docs/* $DEPLOYPATH
    - /bin/cp docs/.htaccess $DEPLOYPATH
    - find $DEPLOYPATH -name "*.php" -exec chmod 644 {} \;
    - find $DEPLOYPATH -type d -exec chmod 755 {} \;
```

### Step 3: Configure Repository in cPanel

1. In cPanel → **Git Version Control** → **Create**
2. **Clone URL:** `https://github.com/yourusername/redknot.git`
3. **Repository Path:** `/public_html/`
4. **Repository Name:** `redknot-website`
5. Click **Create**

### Step 4: Setup Auto-Deploy

For automatic deployment, you can either:
- **Manual:** Pull changes via cPanel interface
- **Automatic:** Use cPanel cron jobs to pull periodically

```bash
# Add to cPanel Cron Jobs (every 5 minutes)
*/5 * * * * cd /home/username/public_html && git pull origin main
```

---

## 🪝 Method 3: Webhook + Deploy Script

### Step 1: Create Deploy Script

Create `docs/deploy.php`:

```php
<?php
/**
 * GitHub Webhook Deploy Script
 * Automatically pulls latest changes when GitHub sends webhook
 */

// Security: Verify GitHub webhook signature
$secret = 'your-webhook-secret';
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$payload = file_get_contents('php://input');
$expected = 'sha256=' . hash_hmac('sha256', $payload, $secret);

if (!hash_equals($expected, $signature)) {
    http_response_code(403);
    die('Unauthorized');
}

// Parse webhook payload
$data = json_decode($payload, true);

// Only deploy on push to main branch
if ($data['ref'] !== 'refs/heads/main') {
    die('Not main branch');
}

// Execute deployment
$output = [];
$return_var = 0;

// Change to repository directory
chdir('/home/username/public_html');

// Pull latest changes
exec('git pull origin main 2>&1', $output, $return_var);

// Log deployment
$log = date('Y-m-d H:i:s') . " - Deploy triggered by " . $data['pusher']['name'] . "\n";
$log .= "Commit: " . $data['head_commit']['id'] . "\n";
$log .= "Message: " . $data['head_commit']['message'] . "\n";
$log .= "Output: " . implode("\n", $output) . "\n\n";

file_put_contents('deploy.log', $log, FILE_APPEND | LOCK_EX);

// Return success
echo json_encode([
    'status' => 'success',
    'message' => 'Deployment completed',
    'output' => $output
]);
?>
```

### Step 2: Configure GitHub Webhook

1. In GitHub: **Settings** → **Webhooks** → **Add webhook**
2. **Payload URL:** `https://yourdomain.com/deploy.php`
3. **Content type:** `application/json`
4. **Secret:** `your-webhook-secret`
5. **Events:** Just the push event
6. Click **Add webhook**

### Step 3: Setup Repository on Server

```bash
# SSH into your BigRock server
ssh username@yourdomain.com

# Clone repository
cd public_html
git clone https://github.com/yourusername/redknot.git .

# Set up Git configuration
git config receive.denyCurrentBranch updateInstead
```

---

## ⚙️ Method 4: Advanced GitHub Actions with Build Process

For more complex deployments with build steps:

```yaml
name: Advanced Deploy to BigRock

on:
  push:
    branches: [ main ]

jobs:
  build-and-deploy:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.1'
        
    - name: Validate PHP files
      run: find docs/forms -name "*.php" -exec php -l {} \;
      
    - name: Optimize images
      run: |
        # Install image optimization tools
        sudo apt-get update
        sudo apt-get install -y jpegoptim optipng
        
        # Optimize images
        find docs/images -name "*.jpg" -exec jpegoptim --strip-all {} \;
        find docs/images -name "*.png" -exec optipng {} \;
        
    - name: Minify CSS/JS (optional)
      run: |
        # Install minification tools
        npm install -g clean-css-cli uglify-js
        
        # Minify CSS
        cleancss -o docs/css/style.min.css docs/css/style.css
        
        # Minify JS
        uglifyjs docs/js/main.js -o docs/js/main.min.js
        
    - name: Deploy to BigRock
      uses: SamKirkland/FTP-Deploy-Action@4.3.3
      with:
        server: ${{ secrets.FTP_HOST }}
        username: ${{ secrets.FTP_USERNAME }}
        password: ${{ secrets.FTP_PASSWORD }}
        local-dir: ./docs/
        server-dir: public_html/
        exclude: |
          **/.git*
          **/node_modules/**
          **/.env*
          **/src/**
          **/tests/**
          **/README.md
          **/.gitignore
```

---

## 🛡️ Security Best Practices

### 1. Environment Variables
Store sensitive data in GitHub secrets, not in code:

```yaml
env:
  DB_HOST: ${{ secrets.DB_HOST }}
  DB_USER: ${{ secrets.DB_USER }}
  DB_PASS: ${{ secrets.DB_PASS }}
```

### 2. File Permissions
Set correct permissions after deployment:

```yaml
- name: Set file permissions
  uses: appleboy/ssh-action@v0.1.5
  with:
    host: ${{ secrets.SSH_HOST }}
    username: ${{ secrets.SSH_USERNAME }}
    password: ${{ secrets.SSH_PASSWORD }}
    script: |
      find /home/username/public_html -type f -name "*.php" -exec chmod 644 {} \;
      find /home/username/public_html -type d -exec chmod 755 {} \;
      chmod 600 /home/username/public_html/forms/config.php
```

### 3. Exclude Sensitive Files
Always exclude development files:

```gitignore
# Add to .gitignore
.env
config/database.php
*.log
/vendor/
/node_modules/
.vscode/
.idea/
```

---

## 🧪 Testing Your CI/CD Pipeline

### 1. Test with Small Changes
Start with a simple HTML change to verify deployment works.

### 2. Monitor Deployment Logs
- GitHub Actions: Check **Actions** tab in your repository
- cPanel Git: Check deployment logs in cPanel
- Webhook: Monitor `deploy.log` file

### 3. Rollback Strategy
Keep a backup deployment script:

```bash
#!/bin/bash
# rollback.sh
cd /home/username/public_html
git reset --hard HEAD~1
echo "Rolled back to previous commit"
```

---

## 📊 Comparison Matrix

| Method | Setup Time | Automation | Control | Cost | Best For |
|--------|------------|------------|---------|------|----------|
| GitHub Actions | 30-60 min | Full | High | Free | Most projects |
| cPanel Git | 15-30 min | Medium | Medium | Free | Simple sites |
| Webhook | 45-90 min | Full | High | Free | Custom logic |
| Third-party | 15-30 min | Full | Low | Paid | Enterprise |

---

## 🎯 Recommended Setup for Your Project

For your Red-Knot Immigration website, I recommend **GitHub Actions** because:

1. ✅ **Full automation** - Deploy on every push to main
2. ✅ **File validation** - Check PHP syntax before deploy
3. ✅ **Build optimization** - Minify CSS/JS, optimize images
4. ✅ **Security** - Environment variables for sensitive data
5. ✅ **Free** - No additional costs
6. ✅ **Rollback** - Easy to revert if needed

Would you like me to implement the GitHub Actions workflow for your specific setup?

---

## 🚀 Next Steps

1. **Choose your preferred method** from the options above
2. **Set up the workflow files** in your repository
3. **Configure secrets/credentials** in GitHub or cPanel
4. **Test with a small change** to verify it works
5. **Monitor the first few deployments** to ensure stability

Let me know which method you'd like to implement, and I'll help you set it up!