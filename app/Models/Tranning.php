<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tranning
 * 
 * @property string $id
 * @property string $title
 * @property string $instructor
 * @property string $meta_data
 * @property Carbon $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Student[] $students
 *
 * @package App\Models
 */
class Tranning extends Model
{
	use HasUuids;
	protected $table = 'trannings';
	public $incrementing = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'title',
		'instructor',
		'meta_data',
		'date'
	];

	public function students()
	{
		return $this->hasMany(Student::class, 'training_id');
	}
}
