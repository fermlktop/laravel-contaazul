<?php

if (version_compare(PHP_VERSION, '8.3.0', '<')) {
    throw new Exception('This script requires PHP 8.3.0 or higher');
}

function updateComposerVersion(string $newVersion): void {
    $composerFilePath = __DIR__ . '/composer.json';

    if (!file_exists($composerFilePath)) {
        throw new Exception('composer.json not found');
    }

    $composerJson = file_get_contents($composerFilePath);
    if ($composerJson === false) {
        throw new Exception('Failed to read composer.json');
    }

    $composerData = json_decode($composerJson, true, 512, JSON_THROW_ON_ERROR);
    $composerData['version'] = $newVersion;

    $newComposerJson = json_encode($composerData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    if ($newComposerJson === false) {
        throw new Exception('Failed to encode composer.json');
    }

    if (!file_put_contents($composerFilePath, $newComposerJson)) {
        throw new Exception('Failed to write composer.json');
    }
}

$newVersion = $argv[1] ?? null;
if (null === $newVersion) {
    throw new Exception('No version argument provided');
}

try {
    updateComposerVersion($newVersion);
    echo "composer.json version updated to {$newVersion}\n";
} catch (Exception $e) {
    echo "Error: {$e->getMessage()}\n";
    exit(1);
}
