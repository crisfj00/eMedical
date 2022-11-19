<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prescription
 *
 * @property $id
 * @property $patient_id
 * @property $doctor_id
 * @property $consultation
 * @property $diagnosis
 * @property $state
 * @property $created_at
 * @property $updated_at
 *
 * @property Doctor $doctor
 * @property Patient $patient
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Prescription extends Model
{
    
    static $rules = [
		'patient_id' => 'required',
		'doctor_id' => 'required',
		'consultation' => 'required',
		'state' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['patient_id','doctor_id','consultation','diagnosis','state'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doctor()
    {
        return $this->hasOne('App\Models\Doctor', 'id', 'doctor_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function patient()
    {
        return $this->hasOne('App\Models\Patient', 'id', 'patient_id');
    }
    

}
