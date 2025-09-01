<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
  use HasUuids, HasFactory, SoftDeletes;

  protected $keyType = 'string';

  protected $table = 'job_applications';
  protected $primaryKey = 'id';
  public $incrementing = false;

  protected $fillable = [
    'status',
    'aiGeneratedScore',
    'aiGeneratedFeedback',
    'user_id', // Assuming job applications are linked to users
    'job_vacancy_id', // Assuming job applications are linked to job vacancies
    'resume_id', // Assuming job applications are linked to resumes
  ];

  protected $dates = [
    'deleted_at',
  ];

  protected function casts(): array
  {
    return [
      'deleted_at' => 'datetime',
      'aiGeneratedScore' => 'float',
    ];
  }

  public function jobVacancy()
  {
    return $this->belongsTo(JobVacancy::class, 'job_vacancy_id');
  }
  public function resume()
  {
    return $this->belongsTo(Resume::class, 'resume_id');
  }
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }


}
