<?php

namespace modaui\Updater;

use App\Helpers\Classes\VersionComparator;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use modaui\Updater\Traits\HasBackup;
use modaui\Updater\Traits\HasDownloader;
use modaui\Updater\Traits\HasUpdater;
use modaui\Updater\Traits\HasVersionPrepare;
use modaui\Updater\Traits\HasVersionUpdate;
use modaui\Updater\Traits\HasZipper;

class Updater
{
    use HasBackup;
    use HasDownloader;
    use HasUpdater;
    use HasVersionPrepare;
    use HasVersionUpdate;
    use HasZipper;

    public function __construct()
    {
        $this->prepareVersion();
    }

    public function versionCheck(): bool|int
    {
        $modauiVersion = Cache::remember('modaui_next_version_cache', 60 * 10, function () {
            return $this->nextVersion;
        });

        if (! $modauiVersion) {
            $versions = $this->prepareVersion();

            $modauiVersion = $versions['version'];
        }

        $currentmodauiVersion = $this->currentmodauiVersion();

        return VersionComparator::compareVersion($modauiVersion, $currentmodauiVersion, '=');
    }

    public function backupView(): array
    {
        $modauiVersion = $this->nextVersion;

        $currentmodauiVersion = $this->currentmodauiVersion();

        if (VersionComparator::compareVersion($modauiVersion, $currentmodauiVersion, '=')) {
            return [
                'updated' => true,
            ];
        }

        return [
            'updated' => false,
            'title'   => trans('modaui installed successfully'),
            'version' => $this->nextVersion,
            'view'    => 'modaui-updater::particles.backup',
            'step'    => 4,
        ];
    }

    public function downloadView(): array
    {
        $modauiVersion = $this->nextVersion;

        $currentmodauiVersion = $this->currentmodauiVersion();

        if (VersionComparator::compareVersion($modauiVersion, $currentmodauiVersion, '=')) {
            return [
                'updated' => true,
            ];
        }

        return [
            'updated'    => false,
            'title'      => trans('modaui installed successfully'),
            'version'    => $modauiVersion,
            'isDownload' => $modauiVersion === $this->getDownloadVersion(),
            'view'       => 'modaui-updater::particles.download',
            'step'       => 4,
        ];
    }

    public function checker(): array
    {
        $updaterVersion = $this->newUpdaterVersion();

        $currentUpdater = $this->currentUpdater();

        $modauiVersion = $this->nextVersion;

        $currentmodauiVersion = $this->currentmodauiVersion();

        if (VersionComparator::compareVersion($modauiVersion, $currentmodauiVersion, '=')) {
            Cache::forget('modaui_next_version_cache');

            return [
                'title'   => trans('modaui installed successfully'),
                'version' => $modauiVersion,
                'view'    => 'modaui-updater::particles.updated',
            ];
        }

        if ($updaterVersion && VersionComparator::compareVersion($updaterVersion, $currentUpdater['version'], '=')) {

            Cache::forget('modaui_next_version_cache');

            return [
                'title'           => trans('modaui is ready to update'),
                'updater'         => $this->currentUpdater(),
                'version'         => $modauiVersion,
                'updater_version' => $this->json('updater_version'),
                'view'            => 'modaui-updater::particles.update',
                'step'            => 2,
            ];
        }

        return [
            'title'           => trans('modaui is ready to download check for updates'),
            'version'         => $modauiVersion,
            'updater_version' => $this->json('updater_version'),
            'view'            => 'modaui-updater::particles.updater',
            'step'            => 1,
        ];
    }

    public function forPanel(): array
    {
        return $this->prepareVersion();
    }

    public function currentmodauiVersion(): false|string
    {
        $this->currentmodauiVersion = trim(File::get(base_path('version.txt')));

        return $this->currentmodauiVersion;
    }

    public function json(string $key): null|string|array
    {
        return $this->versionRequest()->json($key);
    }

    public function versionRequest(): Response
    {
        return once(static function () {
            return Http::get(config('modaui-updater.version_url'));
        });
    }
}
