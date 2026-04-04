<?php
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username == 'admin' && $password == 'admin') {
        $success = 'Welcome back, <strong>admin</strong>! Redirecting...';
    } else {
        $error = 'Invalid username or password. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SecureApp — Login</title>

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
  />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
  />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap"
    rel="stylesheet"
  />

  <style>
    :root {
      --brand-accent: #00e5a0;
      --brand-accent-dim: rgba(0, 229, 160, 0.12);
      --brand-accent-glow: rgba(0, 229, 160, 0.25);
      --card-bg: #0f1923;
      --card-border: rgba(255, 255, 255, 0.07);
      --input-bg: #0a1118;
      --input-border: rgba(255, 255, 255, 0.1);
      --input-focus-border: var(--brand-accent);
      --text-muted-custom: #6b7d8e;
    }

    * { box-sizing: border-box; }

    body {
      font-family: 'DM Sans', sans-serif;
      min-height: 100vh;
      background-color: #060d14;
      background-image:
        radial-gradient(ellipse 80% 50% at 50% -10%, rgba(0, 229, 160, 0.08) 0%, transparent 60%),
        repeating-linear-gradient(
          0deg,
          transparent,
          transparent 39px,
          rgba(255,255,255,0.018) 39px,
          rgba(255,255,255,0.018) 40px
        ),
        repeating-linear-gradient(
          90deg,
          transparent,
          transparent 39px,
          rgba(255,255,255,0.018) 39px,
          rgba(255,255,255,0.018) 40px
        );
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1rem;
    }

    .login-wrapper {
      width: 100%;
      max-width: 440px;
    }

    /* ── Brand header ── */
    .brand-header {
      text-align: center;
      margin-bottom: 2.5rem;
    }

    .brand-icon {
      width: 56px;
      height: 56px;
      background: var(--brand-accent-dim);
      border: 1px solid var(--brand-accent-glow);
      border-radius: 16px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.25rem;
      font-size: 1.6rem;
      color: var(--brand-accent);
    }

    .brand-title {
      font-family: 'Space Mono', monospace;
      font-size: 1.35rem;
      font-weight: 700;
      letter-spacing: -0.02em;
      color: #e8f0f7;
      margin: 0 0 0.3rem;
    }

    .brand-title span {
      color: var(--brand-accent);
    }

    .brand-subtitle {
      font-size: 0.875rem;
      color: var(--text-muted-custom);
      margin: 0;
    }

    /* ── Card ── */
    .login-card {
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      border-radius: 20px;
      padding: 2.25rem 2.5rem;
      position: relative;
      overflow: hidden;
    }

    .login-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--brand-accent), transparent);
      opacity: 0.7;
    }

    /* ── Section label ── */
    .section-label {
      font-family: 'Space Mono', monospace;
      font-size: 0.7rem;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--brand-accent);
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .section-label::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--card-border);
    }

    /* ── Form labels ── */
    .form-label {
      font-size: 0.8rem;
      font-weight: 500;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      color: var(--text-muted-custom);
      margin-bottom: 0.5rem;
    }

    /* ── Inputs ── */
    .input-group-custom {
      position: relative;
      margin-bottom: 1.25rem;
    }

    .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-muted-custom);
      font-size: 1rem;
      pointer-events: none;
      z-index: 2;
      transition: color 0.2s;
    }

    .form-control-custom {
      width: 100%;
      background: var(--input-bg) !important;
      border: 1px solid var(--input-border) !important;
      border-radius: 10px !important;
      color: #e8f0f7 !important;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.925rem;
      padding: 0.75rem 0.875rem 0.75rem 2.75rem !important;
      transition: border-color 0.2s, box-shadow 0.2s;
      outline: none;
    }

    .form-control-custom::placeholder {
      color: #3a4d5e;
    }

    .form-control-custom:focus {
      border-color: var(--brand-accent) !important;
      box-shadow: 0 0 0 3px var(--brand-accent-glow) !important;
    }

    .form-control-custom:focus + .input-icon,
    .input-group-custom:focus-within .input-icon {
      color: var(--brand-accent);
    }

    /* password toggle */
    .pw-toggle {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--text-muted-custom);
      cursor: pointer;
      padding: 0;
      font-size: 1rem;
      z-index: 2;
      transition: color 0.2s;
    }

    .pw-toggle:hover { color: #e8f0f7; }

    /* ── Remember / forgot ── */
    .form-check-input {
      background-color: var(--input-bg) !important;
      border-color: var(--input-border) !important;
      border-radius: 4px !important;
    }

    .form-check-input:checked {
      background-color: var(--brand-accent) !important;
      border-color: var(--brand-accent) !important;
    }

    .form-check-label {
      font-size: 0.85rem;
      color: var(--text-muted-custom);
    }

    .forgot-link {
      font-size: 0.85rem;
      color: var(--text-muted-custom);
      text-decoration: none;
      transition: color 0.2s;
    }

    .forgot-link:hover { color: var(--brand-accent); }

    /* ── Submit button ── */
    .btn-login {
      width: 100%;
      background: var(--brand-accent) !important;
      border: none !important;
      border-radius: 10px !important;
      color: #060d14 !important;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.925rem;
      font-weight: 600 !important;
      letter-spacing: 0.03em;
      padding: 0.8rem !important;
      transition: opacity 0.2s, transform 0.15s;
      margin-top: 0.5rem;
    }

    .btn-login:hover {
      opacity: 0.88;
      transform: translateY(-1px);
    }

    .btn-login:active {
      transform: translateY(0);
      opacity: 1;
    }

    /* ── Alerts ── */
    .alert-custom {
      border-radius: 10px;
      font-size: 0.875rem;
      padding: 0.75rem 1rem;
      margin-bottom: 1.25rem;
      border: 1px solid;
      display: flex;
      align-items: flex-start;
      gap: 0.6rem;
    }

    .alert-danger-custom {
      background: rgba(220, 53, 69, 0.1);
      border-color: rgba(220, 53, 69, 0.3);
      color: #f5a0a8;
    }

    .alert-success-custom {
      background: rgba(0, 229, 160, 0.08);
      border-color: rgba(0, 229, 160, 0.3);
      color: #7dffd6;
    }

    /* ── Divider ── */
    .divider {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin: 1.5rem 0;
      color: var(--text-muted-custom);
      font-size: 0.8rem;
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--card-border);
    }

    /* ── Footer ── */
    .login-footer {
      text-align: center;
      margin-top: 1.75rem;
      font-size: 0.8rem;
      color: var(--text-muted-custom);
    }

    .login-footer a {
      color: var(--brand-accent);
      text-decoration: none;
    }

    .status-dot {
      display: inline-block;
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: var(--brand-accent);
      margin-right: 6px;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.3; }
    }
  </style>
