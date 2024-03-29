<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Supplier
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $contact_person
 * @property int|null $status
 * @property int|null $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Supplier extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'suppliers';

	protected $casts = [
		'status' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'name',
		'email',
		'phone',
		'address',
		'contact_person',
		'status',
		'active'
	];
}
