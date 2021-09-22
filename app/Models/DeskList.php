<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeskList
 *
 * @property int $id
 * @property string $name
 * @property int $desk_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\DeskListFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|DeskList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeskList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeskList query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeskList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeskList whereDeskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeskList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeskList whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeskList whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeskList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desk_id',
    ];
}
