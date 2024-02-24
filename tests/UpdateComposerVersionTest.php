<?php

use PHPUnit\Framework\TestCase;

class UpdateComposerVersionTest extends TestCase
{
    protected $backupComposerJson;

    protected function setUp(): void
    {
        // Faz backup do composer.json existente
        if (file_exists(__DIR__ . '/../composer.json')) {
            $this->backupComposerJson = file_get_contents(__DIR__ . '/../composer.json');
        }
        // Cria um composer.json de teste
        file_put_contents(__DIR__ . '/../composer.json', json_encode(['version' => '0.1.0']));
    }

    protected function tearDown(): void
    {
        // Restaura o composer.json original
        if ($this->backupComposerJson !== null) {
            file_put_contents(__DIR__ . '/../composer.json', $this->backupComposerJson);
        }
    }

    public function testUpdateVersion()
    {
        $newVersion = '0.2.0';
        exec("php " . __DIR__ . "/../scripts/update-composer-version.php $newVersion");

        $composerJson = json_decode(file_get_contents(__DIR__ . '/../composer.json'), true);
        $this->assertEquals($newVersion, $composerJson['version']);
    }
}
