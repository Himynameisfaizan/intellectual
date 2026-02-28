<?php

namespace App\Http\Controllers;

use App\Models\NewProject;
use App\Models\PdfDetail;
use App\Models\UserData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Expr\New_;
use setasign\Fpdi\Fpdi;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.adminLogin');
    }

    public function dashboard()
    {
        $totalProjects = NewProject::count();
        $totalCertificates = PdfDetail::where('is_delete', 1)->count();

        $recentDownloads = UserData::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalProjects', 'totalCertificates', 'recentDownloads'));
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

    public function home_details_edit_page($id)
    {
        $details = PdfDetail::findorFail($id);
        return view("admin.home_details_edit_page", compact('details'));
    }

    public function deleteDetails($id)
    {
        $details = PdfDetail::findOrFail($id);

        if ($details->image_url && file_exists(public_path($details->image_url))) {
            unlink(public_path($details->image_url));
        }
        if ($details->pdf && file_exists(public_path($details->pdf))) {
            unlink(public_path($details->pdf));
        }

        $details->delete();
        return redirect()->back()->with("success", "Record deleted successfully!");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'approved_project' => 'string|max:255',
            'password' => 'string',
            'user_id' => 'string',
            'imageUpload' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'pdf' => 'nullable|file|mimes:pdf|max:20420',
        ]);

        $item = PdfDetail::findorFail($id);

        if ($request->hasFile('imageUpload')) {
            if ($item->image_url && File::exists(public_path($item->image_url))) {
                File::delete(public_path($item->image_url));
            }

            $file = $request->file('imageUpload');
            $filename = time() . "." . $file->getClientOriginalName();
            $file->move(public_path('banner'), $filename);
            $item->image_url = 'banner/' . $filename;
        }

        if ($request->hasFile('pdf')) {
            if ($item->pdf && File::exists(public_path($item->pdf))) {
                File::delete(public_path($item->pdf));
            }

            $pdfFile = $request->file('pdf');
            $pdffilename = time() . "_upd_" . $pdfFile->getClientOriginalName();
            $pdfFile->move(public_path('banner'), $pdffilename);
            $item->pdf = 'banner/' . $pdffilename;
        }

        $item->approved_projects = $request->approved_project ?? $item->approved_projects;
        $item->password = $request->password ?? $item->password;
        $item->user_id = $request->user_id ?? $item->user_id;

        $item->save();
        return redirect()->route('home_details')->with("You product update successfully");
    }

    public function insert(Request $request)
    {
        $request->validate([
            'imageUpload' => 'nullable|file|mimes:jpeg,png,jpg,avif,webp,mp4,mov,mkv|max:20480',
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
        $details = NewProject::get();
        return view('admin.new-project-details', compact('details'));
    }

    public function new_project_insert(Request $request)
    {
        $request->validate([
            'new_update' => "required",
        ]);

        NewProject::create([
            'new_update' => $request->new_update,
        ]);

        return redirect()->back()->with("insert successfully");
    }

    public function new_project_edit($id)
    {
        $details = NewProject::findorfail($id);

        return view("admin.new_project_edit", compact("details"));
    }

    public function new_project_update(Request $request, $id)
    {
        $request->validate([
            'new_update' => "required",
        ]);

        $update = NewProject::findorfail($id);

        $update->update([
            'new_update' => $request->new_update,
        ]);

        return redirect('admin/new-project-details')->with('data updated', 'updated successfully');
    }

    public function new_project_delete($id)
    {
        $details = NewProject::findorfail($id);

        $details->delete();

        return redirect('admin/new-project-details')->with("deleted", "successfully deleted");
    }


    public function generate(Request $request)
    {
        $request->validate([
            'client_name' => 'required',
            'company_name' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required',
            'gst_no' => 'required',
            'userPassword' => 'required',
        ]);

        $formattedDate = Carbon::parse($request->date ?? now())->format('d F Y');
        $uniqueID = $request->userPassword;

        if (!defined('FPDF_FONTPATH')) {
            define('FPDF_FONTPATH', public_path('fonts/'));
        }

        $pdf = new Fpdi();
        $pdf->AddFont('MyFont', '', 'times.php');
        $pdf->AddFont('MyFont', 'B', 'Times New Roman - Bold.php');

        $templatePath = public_path('storage/images/certificate_template.pdf');

        if (!File::exists($templatePath)) {
            return back()->with('error', 'Template file not found at: ' . $templatePath);
        }

        $pdf->setSourceFile($templatePath);
        $templateId = $pdf->importPage(1);
        $pdf->AddPage('L', 'A4');
        $pdf->useTemplate($templateId);



        // --- UNIQUE ID PRINT KARNA (Top Right) ---
        $pdf->SetTextColor(0, 0, 0); // Thoda gray color rakhte hain unique ID ke liye
        $pdf->SetFont('MyFont', 'B', 10);   // Chota font size
        // X=230 (Right side), Y=15 (Top side) - Aap template ke hisaab se adjust kar sakte hain
        $pdf->SetXY(235, 0);
        $pdf->Cell(50, 10, 'Certificate ID: ' . $uniqueID, 0, 0, 'R');


        // Logo logic

        // if ($request->hasFile('logo')) {
        //     $logo = $request->file('logo');
        //     $pdf->Image($logo->getRealPath(), 108, 77, 80, 0, $logo->getClientOriginalExtension());
        // }

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->getRealPath();

            // 1. Image ki original dimensions nikalna
            list($widthPx, $heightPx) = getimagesize($logoPath);

            // 2. Target box (80mm x 18mm)
            $maxW = 80;
            $maxH = 50;

            // 3. Scale factor calculate karna
            // Hum check karenge ki width wise kitna chota karna hai aur height wise kitna
            $scale = min($maxW / $widthPx, $maxH / $heightPx);

            // 4. Final dimensions jo aspect ratio maintain rakhengi
            $finalW = $widthPx * $scale;
            $finalH = $heightPx * $scale;

            // 5. Centering Logic
            // Box ke center mein lane ke liye offset nikalna
            $offsetX = 108 + ($maxW - $finalW) / 2;
            $offsetY = 70 + ($maxH - $finalH) / 2;

            $pdf->Image($logoPath, $offsetX, $offsetY, $finalW, $finalH, $logo->getClientOriginalExtension());
        }

        $pdf->SetTextColor(0, 0, 0); // Text ke liye wapas black color
        $lineHeight = 7.5;
        $fontSize = 13.5;
        $width = 250;

        $text = "This is to certify that <b>" . $request->company_name . " (CIN/GST: " . $request->gst_no . "),</b> under the proprietorship of <b>" . $request->client_name . ",</b> having its registered address at <b>" . $request->address . ",</b> has been granted a <b>Perpetual, Worldwide, and Exclusive licence</b> to use the <b>" . $request->company_name . "</b> logo design created by <b>Do It Creation</b> for all commercial, promotional, and branding purposes, effective from <b>" . $formattedDate . ";</b> this licence permits use across all media and platforms, does not imply <b>trademark registration or ownership,</b> and confirms that <b>Do It Creation</b> retains authorship solely as the original design.";

        $pdf->SetXY(22, 115);
        $this->MultiCellCenteredBold($pdf, $width, $lineHeight, $text, $fontSize);

        if (file_exists(public_path('images/transparent.png'))) {
            $pdf->Image(public_path('images/transparent.png'), 0, 0, 297, 210, 'PNG');
        }

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
