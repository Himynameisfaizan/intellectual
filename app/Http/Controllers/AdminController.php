<?php

namespace App\Http\Controllers;

use App\Models\PdfDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.adminLogin');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin');
    }

    public function home_details()
    {
        $details = PdfDetail::latest()->get();
        return view('admin.home_details', compact('details'));
    }

    public function home_details_edit_page($id){
        $details = PdfDetail::find($id)->get();
        return view("admin.home_details_edit_page", compact('details'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'imageUpload' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
            'approved_project' => 'required',
            'pdf' => 'required|file|mimes:pdf|max:20480',
            'password' => 'required',
            'user_id' => 'required',
        ]);

        $path = null;
        $pdfpath = null;

        if ($request->hasFile('imageUpload')) {
            $file = $request->file('imageUpload');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = public_path('banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $filename);
            $path = 'banner/' . $filename;
        }

        if ($request->hasFile('pdf')) {
            $pdffile = $request->file('pdf');
            $pdffilename = time() . '_' . $pdffile->getClientOriginalName();

            $destinationPath = public_path('banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $pdffile->move($destinationPath, $pdffilename);

            $pdfpath = 'banner/' . $pdffilename;
        }

        PdfDetail::create([
            'image_url' => $path,
            'approved_projects' => $request->approved_project,
            'pdf' => $pdfpath,
            'password' => $request->password,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Data added successfully!');
    }

    public function pdf()
    {
        return view('admin.pdfGenerate');
    }

    public function new_project_details()
    {
        return view('admin.new-project-details');
    }


    public function generate(Request $request)
    {
        // 1. Validation
        $request->validate([
            'client_name' => 'required',
            'company_name' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required',
            'gst_no' => 'required',
        ]);

        $formattedDate = Carbon::parse($request->date ?? now())->format('d F Y');

        if (!defined('FPDF_FONTPATH')) {
            define('FPDF_FONTPATH', public_path('fonts/'));
        }

        $pdf = new Fpdi();
        // Font names check karein: Folder mein 'times.php' aur 'timesb.php' hain 
        $pdf->AddFont('MyFont', '', 'times.php');
        $pdf->AddFont('MyFont', 'B', 'Times New Roman - Bold.php');

        $templatePath = public_path('storage/images/certificate_template.pdf');
        $pdf->setSourceFile($templatePath);
        $templateId = $pdf->importPage(1);
        $pdf->AddPage('L', 'A4');
        $pdf->useTemplate($templateId);

        // 2. Logo Alignment (Exact Center)
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            // X = (297-80)/2 = 108.5, Width 80, Height 15 approx as per template [cite: 6]
            $pdf->Image($logo->getRealPath(), 108, 77, 80, 18, $logo->getClientOriginalExtension());
        }

        // 3. Paragraph Content with <b> tags for bolding
        $pdf->SetTextColor(0, 0, 0);
        $lineHeight = 7.5;
        $fontSize = 13.5;
        $width = 250;

        $text = "This is to certify that <b>" . $request->company_name . " (CIN/GST: " . $request->gst_no . ")</b>, under the proprietorship of <b>" . $request->client_name . "</b>, having its registered address at <b>" . $request->address . "</b>, has been granted a <b>Perpetual, Worldwide, and Exclusive licence</b> to use the <b>" . $request->company_name . "</b> logo design created by <b>Do It Creation</b> for all commercial, promotional, and branding purposes, effective from <b>" . $formattedDate . "</b>; this licence permits use across all media and platforms, does not imply <b>trademark registration or ownership</b>, and confirms that <b>Do It Creation</b> retains authorship solely as the original design.";

        // Position Set karein
        $pdf->SetXY(22, 105); // Left margin approx 40mm se start

        // --- CALL HELPER FUNCTION ---
        $this->MultiCellCenteredBold($pdf, $width, $lineHeight, $text, $fontSize);

        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Certificate.pdf"');
    }

    protected function MultiCellCenteredBold($pdf, $w, $h, $txt, $fontSize)
    {
        $pdf->SetFont('MyFont', '', $fontSize);

        // Text ko bold tags ke basis par split karein
        $parts = preg_split('/<(b|B)>(.*?)<\/\1>/', $txt, -1, PREG_SPLIT_DELIM_CAPTURE);

        $words = [];
        foreach ($parts as $i => $part) {
            if (strtolower($part) == 'b') continue;
            $isBold = ($i > 0 && strtolower($parts[$i - 1]) == 'b');

            $subWords = explode(' ', $part);
            foreach ($subWords as $word) {
                if ($word !== '') {
                    $words[] = ['text' => $word . ' ', 'bold' => $isBold];
                }
            }
        }

        $lines = [];
        $currentLine = [];
        $currentWidth = 0;

        foreach ($words as $wordInfo) {
            $pdf->SetFont('MyFont', $wordInfo['bold'] ? 'B' : '', $fontSize);
            $wordWidth = $pdf->GetStringWidth($wordInfo['text']);

            if ($currentWidth + $wordWidth > $w) {
                $lines[] = $currentLine;
                $currentLine = [$wordInfo];
                $currentWidth = $wordWidth;
            } else {
                $currentLine[] = $wordInfo;
                $currentWidth += $wordWidth;
            }
        }
        $lines[] = $currentLine;

        // Har line ko center align karke print karein
        $startX = $pdf->GetX();
        $startY = $pdf->GetY();

        foreach ($lines as $line) {
            $lineWidth = 0;
            foreach ($line as $word) {
                $pdf->SetFont('MyFont', $word['bold'] ? 'B' : '', $fontSize);
                $lineWidth += $pdf->GetStringWidth($word['text']);
            }

            // Calculate Offset for Centering
            $offset = ($w - $lineWidth) / 2;
            $pdf->SetX($startX + $offset);

            foreach ($line as $word) {
                $pdf->SetFont('MyFont', $word['bold'] ? 'B' : '', $fontSize);
                $pdf->Write($h, $word['text']);
            }
            $pdf->Ln($h);
            $pdf->SetX($startX);
        }
    }
}
