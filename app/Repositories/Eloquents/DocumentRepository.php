<?php

namespace App\Repositories\Eloquents;

use App\Models\Document;
use App\Repositories\Contracts\DocumentInterface;

class DocumentRepository extends BaseRepository implements DocumentInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\Document';
    }
}
