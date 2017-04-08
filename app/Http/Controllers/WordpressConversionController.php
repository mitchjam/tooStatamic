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
        
        $posts = Wordpress::fromExport($request->file('export_file')->path())->toStatamic();

        $filePath = storage_path('app/' . str_random(10)) . '.zip';

        $zip = Zipper::make($filePath);

        $posts->each(function($content, $filename) use ($zip) {
            $zip->addString($filename, $content);
        });

        $zip->close();

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
