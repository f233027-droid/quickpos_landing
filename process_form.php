<?php
// [POS-12] Contact Form PHP Validation

function validateContactForm(array $data): array {
    $errors = [];

    // Bug fix: trim() prevents whitespace-only submissions
    if (empty(trim($data['name'] ?? ''))) {
        $errors[] = 'Name is required.';
    } elseif (strlen(trim($data['name'])) < 2) {
        $errors[] = 'Name must be at least 2 characters.';
    }

    if (empty(trim($data['email'] ?? ''))) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var(trim($data['email']), FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if (empty(trim($data['message'] ?? ''))) {
        $errors[] = 'Message is required.';
    } elseif (strlen(trim($data['message'])) < 10) {
        $errors[] = 'Message must be at least 10 characters.';
    }

    return $errors;
}

if (php_sapi_name() !== 'cli' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $errors = validateContactForm($_POST);

    if (empty($errors)) {
        $name    = htmlspecialchars(strip_tags(trim($_POST['name'])));
        $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $message = htmlspecialchars(strip_tags(trim($_POST['message'])));
        header('Location: thank-you.php');
        exit;
    } else {
        $_SESSION['errors'] = $errors;
        header('Location: index.php');
        exit;
    }
} elseif (php_sapi_name() !== 'cli') {
    header('Location: index.php');
    exit;
}
?>
