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
        // Django: New_Project.objects.order_by('-id')
        $lastToOne = NewProject::orderBy('id', 'desc')->get();

        // Chunk logic for grouping (Django mein manually loop lagaya tha)
        $grouped = $lastToOne->chunk(3);

        // Django: Pdf_Detail.objects.order_by('-id')[5:] -> Logic thoda alag hai yaha
        // Assuming you want the latest 5 for slider/images
        $pdfLastToOne = PdfDetail::where('is_delete', 1)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // Image paths (Laravel Storage link use karega)
        $imagePaths = $pdfLastToOne->map(function ($item) {
            return asset('storage/' . $item->image_url);
        });

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
}