</head>
<body>

<div class="login-wrapper">

  <!-- Brand -->
  <div class="brand-header">
    <div class="brand-icon">
      <i class="bi bi-shield-lock-fill"></i>
    </div>
    <h1 class="brand-title">Secure<span>App</span></h1>
    <p class="brand-subtitle">DevSecOps — DVWA Lab Environment</p>
  </div>

  <!-- Card -->
  <div class="login-card">

    <div class="section-label">
      <span class="status-dot"></span>
      Authentication
    </div>

    <!-- Alerts -->
    <?php if ($error): ?>
    <div class="alert-custom alert-danger-custom" role="alert">
      <i class="bi bi-exclamation-triangle-fill mt-1"></i>
      <span><?= htmlspecialchars($error) ?></span>
    </div>
    <?php endif; ?>

    <?php if ($success): ?>
    <div class="alert-custom alert-success-custom" role="alert">
      <i class="bi bi-check-circle-fill mt-1"></i>
      <span><?= $success ?></span>
    </div>
    <?php endif; ?>

    <!-- Form -->
    <form method="POST" novalidate>

      <!-- Username -->
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <div class="input-group-custom">
          <input
            type="text"
            id="username"
            name="username"
            class="form-control-custom"
            placeholder="Enter your username"
            value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
            autocomplete="username"
            required
          />
          <i class="bi bi-person input-icon"></i>
        </div>
      </div>

      <!-- Password -->
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group-custom">
          <input
            type="password"
            id="password"
            name="password"
            class="form-control-custom"
            placeholder="Enter your password"
            autocomplete="current-password"
            required
          />
          <i class="bi bi-lock input-icon"></i>
          <button type="button" class="pw-toggle" id="pwToggle" aria-label="Toggle password">
            <i class="bi bi-eye" id="pwIcon"></i>
          </button>
        </div>
      </div>

      <!-- Remember + Forgot -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="remember" name="remember" />
          <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <a href="#" class="forgot-link">Forgot password?</a>
      </div>

      <!-- Submit -->
      <button type="submit" class="btn btn-login">
        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
      </button>

    </form>

    <div class="divider">or</div>

    <!-- Hint for demo -->
    <div class="text-center">
      <small style="color: var(--text-muted-custom); font-size: 0.78rem;">
        <i class="bi bi-info-circle me-1"></i>
        Demo credentials: <code style="color: var(--brand-accent); font-family: 'Space Mono', monospace;">admin</code>
        /
        <code style="color: var(--brand-accent); font-family: 'Space Mono', monospace;">admin</code>
      </small>
    </div>

  </div>

  <!-- Footer -->
  <div class="login-footer">
    <i class="bi bi-shield-check me-1"></i>
    Protected by <a href="#">SecureApp DevSecOps</a> pipeline &mdash; <?= date('Y') ?>
  </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const toggle = document.getElementById('pwToggle');
  const pwInput = document.getElementById('password');
  const pwIcon = document.getElementById('pwIcon');

  toggle.addEventListener('click', () => {
    const isPassword = pwInput.type === 'password';
    pwInput.type = isPassword ? 'text' : 'password';
    pwIcon.className = isPassword ? 'bi bi-eye-slash' : 'bi bi-eye';
  });
</script>

</body>
</html>