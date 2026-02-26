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

    // public function checkUserId(Request $request)
    // {
    //     $userId = $request->input('user_id');

    //     if (PdfDetail::where('user_id', $userId)->exists()) {

    //         try {
    //             UserData::create([
    //                 'user_id' => $userId,
    //                 'user_name' => $request->input('name'),
    //                 'phone_no' => $request->input('phone'),
    //             ]);
    //         } catch (\Exception $e) {
    //         }

    //         return response()->json([
    //             "status" => "success",
    //             "message" => "User ID valid hai",
    //             "download_url" => route('download_pdf', ['user_id' => $userId])
    //         ]);
    //     } else {
    //         return response()->json(["status" => "error", "message" => "Enter valid User Id"]);
    //     }
    // }

    // public function downloadPdf($userId)
    // {
    //     $pdfDetail = PdfDetail::where('user_id', $userId)->first();

    //     if (!$pdfDetail || !Storage::exists('public/' . $pdfDetail->pdf)) {
    //         return response("Invalid User ID or File Missing", 404);
    //     }

    //     $filePath = storage_path('app/public/' . $pdfDetail->pdf);
    //     $password = $pdfDetail->password;
    //     return response()->download($filePath, $pdfDetail->approved_projects . '.pdf');
    // }

    // public function certificate()
    // {
    //     $oddRows = PdfDetail::whereRaw('id % 2 = 1')
    //         ->where('is_delete', 1)
    //         ->whereNotNull('pdf')
    //         ->get(['id', 'approved_projects']);

    //     $evenRows = PdfDetail::whereRaw('id % 2 = 0')
    //         ->where('is_delete', 1)
    //         ->whereNotNull('pdf')
    //         ->get(['id', 'approved_projects']);

    //     $oddName = [];
    //     $sno = 1;
    //     foreach ($oddRows as $row) {
    //         $oddName[] = ['sno' => $sno++, 'id' => $row->id, 'approved_projects' => $row->approved_projects];
    //     }

    //     $evenName = [];
    //     $sno = count($oddName) + 1;
    //     foreach ($evenRows as $row) {
    //         $evenName[] = ['sno' => $sno++, 'id' => $row->id, 'approved_projects' => $row->approved_projects];
    //     }

    //     return view('home.certificate', compact('oddName', 'evenName'));
    // }

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

    public function checkUserId(Request $request)
    {
        try {
            $pdfId = $request->input('pdf_id');
            $nameInput = trim($request->input('name'));
            $phoneInput = trim($request->input('phone'));
            $userIdInput = trim($request->input('user_id'));
            $passwordInput = trim($request->input('password'));

            $pdfDetail = PdfDetail::find($pdfId);
            if (!$pdfDetail) {
                return response()->json(["status" => "error", "message" => "Invalid PDF Selection!"]);
            }

            if ($pdfDetail->password !== $passwordInput) {
                return response()->json(["status" => "error", "message" => "Invalid Password!"]);
            }

            if ($pdfDetail->user_id !== $userIdInput) {
                return response()->json(["status" => "error", "message" => "Invalid User ID!"]);
            }

            $existingUser = UserData::where('phone_no', $phoneInput)->first();

            if ($existingUser) {
                if ($existingUser->user_name !== $nameInput) {
                    return response()->json(["status" => "error", "message" => "Invalid Name for this phone number!"]);
                }
                if ($existingUser->user_id !== $userIdInput) {
                    return response()->json(["status" => "error", "message" => "User ID mismatch for this record!"]);
                }
            } else {
                UserData::create([
                    'user_id' => $userIdInput,
                    'user_name' => $nameInput,
                    'phone_no' => $phoneInput,
                    'project_name' => $pdfDetail->approved_projects
                ]);
            }

            return response()->json([
                "status" => "success",
                "message" => "Verified!",
                "download_url" => route('download_pdf', ['id' => $pdfId])
            ]);
        } catch (\Exception $e) {
            return response()->json(["status" => "error", "message" => "Server Error: " . $e->getMessage()]);
        }
    }

    public function downloadPdf($id)
    {
        $pdfDetail = PdfDetail::findOrFail($id);

        $filePath = public_path($pdfDetail->pdf);

        if (!file_exists($filePath)) {
            return response("File not found on server at: " . $filePath, 404);
        }

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $pdfDetail->approved_projects . '.pdf"'
        ]);
    }
}
