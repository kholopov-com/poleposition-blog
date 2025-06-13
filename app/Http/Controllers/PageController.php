<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Page;
class PageController extends Controller
{
    public function editAll()
    {
        $pages = Page::all()->keyBy('slug');
        return view('dashboard', compact('pages'));
    }
    public function updateAll(Request $request)
    {
        $contents = $request->input('pages', []);
        $titles = $request->input('titles', []);
        $checkboxes = $request->input('show_in_menu', []);

        foreach ($contents as $slug => $content) {
            $page = \App\Models\Page::where('slug', $slug)->first();
            if ($page) {
                $page->content = $content;
                $page->title = $titles[$slug] ?? '';
                $page->show_in_menu = isset($checkboxes[$slug]) ? 1 : 0;
                $page->save();
            }
        }
        return redirect()->route('dashboard')->with('success', 'Страницы обновлены.');
    }
    public function show()
    {
        $slug = request()->route()->getName();
        $page = \App\Models\Page::where('slug', $slug)->firstOrFail();
        return view('page', compact('page'));
    }
}