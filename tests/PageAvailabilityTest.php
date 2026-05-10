<?php
// [POS-14] Page availability and structure tests
use PHPUnit\Framework\TestCase;

class PageAvailabilityTest extends TestCase
{
    public function testIndexFileExists(): void
    {
        $this->assertFileExists(__DIR__ . '/../index.php', 'index.php must exist');
    }

    public function testContactProcessorExists(): void
    {
        $this->assertFileExists(__DIR__ . '/../process_form.php', 'process_form.php must exist');
    }

    public function testThankYouPageExists(): void
    {
        $this->assertFileExists(__DIR__ . '/../thank-you.php', 'thank-you.php must exist');
    }

    public function testIndexContainsRequiredSections(): void
    {
        $content = file_get_contents(__DIR__ . '/../index.php');
        $this->assertStringContainsString('id="features"', $content);
        $this->assertStringContainsString('id="pricing"', $content);
        $this->assertStringContainsString('id="contact"', $content);
    }

    public function testContactFormHasCorrectAction(): void
    {
        $content = file_get_contents(__DIR__ . '/../index.php');
        $this->assertStringContainsString('action="process_form.php"', $content);
        $this->assertStringContainsString('method="POST"', $content);
    }
}
