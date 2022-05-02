<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentCourse extends Model
{
    use HasFactory;

    protected $table = 'document_courses';

    protected $primaryKey = 'document_course_id';

    protected $fillable = [
        'doc_id',
        'course_id',
        'document_course_status',
        'option',
    ];

    public function document(){
        return $this->belongsTo(Document::class, 'doc_id', 'document_id');
    }

    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }
}
