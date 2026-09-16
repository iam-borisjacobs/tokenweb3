# 🚀 cPanel Automated Git Deployment Kit

A standardized, plug-and-play kit to deploy any new web project (Laravel, PHP, HTML/JS) from GitHub directly to cPanel in seconds—without FTP timeouts or hanging pipelines.

---

## 📦 1. The Core File: `.cpanel.yml`

Whenever you start any new project, place a file named `.cpanel.yml` in your project's **root directory** (alongside `composer.json` or `index.php`).

```yaml
---
deployment:
  tasks:
    - export DEPLOYPATH=/home/<CPANEL_USERNAME>/<DOMAIN_OR_SUBDOMAIN_FOLDER>/
    - /bin/cp -R * $DEPLOYPATH
```

### Real Example:
If your cPanel username is `maxihold` and the domain folder is `token.flutranglobal.com`:
```yaml
---
deployment:
  tasks:
    - export DEPLOYPATH=/home/maxihold/token.flutranglobal.com/
    - /bin/cp -R * $DEPLOYPATH
```

> [!TIP]
> **Why this protects your `.env` and database:**
> In Linux/bash, `/bin/cp -R *` copies all regular files and folders, but **ignores hidden files starting with a dot** (like `.env`). This guarantees your live database password and production secrets on cPanel will **never** be overwritten by Git updates.

---

## 🛡️ 2. The `.gitignore` Checklist

Before pushing any new project to GitHub, ensure your `.gitignore` includes:
```gitignore
.env
.env.*
node_modules/
vendor/
*.zip
*.log
storage/logs/*
```

---

## ⏱️ 3. One-Time Setup in cPanel (Takes 2 Minutes)

Whenever you launch a new project:

### Step A: Push to GitHub
Commit your project code (including `.cpanel.yml`) and push it to GitHub:
```bash
git add .
git commit -m "Initial commit with cPanel deployment config"
git push origin main
```

### Step B: Clone in cPanel
1. Log into your **cPanel** dashboard.
2. In the search bar, type **Git** and click **Git™ Version Control** (under *Files*).
3. Click the blue **Create** button.
4. Fill in:
   * **Clone a repository**: Toggle **ON**.
   * **Clone URL**: `https://github.com/your-username/your-repo.git`
   * **Repository Path**: `repositories/<project-name>` (e.g., `repositories/tokenweb3`)
   * **Repository Name**: `<project-name>` (e.g., `tokenweb3`)
5. Click **Create**.

### Step C: First Deploy
1. Click **Manage** next to the repository.
2. Go to the **Pull or Deploy** tab.
3. Click **Deploy HEAD Commit**.

---

## ⚡ 4. How to Deploy Future Updates (5 Seconds)

Whenever you push any updates from your local machine:
```bash
git add .
git commit -m "Updated features"
git push origin main
```

Then in cPanel:
1. Open **Git™ Version Control** -> **Manage**.
2. Click **Update from Remote** (fetches code in 1s).
3. Click **Deploy HEAD Commit** (deploys in 1s).

---

## 🤖 5. Optional: 100% Zero-Touch Auto-Deploy (Webhook)

If you don't even want to log into cPanel to click "Deploy":

1. In cPanel, under **Git™ Version Control** -> **Manage** -> **Pull or Deploy**, look for your repository's **Auto-Deploy Webhook URL**.
2. Go to your repository on **GitHub** -> **Settings** -> **Webhooks** -> **Add webhook**.
3. Paste the cPanel Webhook URL into **Payload URL**.
4. Set **Content type** to `application/json`.
5. Click **Add webhook**.

Now, every time you run `git push`, GitHub tells cPanel to pull and deploy automatically!
