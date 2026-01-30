<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShortUrl
 *
 * @property int $id
 * @property int $client_id
 * @property int $user_id
 * @property string $short_code
 * @property string $long_url
 * @property int|null $total_hits
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class ShortUrl extends Model
{
    protected $table = 'short_urls';
    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'int',
        'client_id' => 'int',
        'user_id' => 'int',
        'total_hits' => 'int'
    ];

    protected $fillable = [
        'id',
        'client_id',
        'user_id',
        'short_code',
        'long_url',
        'total_hits'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
