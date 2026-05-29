# Packagist Upload - Step-by-Step Instructions

**Package Name**: gazz96/form-builder  
**Current Status**: ✅ Ready for upload  
**Date**: 2026-05-29

---

## ⚠️ BEFORE YOU START

Make sure you have:
- ✅ GitHub account (github.com/gazz96)
- ✅ Packagist account (can create at packagist.org)
- ✅ All code committed locally

---

## STEP 1: Create GitHub Repository

### 1.1 Create New Repository

1. Go to: **https://github.com/new**
2. Fill in:
   - **Repository name**: `form-builder`
   - **Description**: `Laravel Form Builder - Create forms from array/JSON configuration`
   - **Visibility**: `Public` (IMPORTANT!)
   - Leave other options as default
3. Click **"Create repository"**

### 1.2 Push Code to GitHub

After creating repository on GitHub, run these commands in your terminal:

```bash
# Navigate to your project directory
cd /path/to/ui-core

# Set origin to your new repository
git remote set-url origin https://github.com/gazz96/form-builder.git

# Verify remote is set correctly
git remote -v

# Push code to GitHub
git push -u origin main --force

# Push all tags
git push -u origin --tags --force
```

**Wait for push to complete** (may take a minute)

---

## STEP 2: Create GitHub Personal Access Token

### 2.1 Generate Token

1. Go to: **https://github.com/settings/tokens**
2. Click **"Generate new token"** → **"Generate new token (classic)"**
3. Fill in:
   - **Token name**: `Packagist Token`
   - **Expiration**: `90 days` or longer
   - **Select scopes**: Check only `public_repo`
4. Scroll down and click **"Generate token"**
5. **Copy the token immediately** (you won't see it again!)

Token looks like: `ghp_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx`

**SAVE THIS TOKEN SOMEWHERE SAFE** - you'll need it for Packagist

---

## STEP 3: Register on Packagist

### 3.1 Create Account

1. Go to: **https://packagist.org/**
2. Click **"Sign Up"** (or login with GitHub)
3. Choose one:
   - **Option A**: Sign up with GitHub (recommended)
   - **Option B**: Register with email

If using email registration:
- **Username**: `gazz96`
- **Email**: `bagas.topati@gmail.com`
- **Password**: Create strong password

4. **Verify your email**
5. Complete your profile

### 3.2 Add GitHub Integration

1. Login to Packagist
2. Go to: **https://packagist.org/profile/** (your profile)
3. Go to **"Settings"** or **"Security"**
4. Find **"GitHub API Token"** section
5. Paste the token you created in Step 2
6. Click **"Save"**

---

## STEP 4: Submit Package to Packagist

### 4.1 Submit via Web Interface

1. Login to Packagist (if not already logged in)
2. Click **"Submit Package"** or go to: **https://packagist.org/packages/submit**
3. Enter repository URL:
   ```
   https://github.com/gazz96/form-builder.git
   ```
4. Click **"Check"**
5. Verify package details appear correctly
6. Click **"Submit"**

### 4.2 Verify Submission

After submission, your package will be at:
```
https://packagist.org/packages/gazz96/form-builder
```

It may take a few minutes to index. You should see:
- Package name: `gazz96/form-builder`
- Version: `v2.0.0` (or latest tag)
- Description
- Download button

---

## STEP 5: Setup Auto-Update (Webhook)

### 5.1 Configure GitHub Webhook

This makes your package auto-update on Packagist when you push to GitHub.

**Option A: Recommended - Setup in GitHub**

1. Go to your GitHub repository: **https://github.com/gazz96/form-builder**
2. Click **"Settings"** → **"Webhooks"** → **"Add webhook"**
3. Fill in:
   - **Payload URL**: `https://packagist.org/api/github`
   - **Content type**: `application/json`
   - **Events**: Select "Push events"
   - **Active**: ✓ Checked
4. Click **"Add webhook"**

**Option B: Manual Setup in Packagist**

1. Go to your package on Packagist
2. Click **"Settings"** or **"Admin"**
3. If webhook is not auto-configured, you can manually trigger updates

---

## STEP 6: Test Installation

### 6.1 Verify Package is Installable

Open a NEW directory (not your project folder) and test:

```bash
# Test 1: Check package info
curl https://packagist.org/p/gazz96/form-builder.json

# Test 2: Try to install
composer require gazz96/form-builder

# Test 3: Verify it works
php -r "require 'vendor/autoload.php'; echo 'OK';"
```

---

## 🎉 COMPLETE - What's Next?

Your package is now on Packagist! You can:

### Version Updates

When you have updates:

```bash
# 1. Update version in composer.json (optional - can use tags instead)
# 2. Update CHANGELOG.md
# 3. Commit changes
git add -A
git commit -m "chore: Update version to v2.1.0"

# 4. Create tag
git tag -a v2.1.0 -m "Release v2.1.0"

# 5. Push
git push origin main
git push origin v2.1.0
```

Packagist will automatically detect the new tag and update!

### Monitor Downloads

Track your package stats at:
```
https://packagist.org/packages/gazz96/form-builder
```

---

## 🐛 Troubleshooting

### Issue: "composer.json not found"

**Solution:**
- Make sure repository is PUBLIC
- Verify composer.json is in root directory
- Run: `git push` to ensure code is on GitHub

### Issue: "Invalid PSR-4 autoload"

**Solution:**
- Check autoload section in composer.json
- Verify namespace matches directory structure
- Run: `composer validate` locally

### Issue: Package not showing latest version

**Solution:**
1. Wait 5-10 minutes for indexing
2. If still not updated, click **"Force Update"** on package page
3. Verify tag exists: `git tag -l`

### Issue: Webhook not working

**Solution:**
1. Check webhook in GitHub Settings
2. Click webhook and check "Recent Deliveries"
3. Manually click "Force Update" on Packagist package page

---

## 📋 Summary

| Step | Action | Status |
|------|--------|--------|
| 1 | Create GitHub repository | ⏳ Pending |
| 2 | Create GitHub token | ⏳ Pending |
| 3 | Register on Packagist | ⏳ Pending |
| 4 | Submit package | ⏳ Pending |
| 5 | Setup webhook | ⏳ Pending |
| 6 | Test installation | ⏳ Pending |

---

## 🔗 Important Links

- **GitHub Repository**: https://github.com/gazz96/form-builder
- **GitHub New Repo**: https://github.com/new
- **GitHub Tokens**: https://github.com/settings/tokens
- **Packagist**: https://packagist.org/
- **Your Package**: https://packagist.org/packages/gazz96/form-builder
- **Submit Package**: https://packagist.org/packages/submit

---

## ✨ You're All Set!

Follow these steps in order and your package will be live on Packagist!

Need help? Check PACKAGIST_GUIDE.md for more detailed information.
