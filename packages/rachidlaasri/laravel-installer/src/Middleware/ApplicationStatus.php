<?php

namespace App\Http;

use Closure;
// 必须引用这个接口，因为你的原始逻辑需要它
use RachidLaasri\LaravelInstaller\Repositories\ApplicationStatusRepositoryInterface;

class ApplicationStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 这里的逻辑是调用安装程序的接口来判断网站是否已经安装
        return app(ApplicationStatusRepositoryInterface::class)->next($request, $next);
    }
}