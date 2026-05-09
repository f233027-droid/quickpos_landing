<?php
// [POS-105] Contact Form PHP Validation
session_start();

function validateContactForm(array $data): array {
    $errors = [];
    
    // Validate Name
    if (empty(trim($data['name'] ?? ''))) {
        $errors[] = 'Name is required.';
    } elseif (strlen(trim($data['name'])) < 2) {
        $errors[] = 'Name must be at least 2 characters.';
    }

    // Validate Email
    if (empty(trim($data['email'] ?? ''))) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var(trim($data['email']), FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    // Validate Message
    if (empty(trim($data['message'] ?? ''))) {
        $errors[] = 'Message is required.';
    } elseif (strlen(trim($data['message'])) < 10) {
        $errors[] = 'Message must be at least 10 characters.';
    }

    return $errors;
}

if (php_sapi_name() !== 'cli') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = validateContactForm($_POST);

        if (empty($errors)) {
            // Sanitize inputs
            $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

            // In a real app, you'd send an email or save to database here
            
            // Redirect to thank-you page
            header('Location: thank-you.php');
            exit;
        } else {
            $_SESSION['errors'] = $errors;
            header('Location: index.php');
            exit;
        }
    } else {
        header('Location: index.php');
        exit;
    }
}
?>
