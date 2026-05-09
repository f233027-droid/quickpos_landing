<?php
// [POS-14] Automated Test Suite - QuickPOS Contact Form
// Run: /c/php/php vendor/bin/phpunit tests/

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../process_form.php';

class ContactFormTest extends TestCase
{
    // TEST 1: All fields empty
    public function testEmptyFieldsReturnErrors(): void
    {
        $data = ['name' => '', 'email' => '', 'message' => ''];
        $errors = validateContactForm($data);

        $this->assertNotEmpty($errors);
        $this->assertContains('Name is required.', $errors);
        $this->assertContains('Email is required.', $errors);
        $this->assertContains('Message is required.', $errors);
        $this->assertCount(3, $errors);
    }

    // TEST 2: Invalid email formats - data driven
    /**
     * @dataProvider invalidEmailProvider
     */
    public function testInvalidEmailFormats(string $email): void
    {
        $data = [
            'name'    => 'John Doe',
            'email'   => $email,
            'message' => 'This is a valid test message here.'
        ];
        $errors = validateContactForm($data);
        $this->assertContains('Please enter a valid email address.', $errors);
    }

    public static function invalidEmailProvider(): array
    {
        return [
            'no-at-sign'     => ['notanemail'],
            'missing-domain' => ['user@'],
            'no-local-part'  => ['@domain.com'],
            'double-at'      => ['user@@domain.com'],
            'spaces'         => ['user name@domain.com'],
        ];
    }

    // TEST 3: Valid form returns no errors
    public function testValidFormReturnsNoErrors(): void
    {
        $data = [
            'name'    => 'John Doe',
            'email'   => 'john@example.com',
            'message' => 'This is a perfectly valid message.'
        ];
        $errors = validateContactForm($data);
        $this->assertEmpty($errors);
    }

    // TEST 4: Name too short
    public function testShortNameReturnsError(): void
    {
        $data = [
            'name'    => 'A',
            'email'   => 'test@example.com',
            'message' => 'This is a valid message for testing.'
        ];
        $errors = validateContactForm($data);
        $this->assertContains('Name must be at least 2 characters.', $errors);
    }

    // TEST 5: Message too short
    public function testShortMessageReturnsError(): void
    {
        $data = [
            'name'    => 'John',
            'email'   => 'john@example.com',
            'message' => 'Hi'
        ];
        $errors = validateContactForm($data);
        $this->assertContains('Message must be at least 10 characters.', $errors);
    }

    // TEST 6: Completely empty array
    public function testMissingKeysReturnThreeErrors(): void
    {
        $errors = validateContactForm([]);
        $this->assertCount(3, $errors);
    }

    // TEST 7: Whitespace only name
    public function testWhitespaceNameFails(): void
    {
        $data = [
            'name'    => '     ',
            'email'   => 'test@example.com',
            'message' => 'This is a valid message here.'
        ];
        $errors = validateContactForm($data);
        $this->assertContains('Name is required.', $errors);
    }
}
