<?php

namespace App\Http\Controllers;

use App\Models\PdfDetail;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin_panel');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'imageUpload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $path = $request->file('imageUpload')->store('banner', 'public');

        PdfDetail::create([
            'image_url' => $path,
            'approved_projects' => $request->approved_project,
            'pdf' => $request->pdf,
            'password' => $request->password,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success');
    }
}
