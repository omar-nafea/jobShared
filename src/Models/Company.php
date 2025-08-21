<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
  use HasUuids, HasFactory, SoftDeletes;

  protected $keyType = 'string';
  //
  protected $table = "companies";
  protected $primaryKey = "id";
  public $incrementing = false;

  protected $fillable = [
    'name',
    'address',
    'industry',
    'website',
    'ownerId',
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
    return $this->belongsTo(User::class, 'ownerId', 'id')->withTrashed();
  }
  public function jobVacancies()
  {
    return $this->hasMany(JobVacancy::class, 'company_id', 'id');
  }
  public function jobApplications()
  {
    return $this->hasManyThrough(
      JobApplication::class, // Target model
      JobVacancy::class,     // Intermediate model
      'company_id',          // Foreign key on JobVacancy table
      'job_vacancy_id',      // Foreign key on JobApplication table
      'id',                  // Local key on Company table
      'id'                   // Local key on JobVacancy table
    );
  }
}
