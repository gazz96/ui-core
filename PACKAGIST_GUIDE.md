# Panduan Upload Package ke Packagist

Panduan lengkap untuk upload `bagastopati/form-builder` package ke Packagist.

## ✅ Checklist Sebelum Upload

Pastikan project sudah memenuhi semua requirement ini:

- [x] **composer.json** - Sudah valid dan lengkap dengan:
  - [x] name: `bagastopati/form-builder`
  - [x] description: Deskripsi yang jelas
  - [x] license: MIT
  - [x] authors: Informasi author
  - [x] keywords: Untuk SEO
  - [x] autoload: PSR-4 yang benar
  - [x] require: Dependencies yang tepat

- [x] **LICENSE** - File MIT License sudah ada

- [x] **README.md** - Dokumentasi dengan:
  - [x] Installation instructions
  - [x] Quick start examples
  - [x] Usage examples
  - [x] Features
  - [x] Documentation links

- [x] **Source Code** - src/ directory dengan code yang siap produksi

- [x] **Tests** - Unit tests di tests/ directory

- [x] **Git Repository** - Initialized dan siap di-push

- [x] **.gitignore** - Sudah dikonfigurasi dengan baik

- [x] **SECURITY.md** - Security policy

- [x] **CONTRIBUTING.md** - Contribution guidelines

## 🚀 Step-by-Step Upload ke Packagist

### Step 1: Setup GitHub Repository

#### 1.1 Jika belum punya GitHub repository:

```bash
# Create repository di GitHub dengan nama "form-builder"
# https://github.com/new

# Setelah create, copy repository ke local
git remote add origin https://github.com/bagastopati/form-builder.git
git branch -M main
git push -u origin main
```

#### 1.2 Jika sudah punya repository:

```bash
# Verify remote URL
git remote -v

# Update remote jika perlu
git remote set-url origin https://github.com/bagastopati/form-builder.git

# Push semua commits
git push -u origin main
```

**Important**: Repository harus PUBLIC agar Packagist bisa access

### Step 2: Create GitHub Personal Access Token

1. Go to GitHub Settings: https://github.com/settings/tokens
2. Click "Generate new token" → "Generate new token (classic)"
3. Name: `Packagist Token`
4. Select scope: `public_repo` (minimal permission)
5. Click "Generate token"
6. **Copy dan simpan token** (hanya ditampilkan sekali!)

Contoh token format: `ghp_xxxxxxxxxxxxxxxxxxxxxxxxxxxx`

### Step 3: Register di Packagist

#### 3.1 Buat akun Packagist:

1. Go to https://packagist.org/
2. Click "Sign Up" atau login dengan GitHub
3. Fill form dengan:
   - Username: `bagastopati` (atau sesuai preference)
   - Email: `bagas.topati@gmail.com`
   - Password: Buat password yang kuat
4. Verify email
5. Complete profile information

#### 3.2 Setup GitHub Integration:

1. Login ke Packagist
2. Go to https://packagist.org/profile/
3. Click "Security" or "Settings"
4. Find "Personal API Token" section
5. Atau setup via GitHub: https://packagist.org/connect/github/

### Step 4: Submit Package ke Packagist

#### 4.1 Via Web Interface (Recommended):

1. Login ke Packagist
2. Click "Submit Package" atau di https://packagist.org/packages/submit
3. Masukkan Repository URL:
   ```
   https://github.com/bagastopati/form-builder.git
   ```
4. Click "Check"
5. Verify package details
6. Click "Submit"

Packagist akan:
- Validasi composer.json
- Download repository
- Index package

#### 4.2 Verifikasi Package:

Setelah submit, package akan muncul di:
```
https://packagist.org/packages/bagastopati/form-builder
```

### Step 5: Setup Auto-Update (Webhook)

Agar package auto-update saat ada push baru ke GitHub:

#### 5.1 Setup di GitHub:

1. Go to GitHub repository settings
2. Navigate ke "Webhooks" (Settings → Webhooks)
3. Click "Add webhook"
4. Configure:
   ```
   Payload URL: https://packagist.org/api/github
   Content type: application/json
   Events: Push events
   Active: ✓ Checked
   ```
5. Click "Add webhook"

GitHub akan mengirim notification ke Packagist setiap ada push.

#### 5.2 Alternative - Manual Sync:

Jika webhook tidak berfungsi, bisa manual sync di Packagist:

1. Go ke package page: https://packagist.org/packages/bagastopati/form-builder
2. Click "Force Update"
3. Atau lewat API:
   ```bash
   curl -X POST https://packagist.org/api/update-package?username=USERNAME&apiToken=API_TOKEN \
     -d '{"repository":"https://github.com/bagastopati/form-builder.git"}'
   ```

### Step 6: Test Installation

```bash
# Test install dari Packagist (di folder project lain)
composer create-project --prefer-dist bagastopati/form-builder my-project

# Atau add ke existing project
composer require bagastopati/form-builder
```

## 📋 Verifikasi Package di Packagist

Setelah upload, verify informasi package:

```bash
# Check package info via API
curl https://packagist.org/p/bagastopati/form-builder.json | jq '.'

# Or via web browser
# https://packagist.org/packages/bagastopati/form-builder
```

