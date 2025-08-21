<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobVacancy extends Model
{
  //
  use HasUuids, HasFactory, SoftDeletes;

  protected $keyType = 'string';
  protected $table = 'job_vacancies';
  protected $primaryKey = 'id';

  public $incrementing = false;

  protected $fillable = [
    'title',
    'description',
    'location',
    'type',
    'salary',
    'viewCount',
    'required_skills',
    'company_id',
    'jobCategory_id',
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
  public function company()
  {
    return $this->belongsTo(Company::class, 'company_id', 'id');
  }
  public function jobCategory()
  {
    return $this->belongsTo(JobCategory::class, 'jobCategory_id', 'id');
  }

  public function jobApplications()
  {
    return $this->hasMany(JobApplication::class, 'job_vacancy_id', 'id');
  }

}
