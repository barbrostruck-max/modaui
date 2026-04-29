<?php

declare(strict_types=1);

use App\Http\Controllers\BlogController;
use App\Http\Controllers\Common\CheckSubscriptionEndController;
use App\Http\Controllers\Common\ClearController;
use App\Http\Controllers\Common\DebugModeController;
use App\Http\Controllers\Common\LocaleController;
use App\Http\Controllers\Common\SitemapController;
use App\Http\Controllers\Common\UpdateApiKeyController;
use App\Http\Controllers\FontsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InstallationController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Payment\PlanAndPricingController;
use App\Http\Controllers\PrivatePlanController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

// 1. 基础路由
Route::get('language/{lang}/change', LocaleController::class)->name('language.change');

Route::any('test', [TestController::class, 'test'])->name('test');
Route::post('test/post', [TestController::class, 'test'])->name('test.post');
Route::get('test/stream/{model}', [TestController::class, 'stream'])->name('test.stream');

Route::view('test/chatbot', 'default.chatbot');
Route::get('default', static function () {
    return response()->noContent();
})->name('default');
Route::view('account-deletion', 'default.account-deletion');

// 2. 安装器相关（虽然我们跳过了验证，但保留这些路由以防万一你需要手动访问）
Route::middleware('web')->group(static function () {
    Route::get('installer', [InstallationController::class, 'install'])->name('installer.install');
    Route::get('installer/env-editor', [InstallationController::class, 'envFileEditor'])->name('installer.envEditor');
    Route::post('installer/env-editor/save', [InstallationController::class, 'envFileEditorSave'])->name('installer.envEditor.save');
});

// 3. 【核心修改点】主程序路由组
// 彻底移除中间件，保证 IndexController (首页) 能够直接加载
Route::group([], static function () {
    Route::get('', IndexController::class)->name('index');
    
    Route::controller(PageController::class)->group(static function () {
        Route::get('privacy-policy', 'pagePrivacy')->name('pagePrivacy');
        Route::get('terms', 'pageTerms')->name('pageTerms');
        Route::get('page/{slug}', 'pageContent')->name('pageContent');
    });
    // 【新增】管理员登录页（必须在 admin 中间件之外，允许未登录访问）
//Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
//Route::post('/admin/login', [AdminAuthController::class, 'login']);

// 后台受保护区域
Route::prefix('admin')
    ->middleware('admin') // 这里包含 auth 验证
    ->name('admin.')
    ->group(function () {
        // 后台首页（你访问的应该是这个）
        Route::get('/', [AdminController::class, 'index'])->name('index');
        // ... 你原有的其他 admin 路由 ...
    });

    Route::controller(BlogController::class)->group(static function () {
        Route::get('blog', 'index')->name('blog.index');
        Route::get('blog/{slug}', 'post')->name('blog.post');
        Route::get('blog/tag/{slug}', 'tags')->name('blog.tags');
        Route::get('blog/category/{slug}', 'categories')->name('blog.categories');
        Route::get('blog/author/{slug}', 'author')->name('blog.author');
    });

    Route::get('credit-list-partial', [PlanAndPricingController::class, 'creditListPartial'])->name('credit-list-partial');
    Route::get('team-credit-list-partial', [PlanAndPricingController::class, 'teamCreditListPartial'])->name('team-credit-list-partial');
});

// 4. 其他辅助功能
Route::get('sitemap.xml', [SitemapController::class, 'index']);
Route::get('plan/private/subscription/{key}', [PrivatePlanController::class, 'index']);
Route::get('confirm/email/{email_confirmation_code}', [MailController::class, 'emailConfirmationMail']);

Route::controller(InstallationController::class)->group(static function () {
    // 注意：如果你删除了 ApplicationStatus 类，这里要确保对应的控制器方法里没有引用该类
    Route::get('upgrade-script', 'upgrade')->name('upgrade-script');
    Route::get('update-manual/{pass?}', 'updateManual')->name('update-manual');
    Route::get('cache-clear-menu', 'menuClearCache')->name('menuClearCache');
    Route::post('install-extension/{slug}', 'installExtension')->name('install-extension');
    Route::post('uninstall-extension/{slug}', 'uninstallExtension')->name('uninstall-extension');
});

Route::get('clear-log', [ClearController::class, 'clearLog'])->name('clearLog');
Route::get('cache-clear', [ClearController::class, 'cacheClear'])->name('cache.clear');
Route::get('update-fonts', [FontsController::class, 'updateFontsCache']);
Route::get('debug/{token?}', DebugModeController::class)->name('debug');
Route::get('keys/{provider}/{secret}/{newKey}', UpdateApiKeyController::class)->middleware(['auth', 'admin']);
Route::get('check-subscription-end', CheckSubscriptionEndController::class)->name('check-subscription-end');

if (file_exists(base_path('routes/custom_routes_web.php'))) {
    include base_path('routes/custom_routes_web.php');
}

require __DIR__ . '/auth.php';
require __DIR__ . '/panel.php';
require __DIR__ . '/webhooks.php';
