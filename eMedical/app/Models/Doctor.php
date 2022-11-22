<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Doctor
 *
 * @property $id
 * @property $email
 * @property $specialty
 * @property $created_at
 * @property $updated_at
 *
 * @property Prescription[] $prescriptions
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Doctor extends Model
{


    protected $primaryKey = 'email';

    public $incrementing = false;

    protected $keyType = 'string';
    
    static $rules = [
		'specialty' => 'required','string',
        'email' => ['required', 'string','email','unique:users'],
		'id' => ['required', 'string', 'max:9','unique:doctors'],
    ];


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['email','specialty','id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prescriptions()
    {
        return $this->hasMany('App\Models\Prescription', 'doctor_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'email', 'email');
    }
    

}
