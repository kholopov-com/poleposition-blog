<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class DashboardApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with('user')->orderBy('id', 'desc')->get();
        return view('dashboardapplications', compact('applications'));
    }

    public function approve($id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'опубликована';
        $application->rejection_reason = null;
        $application->save();

        return back()->with('success', 'Карточка опубликована.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|min:3',
        ]);

        $application = Application::findOrFail($id);
        $application->status = 'отклонена';
        $application->rejection_reason = $request->reason;
        $application->save();

        return back()->with('success', 'Карточка отклонена.');
    }
}
