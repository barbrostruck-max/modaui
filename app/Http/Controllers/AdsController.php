<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function index(Request $request)
    {
        $data = Ad::paginate(25);

        return view('panel.admin.adsense.index', compact('data'));
    }

    public function store(Request $request)
    {
        // 修正点：直接使用传入的 $request 对象进行验证，更安全、更符合规范
        $request->validate([
            'code' => 'required',
        ]);

        $new_ad = new Ad;
        $new_ad->code = $request->input('code');
        // 修正点：使用 $request->has('status') 判断勾选框
        $new_ad->status = $request->has('status') ? 1 : 0;
        $new_ad->save();

        return redirect()
            ->route('dashboard.admin.ads.index')
            ->with(['message' => __('Ad created successfully.'), 'type' => 'success']);
    }

    public function edit(Ad $id)
    {
        // 注意：Laravel 默认通常用 $ad 而不是 $id 来做模型绑定，但保持你现在的逻辑也可以运行
        return view('panel.admin.adsense.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // 修正点：同上，使用 $request 替代 request()?->
        $request->validate([
            'code' => 'required',
        ]);

        $ads = Ad::where('id', $id)->firstOrFail();
        $ads->code = $request->input('code');
        $ads->status = $request->has('status') ? 1 : 0;
        $ads->save();

        return redirect()
            ->route('dashboard.admin.ads.index')
            ->with(['message' => __('Ad updated successfully.'), 'type' => 'success']);
    }

    public function destroy($id)
    {
        $ads = Ad::where('id', $id)->firstOrFail();
        $ads->delete();

        return redirect()
            ->route('dashboard.admin.ads.index')
            ->with(['message' => __('Ad deleted successfully.'), 'type' => 'success']);
    }
}