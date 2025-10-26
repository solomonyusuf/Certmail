<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 * 
 * @property string $id
 * @property string $name
 * @property string|null $certificate
 * @property string|null $email 
 * @property string $training_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Tranning $tranning
 *
 * @package App\Models
 */
class Student extends Model
{
	use HasUuids;
	protected $table = 'students';
	public $incrementing = false;

	protected $fillable = [
		'name',
		'certificate',
		'email',
		'training_id'
	];

	public function tranning()
	{
		return $this->belongsTo(Tranning::class, 'training_id');
	}
}
