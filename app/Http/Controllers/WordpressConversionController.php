<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Converters\Wordpress;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Support\Facades\Storage;

class WordpressConversionController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'export_file' => 'required|mimes:xml|max:10240',
        ]);
        
        try {
            $posts = Wordpress::fromExport($request->file('export_file')->path())->toStatamic();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["Your file wasn't in the expected format. Please try another export file."]);
        }

        $filePath = storage_path('app/' . str_random(10)) . '.zip';

        $zip = Zipper::make($filePath);

        $posts->each(function($content, $filename) use ($zip) {
            $zip->addString($filename, $content);
        });

        $zip->close();

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
