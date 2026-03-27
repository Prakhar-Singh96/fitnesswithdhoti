<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IplTeam;
use App\Models\IplUserSelection;
use Illuminate\Http\Request;
use File;

class IPLAdminController extends Controller
{
    public function index() {
        $teams = IplTeam::all();
        return view('admin.ipl.index', compact('teams'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'coupon_code' => 'required',
            'logo' => 'required|image|max:1024'
        ]);

        $data = $request->all();
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/ipl'), $filename);
            $data['logo'] = 'uploads/ipl/' . $filename;
        }

        IplTeam::create($data);
        return back()->with('success', 'Team Added!');
    }

    public function declareWinner(Request $request) {
        // 1. पुराने विनर्स हटाओ
        IplUserSelection::where('is_winner', 1)->update(['is_winner' => 0]);

        // 2. नई टीम के कूपन 24 घंटे के लिए एक्टिव करो
        IplUserSelection::where('team_id', $request->team_id)->update([
            'is_winner' => 1,
            'coupon_activated_at' => now()
        ]);

        return back()->with('success', 'Winner Declared & Coupons Activated!');
    }

    public function destroy($id) {
        $team = IplTeam::findOrFail($id);
        if(File::exists(public_path($team->logo))) File::delete(public_path($team->logo));
        $team->delete();
        return back()->with('success', 'Team Deleted!');
    }
}
