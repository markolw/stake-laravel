<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Message
 * @package App\Models
 * @version June 9, 2022, 9:45 pm UTC
 *
 * @property string $client_stake_id
 * @property string $message
 * @property string|\Carbon\Carbon $stake_date
 */
class Message extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'messages';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'client_stake_id',
        'message',
        'stake_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'client_stake_id' => 'string',
        'message' => 'string',
        'stake_date' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'client_stake_id' => 'required|string|max:191',
        'message' => 'required|string|max:191',
        'stake_date' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
