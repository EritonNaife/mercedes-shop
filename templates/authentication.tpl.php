<?php
// Template for rendering authentication forms (login and registration) for Mercedes Shop

// Renders the container for login and registration forms
function drawAccountContainer($title, $description, $content) {
    ob_start(); ?>
    <section class="account-container">
        <div class="account-header">
            <h1><?= htmlspecialchars($title) ?></h1>
            <p><?= htmlspecialchars($description) ?></p>
        </div>
        <div class="account-box">
            <?= $content ?>
        </div>
    </section>
    <?php return ob_get_clean();
}

function drawRegisterForm($error = null , $success = null) {
    ob_start(); ?>
    <form class="register-form" action="/actions/action_register.php" method="POST">
        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success-message"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn-primary">Create Account</button>
    </form>
    <p class="login-prompt">Already have an account? <a href="/pages/login.php">Sign in</a></p>
    <script src="/js/register.js"></script>
    <?php return ob_get_clean();
}

function drawLoginForm() {
    ob_start(); ?>
    <form class="login-form" action="/actions/action_login.php" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <a href="/account/forgot-password" class="forgot-password">Forgot password?</a>
        </div>
        <div class="form-group remember-me">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn-primary">Sign In</button>
    </form>
    <p class="signup-prompt">Don't have an account? <a href="/pages/register.php">Sign up</a></p>
    <?php return ob_get_clean();
}
?>