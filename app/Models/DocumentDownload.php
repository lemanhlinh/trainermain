<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentDownload extends Model
{
//    use HasFactory;
    protected $table = 'document_download';
    protected $guarded = ['id'];
}
