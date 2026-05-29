# Quick Packagist Upload Summary

**Untuk langsung upload ke Packagist, ikuti 5 langkah ini:**

## 1️⃣ Push ke GitHub

```bash
# Jika belum ada remote
git remote add origin https://github.com/bagastopati/form-builder.git
git branch -M main

# Push ke GitHub
git push -u origin main
git push -u origin --tags
```

**Repository harus PUBLIC!**

## 2️⃣ Create GitHub Personal Access Token

1. Go to: https://github.com/settings/tokens
2. Click "Generate new token (classic)"
3. Select scope: `public_repo`
4. Generate dan copy token

## 3️⃣ Register di Packagist

1. Go to: https://packagist.org/
2. Sign Up atau Login dengan GitHub
3. Complete profile

## 4️⃣ Submit Package

1. Go to: https://packagist.org/packages/submit
2. Enter repository URL:
   ```
   https://github.com/bagastopati/form-builder.git
   ```
3. Click "Check"
4. Click "Submit"

Package akan appear di:
```
https://packagist.org/packages/bagastopati/form-builder
```

## 5️⃣ Setup Auto-Update (Optional tapi Recommended)

**Setup GitHub Webhook:**

1. Go ke GitHub repository settings
2. Webhooks → Add webhook
3. Payload URL: `https://packagist.org/api/github`
4. Content type: `application/json`
5. Check "Push events"
6. Add webhook

**Selesai!** Package akan auto-update di Packagist saat ada push baru.

## ✅ Verifikasi Installation

```bash
# Test di folder lain
composer require bagastopati/form-builder
```

## 📚 Reference

- **Full Guide**: Lihat `PACKAGIST_GUIDE.md`
- **Packagist**: https://packagist.org/
- **Package Page**: https://packagist.org/packages/bagastopati/form-builder

---

**That's it!** 🎉 Package Anda sudah publish dan siap digunakan developers di seluruh dunia.
