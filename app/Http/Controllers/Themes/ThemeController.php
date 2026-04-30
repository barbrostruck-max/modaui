<?php

namespace App\Http\Controllers\Themes;

use App\Domains\Marketplace\Repositories\Contracts\ExtensionRepositoryInterface;
use App\Helpers\Classes\ThemeHelper;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\SettingTwo;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function __construct(
        public ExtensionRepositoryInterface $extensionRepository
    ) {}

    public function index()
    {
        $items = $this->extensionRepository->mergedInstalled(
            $this->extensionRepository->themes()
        );

        // Add local themes
        $localThemes = $this->getLocalThemes();
        $items = array_merge($items, $localThemes);

        // sort the result desc
        $extensions = Extension::query()
            ->where('is_theme', true)->orderBy('id', 'desc')->get();

        $paymentStatus = request('payment_status');

        return view('panel.admin.themes.index', compact('extensions', 'items', 'paymentStatus'));
    }

    private function getLocalThemes(): array
    {
        $themePath = base_path('MagicAI Extensions and Themes/themes');
        $themes = [];

        if (is_dir($themePath)) {
            $dirs = array_filter(scandir($themePath), function($dir) use ($themePath) {
                return is_dir($themePath . '/' . $dir) && !in_array($dir, ['.', '..']) && $dir !== 'Download More Templates.html';
            });

            foreach ($dirs as $dir) {
                $themeConfig = $this->getThemeConfig($themePath . '/' . $dir);
                if ($themeConfig) {
                    $themes[] = array_merge($themeConfig, [
                        'slug' => $dir,
                        'is_theme' => true,
                        'installed' => true,
                        'db_version' => null,
                        'upgradable' => false,
                        'only_show' => false,
                    ]);
                }
            }
        }

        return $themes;
    }

    private function getThemeConfig(string $themePath): ?array
    {
        $configFile = $themePath . '/theme.json';
        if (file_exists($configFile)) {
            $config = json_decode(file_get_contents($configFile), true);
            return $config;
        }

        // Fallback: create basic config
        $name = ucwords(str_replace(['-', '_'], ' ', basename($themePath)));
        return [
            'name' => $name,
            'description' => $name . ' theme',
            'version' => '1.0.0',
            'theme_type' => 'All',
            'icon' => null,
            'price' => 0,
        ];
    }

    public function buyTheme($slug)
    {
        $item = $this->extensionRepository->find($slug);

        return view('panel.admin.themes.buy', compact('item'));
    }

    public function themeActivate(Request $request, string $token)
    {
        $data = Helper::decodePaymentToken($token);

        $item = $this->extensionRepository->find($data['slug']);

    public function activate(Request $request, string $slug)
    {
        $type = $request->get('type', 'front'); // front or dash

        if ($type === 'front') {
            SettingTwo::updateOrCreate(
                ['name' => 'front_theme'],
                ['value' => $slug]
            );
        } else {
            SettingTwo::updateOrCreate(
                ['name' => 'dash_theme'],
                ['value' => $slug]
            );
        }

        return redirect()->back()->with('success', __('Theme activated successfully.'));
    }
}
