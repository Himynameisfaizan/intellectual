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
            'imageUpload' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
            'approved_project' => 'required',
            'pdf' => 'required',
            'password' => 'required',
            'user_id' => 'required',
        ]);

        $path = null;

        if ($request->hasFile('imageUpload')) {
            $file = $request->file('imageUpload');

            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/banner';

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $filename);
            $path = 'banner/' . $filename;
        }

        PdfDetail::create([
            'image_url' => $path,
            'approved_projects' => $request->approved_project,
            'pdf' => $request->pdf,
            'password' => $request->password,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Data added successfully!');
    }
}
