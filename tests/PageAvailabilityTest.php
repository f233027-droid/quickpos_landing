<?php
// [POS-14] Page availability and structure tests
use PHPUnit\Framework\TestCase;

class PageAvailabilityTest extends TestCase
{
    // TEST 1: index.php file exists
    public function testIndexFileExists(): void
    {
        $this->assertFileExists(
            __DIR__ . '/../index.php',
            'index.php must exist'
        );
    }

    // TEST 2: process_form.php file exists
    public function testContactProcessorExists(): void
    {
        $this->assertFileExists(
            __DIR__ . '/../process_form.php',
            'process_form.php must exist'
        );
    }

    // TEST 3: thank-you.php file exists
    public function testThankYouPageExists(): void
    {
        $this->assertFileExists(
            __DIR__ . '/../thank-you.php',
            'thank-you.php must exist'
        );
    }

    // TEST 4: index.php contains all required sections
    public function testIndexContainsRequiredSections(): void
    {
        $content = file_get_contents(__DIR__ . '/../index.php');
        $this->assertStringContainsString('id="features"', $content);
        $this->assertStringContainsString('id="pricing"', $content);
        $this->assertStringContainsString('id="contact"', $content);
    }

    // TEST 5: Contact form has correct action and method
    public function testContactFormHasCorrectAction(): void
    {
        $content = file_get_contents(__DIR__ . '/../index.php');
        $this->assertStringContainsString('action="process_form.php"', $content);
        $this->assertStringContainsString('method="POST"', $content);
    }
}
