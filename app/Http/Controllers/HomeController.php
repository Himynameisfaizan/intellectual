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
        $lastToOne = NewProject::orderBy('id', 'desc')->get();
        $grouped = $lastToOne->chunk(3);

        $pdfLastToOne = PdfDetail::where('is_delete', 1)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        $imagePaths = $pdfLastToOne
            ->filter(function ($item) {
                return !empty($item->image_url);
            })
            ->map(function ($item) {
                if (filter_var($item->image_url, FILTER_VALIDATE_URL)) {
                    return $item->image_url;
                }
                return asset($item->image_url);
            })
            ->values();

        return view('home.index', compact('imagePaths', 'grouped', 'pdfLastToOne'));
    }

    public function about()
    {
        return view('home.about');
    }

    public function checkUserId(Request $request)
    {
        $userId = $request->input('user_id');

        if (PdfDetail::where('user_id', $userId)->exists()) {

            try {
                UserData::create([
                    'user_id' => $userId,
                    'user_name' => $request->input('name'),
                    'phone_no' => $request->input('phone'),
                ]);
            } catch (\Exception $e) {
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
        return response()->download($filePath, $pdfDetail->approved_projects . '.pdf');
    }

    public function certificate()
    {
        $oddRows = PdfDetail::whereRaw('id % 2 = 1')
            ->where('is_delete', 1)
            ->whereNotNull('pdf')
            ->get(['id', 'approved_projects']);

        $evenRows = PdfDetail::whereRaw('id % 2 = 0')
            ->where('is_delete', 1)
            ->whereNotNull('pdf')
            ->get(['id', 'approved_projects']);

        $oddName = [];
        $sno = 1;
        foreach ($oddRows as $row) {
            $oddName[] = ['sno' => $sno++, 'id' => $row->id, 'approved_projects' => $row->approved_projects];
        }

        $evenName = [];
        $sno = count($oddName) + 1;
        foreach ($evenRows as $row) {
            $evenName[] = ['sno' => $sno++, 'id' => $row->id, 'approved_projects' => $row->approved_projects];
        }

        return view('home.certificate', compact('oddName', 'evenName'));
    }
}
