<?php

namespace App\Http\Controllers;

use App\Models\NewProject;
use App\Models\PdfDetail;
use App\Models\UserData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    // 1. Projects ki list (Django logic same)
    $lastToOne = NewProject::orderBy('id', 'desc')->get();
    $grouped = $lastToOne->chunk(3);

    // 2. Slider ka Data fetch karo
    $pdfLastToOne = PdfDetail::where('is_delete', 1)
        ->orderBy('id', 'desc')
        ->take(5)
        ->get();

    // 3. MAIN LOGIC CHANGE YAHAN HAI:
    $imagePaths = $pdfLastToOne
        // Step A: Pehle check karo ki image_url khali to nahi hai?
        ->filter(function ($item) {
            return !empty($item->image_url); 
        })
        // Step B: Ab bache hue items ka URL banao
        ->map(function ($item) {
            // Agar path already full URL hai to asset mat lagao (Safety check)
            if (filter_var($item->image_url, FILTER_VALIDATE_URL)) {
                return $item->image_url;
            }
            return asset($item->image_url);
        })
        // Step C: Array ki ginti (keys) reset karo (Zaroori hai slider ke liye)
        ->values(); 

    return view('home.index', compact('imagePaths', 'grouped', 'pdfLastToOne'));
}

    public function about()
    {
        return view('home.about');
    }

    public function certificate()
    {
        // Using Raw SQL for Modulo operator like in Django
        $oddRows = PdfDetail::whereRaw('id % 2 = 1')
            ->where('is_delete', 1)
            ->whereNotNull('pdf')
            ->get(['id', 'approved_projects']);

        $evenRows = PdfDetail::whereRaw('id % 2 = 0')
            ->where('is_delete', 1)
            ->whereNotNull('pdf')
            ->get(['id', 'approved_projects']);

        // Data formatting logic
        $oddName = [];
        $sno = 1;
        foreach ($oddRows as $row) {
            $oddName[] = ['sno' => $sno++, 'id' => $row->id, 'approved_projects' => $row->approved_projects];
        }

        $evenName = [];
        // Sno continues from odd count
        $sno = count($oddName) + 1;
        foreach ($evenRows as $row) {
            $evenName[] = ['sno' => $sno++, 'id' => $row->id, 'approved_projects' => $row->approved_projects];
        }

        return view('home.certificate', compact('oddName', 'evenName'));
    }

    public function checkUserId(Request $request)
    {
        $userId = $request->input('user_id');

        if (PdfDetail::where('user_id', $userId)->exists()) {

            // Save User Data
            try {
                UserData::create([
                    'user_id' => $userId,
                    'user_name' => $request->input('name'),
                    'phone_no' => $request->input('phone'),
                ]);
            } catch (\Exception $e) {
                // Ignore if duplicate phone/user mainly
            }

            return response()->json([
                "status" => "success",
                "message" => "User ID valid hai",
                "download_url" => route('download_pdf', ['user_id' => $userId])
            ]);
        } else {
            return response()->json(["status" => "error", "message" => "Enter valid User Id"]);
        }
    }

    public function downloadPdf($userId)
    {
        $pdfDetail = PdfDetail::where('user_id', $userId)->first();

        if (!$pdfDetail || !Storage::exists('public/' . $pdfDetail->pdf)) {
            return response("Invalid User ID or File Missing", 404);
        }

        $filePath = storage_path('app/public/' . $pdfDetail->pdf);
        $password = $pdfDetail->password;

        // NOTE: PHP native libraries like FPDF/FPDI cannot easily ENCRYPT existing PDFs 
        // without paid addons or complex workarounds like TCPDF.
        // For now, I am serving the file directly. 
        // Agar encryption compulsory hai, toh humein 'tecnickcom/tcpdf' use karna padega.

        return response()->download($filePath, $pdfDetail->approved_projects . '.pdf');
    }

    public function test(){
        return view('home.test');
    }

    public function pdf(){
        return view('home.pdf');
    }
}
