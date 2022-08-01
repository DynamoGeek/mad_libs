<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\MadLib
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $content
 * @method static \Illuminate\Database\Eloquent\Builder|MadLib newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MadLib newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MadLib query()
 * @method static \Illuminate\Database\Eloquent\Builder|MadLib whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLib whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLib whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLib whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MadLibPart[] $madLibParts
 * @property-read int|null $mad_lib_parts_count
 */
class MadLib extends Model
{
    use HasFactory;
    protected $fillable = ['content'];
    protected $hidden = ['created_at', 'updated_at'];

    public function madLibParts(): HasMany
    {
        return $this->hasMany(MadLibPart::class);
    }
}
