<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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

  protected $casts = [
    'contactDetails' => 'array',
    'skills' => 'array',
    'experience' => 'array',
    'education' => 'array',
  ];
  public function getFileUrlAttribute(): string
  {
    // Get the reference stored in the database.
    // This MUST match your database column name.
    $fileReference = $this->attributes['fileUrl'];

    // If for some reason the reference is empty, return an empty string.
    if (empty($fileReference)) {
      return '';
    }

    if (!Str::endsWith($fileReference, '.pdf')) {
      $fileReference .= '.pdf';
    }

    $cloudName = env('CLOUDINARY_CLOUD_NAME');

    // This is the clean, final URL structure without any transformations
    return "https://res.cloudinary.com/{$cloudName}/image/upload/{$fileReference}";
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