**Informasi yang akan ditampilkan:**
- Package name: bagastopati/form-builder
- Latest version: v2.0.0
- Description
- Keywords
- Dependencies
- Download statistics
- GitHub link

## 🔄 Version Management

### Release New Version:

```bash
# 1. Update version di composer.json (manual)
# atau gunakan convention:
# - v2.1.0 untuk minor update
# - v2.0.1 untuk patch
# - v3.0.0 untuk major update

# 2. Update CHANGELOG.md

# 3. Commit
git add -A
git commit -m "chore: Bump version to v2.1.0"

# 4. Create Git Tag
git tag -a v2.1.0 -m "Release version 2.1.0"

# 5. Push commits dan tags
git push origin main
git push origin v2.1.0

# Atau push semua tags
git push origin --tags
```

Packagist akan otomatis detect tag dan membuat release.

## 🐛 Troubleshooting

### Error: "composer.json file not found"

```
Solusi:
1. Pastikan composer.json ada di root directory
2. Check syntax: composer validate
3. Ensure repository is PUBLIC
```

### Error: "Invalid PSR-4 autoload"

```
Solusi:
1. Check autoload path di composer.json
2. Validate: composer validate
3. Ensure namespace matches directory structure
   
Contoh yang benar:
  "autoload": {
    "psr-4": {
      "BagasTopati\\UiCore\\": "src/"
    }
  }

File structure:
  src/
    FormBuilder.php (namespace: BagasTopati\UiCore)
```

### Package not showing latest version

```
Solusi:
1. Jika sudah 24 jam belum update, klik "Force Update"
2. Check GitHub webhook di GitHub Settings
3. Verify Git tags: git tag -l
4. Push tags: git push origin --tags
```

### Package dependencies error

```
Solusi:
1. Validate composer.json: composer validate
2. Check require versions match your actual needs
3. Test locally: composer install
4. Commit changes
5. Push dan force update di Packagist
```

## 📊 Monitor Package

### Packagist Dashboard:

1. Login ke Packagist
2. Go to profile: https://packagist.org/profile/
3. View packages stats:
   - Total downloads
   - Favorites
   - Latest updates
   - Dependencies

### Track Downloads:

```bash
# Via API
curl https://packagist.org/p/bagastopati/form-builder.json | jq '.package.downloads'

# Expected output
{
  "total": 1234,
  "monthly": 567,
  "daily": 12
}
```

## 🎯 Best Practices

### 1. Semantic Versioning

Follow SemVer format: `MAJOR.MINOR.PATCH`

```
v2.0.0 - Major release (breaking changes)
v2.1.0 - Minor release (new features)
v2.1.1 - Patch release (bug fixes)
```

### 2. Changelog Maintenance

Keep CHANGELOG.md updated:
- Added: New features
- Changed: Modifications
- Deprecated: Soon-to-be removed
- Removed: Deleted features
- Fixed: Bug fixes
- Security: Security fixes

Example:
```markdown
## [2.1.0] - 2026-05-30

### Added
- Button spacing support for Bootstrap 4, 5, and Tailwind

### Fixed
- Fixed row field type name validation
- Fixed syntax errors in TailwindFramework

### Changed
- Updated buttonSpacing() method to all framework classes
```

### 3. README Quality

Good README should include:
- Clear installation instructions
- Quick start examples
- Feature highlights
- Usage examples
- Documentation links
- Contributing guidelines
- License information

### 4. Security

- Never commit secrets (.env files)
- Include SECURITY.md
- Handle dependencies securely
- Keep dependencies updated

### 5. Testing

- Include unit tests
- Add test instructions di README
- Include code coverage info
- Ensure all tests pass

## 📝 Checklist Before Each Release

```bash
# 1. Update version
# vim composer.json  # Update version field

# 2. Update changelog
# vim CHANGELOG.md   # Document changes

# 3. Test locally
composer install
composer test

# 4. Commit
git add -A
git commit -m "chore: Release version v2.1.0"

# 5. Tag
git tag -a v2.1.0 -m "Release version 2.1.0"

# 6. Push
git push origin main
git push origin v2.1.0

# 7. Verify on Packagist
# https://packagist.org/packages/bagastopati/form-builder
# Check latest version muncul
```

## 🔗 Useful Links

- **Packagist**: https://packagist.org/
- **Composer Docs**: https://getcomposer.org/doc/
- **Semantic Versioning**: https://semver.org/
- **GitHub Webhooks**: https://docs.github.com/en/developers/webhooks-and-events/webhooks
- **PSR-4 Autoloading**: https://www.php-fig.org/psr/psr-4/
- **Laravel Package Development**: https://laravel.com/docs/packages

## ✨ Next Steps

1. **Push ke GitHub** - Jika belum
2. **Register di Packagist** - Daftar akun
3. **Submit Package** - Submit via Packagist interface
4. **Setup Webhook** - Auto-update saat push
5. **Test Installation** - Verify package bisa di-install
6. **Announce** - Share di community/social media

## 📞 Support

Jika ada pertanyaan:
1. Check Packagist docs: https://packagist.org/about
2. Read Composer docs: https://getcomposer.org/
3. Check GitHub discussions: https://github.com/bagastopati/form-builder/discussions

---

**Package siap untuk dipublish!** 🎉

Selamat! FormBuilder sudah siap untuk di-share ke Laravel community.
