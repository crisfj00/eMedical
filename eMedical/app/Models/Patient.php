<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Patient
 *
 * @property $email
 * @property $id_number
 * @property $healthcare_number
 * @property $birthday
 * @property $occupation
 * @property $address
 * @property $phone_number
 * @property $created_at
 * @property $updated_at
 *
 * @property Prescription[] $prescriptions
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Patient extends Model
{

    protected $primaryKey = 'email';

    public $incrementing = false;

    protected $keyType = 'string';
    
    static $rules = [
		'email' => ['required', 'string','email','unique:users'],
		'id' => ['required', 'string', 'max:10','unique:patients'],
		'healthcare_number' => ['required', 'string', 'max:10','unique:patients'],
		'birthday' => 'required',
		'occupation' => 'required',
		'address' => 'required',
		'phone_number' => ['required', 'string', 'min:9'],
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['email','id','healthcare_number','birthday','occupation','address','phone_number'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prescriptions()
    {
        return $this->hasMany('App\Models\Prescription', 'patient_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'email', 'email');
    }
    

}
