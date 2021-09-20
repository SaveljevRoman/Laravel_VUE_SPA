<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Desk
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\DeskFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Desk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Desk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Desk query()
 * @method static \Illuminate\Database\Eloquent\Builder|Desk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desk whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desk whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Desk extends Model
{
    protected $fillable = [
      'name',
    ];

    public function lists()
    {
        return $this->hasMany(DeskList::class);
    }

}
