#!/usr/bin/env php
<?php
/**
 * JobPortal Health Check Script
 * Tests that all necessary files exist and PHP has no syntax errors
 */

echo "\n========== JobPortal Health Check ==========\n\n";

$files_to_check = [
    'login.php',
    'index.php',
    'client.php',
    'admin.php',
    'admin_view.php',
    'logout.php',
    'job.php',
    'assets/css/style.css',
    'assets/js/auth.js',
    'assets/js/data_sdk.js',
    'assets/js/element_sdk.js',
    'assets/js/app.js',
    'README.md',
    'INSTALL.md',
    '.gitignore',
];

$errors = 0;
$success_count = 0;

// Check if all files exist
echo "Checking files...\n";
foreach ($files_to_check as $file) {
    if (file_exists($file)) {
        echo "✓ $file\n";
        $success_count++;
    } else {
        echo "✗ $file (MISSING)\n";
        $errors++;
    }
}

echo "\n";

// Syntax check for PHP files
echo "Checking PHP syntax...\n";
$php_files = [
    'login.php',
    'index.php',
    'client.php',
    'admin.php',
    'admin_view.php',
    'logout.php',
    'job.php',
];

foreach ($php_files as $file) {
    if (file_exists($file)) {
        $output = [];
        $return = 0;
        exec("php -l " . escapeshellarg($file) . " 2>&1", $output, $return);
        if ($return === 0) {
            echo "✓ $file (syntax OK)\n";
        } else {
            echo "✗ $file (syntax error)\n";
            echo "  Error: " . implode("\n  ", $output) . "\n";
            $errors++;
        }
    }
}

echo "\n";

// Summary
echo "========== Results ==========\n";
echo "Files found: " . $success_count . "/" . count($files_to_check) . "\n";
echo "Errors: " . $errors . "\n";

if ($errors === 0) {
    echo "\n✓ All checks passed! Project is ready.\n\n";
    exit(0);
} else {
    echo "\n✗ Some checks failed. Please fix the errors above.\n\n";
    exit(1);
}
