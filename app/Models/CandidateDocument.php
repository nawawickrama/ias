<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateDocument extends Model
{
    use HasFactory;

    protected $table = 'candidate_documents';

    protected $primaryKey = 'candidate_document_id';

    protected $fillable = [
        'candidate_id',
        'document_id',
        'file_path',
        'status',
        'reject_reason'
    ];

    public function candidate(){
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function document(){
        return $this->belongsTo(Document::class, 'document_id');
    }
}
