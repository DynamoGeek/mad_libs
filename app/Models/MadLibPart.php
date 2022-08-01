<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MadLibPart
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $mad_lib_id
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibPart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibPart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibPart query()
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibPart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibPart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibPart whereMadLibId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibPart whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibPart whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MadLibPart extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    protected $hidden = ['created_at', 'updated_at'];
}
