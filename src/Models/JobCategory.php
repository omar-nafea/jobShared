<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCategory extends Model
{


  use HasUuids, HasFactory, SoftDeletes;

  protected $keyType = 'string';

  protected $table = 'job_categories';
  protected $primaryKey = 'id';
  public $incrementing = false;

  protected $fillable = [
    'name',
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

  public function jobVacancies()
  {
    return $this->hasMany(JobVacancy::class, 'jobCategory_id');
  }
}

