<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Application;
class CabinetController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $active = Application::where('user_id', $userId)
            ->whereIn('status', ['новая', 'опубликована'])
            ->get();
        $archived = Application::where('user_id', $userId)
            ->whereIn('status', ['отклонена', 'удалена'])
            ->get();
        return view('cabinet', compact('active', 'archived'));
    }
    public function delete($id)
    {
        $app = Application::where('id', $id)
            ->where('user_id', auth()->id())
            ->whereIn('status', ['новая', 'опубликована'])
            ->firstOrFail();
        $app->status = 'удалена';
        $app->save();
        return back()->with('success', 'Карточка перемещена в архив.');
    }
}