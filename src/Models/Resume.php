<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    //
  use HasUuids, HasFactory, SoftDeletes;

  protected $keyType = 'string';
    protected $table = 'resumes';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
      'filename',
      'fileUrl',
      'contactDetails',
      'summary',
      'skills',
      'experience',
      'education',
      'user_id', // Assuming resumes are linked to users

    ];
    protected $dates = [
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'resume_id', 'id');
    }
}
