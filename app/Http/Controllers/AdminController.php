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
    // 1. Validation
    $request->validate([
        'imageUpload' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
        'approved_project' => 'required',
        'pdf' => 'required|file|mimes:pdf|max:20480', // PDF validation
        'password' => 'required',
        'user_id' => 'required',
    ]);

    // Variables initialize karo taaki error na aaye
    $path = null;
    $pdfpath = null;

    // 2. Image Upload Logic
    if ($request->hasFile('imageUpload')) {
        $file = $request->file('imageUpload');
        $filename = time() . '_' . $file->getClientOriginalName();
        
        // Laravel way to get public folder path
        $destinationPath = public_path('banner'); 

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $file->move($destinationPath, $filename);
        $path = 'banner/' . $filename;
    }

    // 3. PDF Upload Logic
    if ($request->hasFile('pdf')) {
        $pdffile = $request->file('pdf'); // Variable name is $pdffile
        $pdffilename = time() . '_' . $pdffile->getClientOriginalName();
        
        // Same destination or different folder (e.g., public/pdfs)
        $destinationPath = public_path('banner'); 

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // --- Galti Yahan Thi (Fixed) ---
        // Pehle tumne $file->move likha tha, jo galat tha.
        $pdffile->move($destinationPath, $pdffilename); 
        
        $pdfpath = 'banner/' . $pdffilename;
    }

    // 4. Save to Database
    PdfDetail::create([
        'image_url' => $path,
        'approved_projects' => $request->approved_project,
        'pdf' => $pdfpath, // Ab ye variable sahi value lega
        'password' => $request->password,
        'user_id' => $request->user_id,
    ]);

    return redirect()->back()->with('success', 'Data added successfully!');
}
}
