<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticlesPdfs;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        /**
         * @var array|null|false $data The Data After Passing the validations
         */
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'thumbnail' => 'required|file|image|mimes:png,jpg,jpeg,gif|extensions:png,jpg,jpeg,gif|max:2048',
            'pdfs' => 'max:15',
            'pdfs.*' => 'required|file|mimes:pdf|extensions:pdf|max:8192',
        ]);
        $pdfs_paths = $this->handle_files($request, 'pdfs', 'pdfs');
        $thumbnail_path = ($request->hasFile('thumbnail')) ? $this->handle_file($request->file('thumbnail'), 'thumbnails') : '';
        try {
            DB::beginTransaction();
            $article = Article::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'thumbnail' => $thumbnail_path,
            ]);
            if ($pdfs_paths) {
                foreach ($pdfs_paths as $pdf_path) {
                    $full_path = Storage::path($pdf_path);
                    $hash = hash_file('sha256', $full_path);
                    $pdf = ArticlesPdfs::create([
                        'article_id' => $article->id,
                        'path' => $pdf_path,
                        'hash' => $hash,
                    ]);
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);

            return back()->withInput()->with('error', 'Failed to create article. Please try again.'); // Redirect back with error message
        }
    }

    /**
     * @param  Request  $request  The current instance of Request Object
     * @param  string  $key  Name of the key of uploaded file
     * @param  string  $folder  Name of the folder in which the files should be stored
     * @return array|null Array Containing Paths of the Uploaded files
     */
    private function handle_files(Request $request, string $key, string $folder): ?array
    {
        if (! $request->hasFile($key)) {
            return null;
        }

        $paths = [];
        /**
         * @var UploadedFile[] $files The Array of UploadedFile objects Which will be further used for Storing the files
         */
        $files = $request->file("$key.*");

        foreach ($files as $file) {
            $paths[] = $this->handle_file($file, $folder);
        }

        return $paths;

    }

    /**
     * @param  UploadedFile  $file  The Uploaded File
     * @param  string  $folder  The name of Folder in which the file should be stored
     * @return string The Path which contains the stored file
     */
    private function handle_file(UploadedFile $file, string $folder): string
    {
        $uuid = Str::uuid7();
        $extension = $file->extension();
        $name = "$uuid.$extension";

        return Storage::putFileAs($folder, $file, $name);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
