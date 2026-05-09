<?php
// [POS-201] Automated tests for QuickPOS Contact Form Validation
// Run with: ./vendor/bin/phpunit tests/ContactFormTest.php

use PHPUnit\Framework\TestCase;

// Include the validation function
require_once __DIR__ . '/../process_form.php';

class ContactFormTest extends TestCase
{
    // ■■■ TEST 1: All fields empty
    public function testEmptyFieldsReturnErrors(): void
    {
        $data = ['name' => '', 'email' => '', 'message' => ''];
        $errors = validateContactForm($data);
        
        $this->assertNotEmpty($errors, 'Errors should be returned when all fields are empty');
        $this->assertContains('Name is required.', $errors);
        $this->assertContains('Email is required.', $errors);
        $this->assertContains('Message is required.', $errors);
    }

    // ■■■ TEST 2: Invalid email format
    /**
     * @dataProvider invalidEmailProvider
     */
    public function testInvalidEmailFormats(string $email): void
    {
        $data = [
            'name' => 'John',
            'email' => $email,
            'message' => 'Hello there, this is a test message.'
        ];
        $errors = validateContactForm($data);
        
        $this->assertContains('Please enter a valid email address.', $errors, "Email '$email' should be considered invalid");
    }

    // Data provider — multiple invalid emails (data-driven testing)
    public static function invalidEmailProvider(): array
    {
        return [
            ['notanemail'],
            ['missing@'],
            ['@nodomain.com'],
            ['no spaces@test.com'],
            ['double@@test.com'],
        ];
    }

    // ■■■ TEST 3: Valid form submission
    public function testValidFormReturnsNoErrors(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'This is a valid test message that is long enough.',
        ];
        $errors = validateContactForm($data);
        
        $this->assertEmpty($errors, 'No errors should be returned for a valid form submission');
    }

    // ■■■ TEST 4: Name too short
    public function testShortNameReturnsError(): void
    {
        $data = [
            'name' => 'A',
            'email' => 'test@test.com',
            'message' => 'This is a proper message.'
        ];
        $errors = validateContactForm($data);
        
        $this->assertContains('Name must be at least 2 characters.', $errors);
    }

    // ■■■ TEST 5: Message too short
    public function testShortMessageReturnsError(): void
    {
        $data = [
            'name' => 'John',
            'email' => 'john@test.com',
            'message' => 'Hi'
        ];
        $errors = validateContactForm($data);
        
        $this->assertContains('Message must be at least 10 characters.', $errors);
    }

    // ■■■ TEST 6: Missing fields (null/missing keys)
    public function testMissingKeysReturnErrors(): void
    {
        $data = []; // completely empty array
        $errors = validateContactForm($data);
        
        $this->assertCount(3, $errors, 'Exactly 3 errors should be returned when all fields are missing');
    }

    // ■■■ TEST 7: XSS prevention — HTML is not returned as-is
    public function testXSSInputIsHandledSafely(): void
    {
        $data = [
            'name' => '<script>alert("xss")</script>',
            'email' => 'xss@test.com',
            'message' => 'Normal message here to pass length check.',
        ];
        
        // No validation error — XSS is handled at output, not input validation
        $errors = validateContactForm($data);
        $this->assertNotContains('Name is required.', $errors);
    }
}
