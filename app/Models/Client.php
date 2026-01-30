<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 *
 * @property int $id
 * @property string $client_name
 * @property string $email
 * @property bool|null $is_active
 * @property int $created_by
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Client extends Model
{
    protected $table = 'clients';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $casts = [
        'is_active' => 'bool',
        'role_id' => 'int',
        'super_admin_id' => 'int',
        'parent_id' => 'int',
        'created_by' => 'int',
    ];

    protected $fillable = [
        'client_name',
        'email',
        'role_id',
        'super_admin_id',
        'parent_id',
        'is_active',
        'created_by'
    ];
    public function users()
    {
        return $this->hasMany(Client::class, 'parent_id');
    }


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function shortUrls()
    {
        return $this->hasMany(ShortUrl::class, 'client_id', 'id');
    }
}
