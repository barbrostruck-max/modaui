<?php

namespace modaui\Updater\Traits;

use App\Helpers\Classes\VersionComparator;

trait HasVersionPrepare
{
    public bool|string $currentmodauiVersion = '';

    public string $nextVersion = '';

    public string $latestVersion = '';

    public string $versionZipFile = '';

    public function prepareVersion(): array
    {
        $lastVersion = $this->versionRequest()->json() ?: [];

        $currentmodauiVersion = floatval($this->currentmodauiVersion());

        $description = $lastVersion['description'] ?? [];

        $versions = $this->versions($description);

        $this->nextVersion = $this->setNextVersion($versions, $currentmodauiVersion);

        $this->latestVersion = $this->setLatestVersion($versions, $currentmodauiVersion);

        $this->setZipFile();

        if (VersionComparator::compareVersion($this->nextVersion, $currentmodauiVersion, '>')) {
            $lastVersion['update'] = 'yes'; // Trigger the new version available.
            $lastVersion['version'] = $this->nextVersion;
            $lastVersion['latest_version'] = format_double($this->latestVersion);
            $lastVersion['version_format'] = format_double($this->nextVersion);
            $lastVersion['archive'] = $this->versionZipFile;
            $lastVersion['current_version'] = format_double($currentmodauiVersion);
        }

        return $lastVersion;
    }

    public function setZipFile(): string
    {
        $this->versionZipFile = 'modaui_' . $this->nextVersion . '.zip';

        return $this->versionZipFile;
    }

    public function setNextVersion(array $versions, string $currentmodauiVersion): string
    {
        $versions = array_reverse($versions); // 5.3, 5.31, 5.4, 5.41

        foreach ($versions as $version) {
            if ($version > $currentmodauiVersion) {
                return number_format($version, 2, '.');
            }
        }

        return '';
    }

    public function setLatestVersion(array $versions, string $currentmodauiVersion): string
    {
        $versions = array_reverse($versions); // 5.3, 5.31, 5.4, 5.41

        $latestVersion = end($versions);

        if ($latestVersion > $currentmodauiVersion) {
            return number_format($latestVersion, 2, '.');
        }

        return '';
    }

    public function versions(array $array = []): array
    {
        $versionList = array_map(function ($key) {
            return trim(explode('-', $key)[0]);
        }, array_keys($array));

        $formatted = array_map(function ($version) {
            $parts = explode('.', $version);
            if (count($parts) === 3) {
                return (float) ($parts[0] . '.' . $parts[1] . $parts[2]);
            }
            if (count($parts) === 2) {
                return (float) ($parts[0] . '.' . $parts[1]);
            }

            return (float) ($parts[0]);
        }, $versionList);

        return $formatted;
    }
}
