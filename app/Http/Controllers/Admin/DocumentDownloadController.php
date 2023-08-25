<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentDownload;
use Illuminate\Http\Request;
use App\DataTables\DocumentDownloadDataTable;

class DocumentDownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DocumentDownloadDataTable $dataTable)
    {
        return $dataTable->render('admin.document-download.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentDownload  $documentDownload
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentDownload $documentDownload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentDownload  $documentDownload
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentDownload $documentDownload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentDownload  $documentDownload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentDownload $documentDownload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentDownload  $documentDownload
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentDownload $documentDownload)
    {
        //
    }
}
