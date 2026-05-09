# QuickPOS Landing Page

![CI/CD Pipeline](https://github.com/f233027-droid/quickpos_landing/actions/workflows/ci.yml/badge.svg)

## Project Overview
A professional landing page for the QuickPOS Point-of-Sale system.
Built with PHP as part of the Software Project Management course.

## Team
- **PM & QA**: f233027@cfd.nu.edu.pk
- **Tech Lead**: ahmadisonlyone@gmail.com

## Tech Stack
- PHP 8.x
- HTML5 / CSS3
- PHPUnit (testing)
- PHPStan (code quality)
- GitHub Actions (CI/CD)

## Running Locally
```bash
# Start PHP development server
php -S localhost:8000

# Run tests
./vendor/bin/phpunit tests/

# Run code quality check
./vendor/bin/phpstan analyse --level=5 index.php process_form.php
```

## CI/CD Pipeline
The pipeline runs automatically on every Pull Request to main and:
- Checks PHP syntax
- Runs PHPStan code analysis
- Executes all PHPUnit tests
- Validates commit message format (must include [POS-XXX])
- Uploads build artifacts

## Jira Project: POS
All tasks tracked in Jira under the QuickPOS project.

## Project Structure
- `/tests` - All PHPUnit test cases
- `/.github/workflows/ci.yml` - GitHub Actions pipeline
- `index.php` - Main landing page
- `process_form.php` - Form validation
- `thank-you.php` - Success redirect page
- `style.css` - All styling


