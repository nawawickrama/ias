<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $primaryKey = 'document_id';

    protected $fillable = [
        'doc_name',
    ];

    public function courses(){
        return $this->hasOne(DocumentCourse::class, 'doc_id', 'document_id');
    }

    public function candidates(){
        return $this->hasMany(CandidateDocument::class, 'document_id');
    }
}
