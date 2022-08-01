<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\MadLibInstance
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstance query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $mad_lib_id
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstance whereMadLibId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstance whereUpdatedAt($value)
 * @property array $filled
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstance whereFilled($value)
 * @property-read \App\Models\MadLib $madLib
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MadLibInstancePart[] $madLibInstanceParts
 * @property-read int|null $mad_lib_instance_parts_count
 */
class MadLibInstance extends Model
{
    use HasFactory;

    protected $fillable = ['mad_lib_id'];

    protected $hidden = ['madLib', 'updated_at', 'created_at'];

    private CONST REPLACEMENT_STRING = '{blank}';

    protected static function booted()
    {
        static::created(function (MadLibInstance $madLibInstance) {
            $parts = $madLibInstance->madLib->madLibParts->map(fn (MadLibPart $part) => new MadLibInstancePart(['mad_lib_part_id' => $part->id]));
            $madLibInstance->madLibInstanceParts()->saveMany($parts);
        });
    }

    public function madLibInstanceParts(): HasMany
    {
        return $this->hasMany(MadLibInstancePart::class);
    }

    public function madLib(): BelongsTo
    {
        return $this->belongsTo(MadLib::class);
    }

    public function __toString()
    {
        $output = $this->madLib->content;
        $replacementLength = strlen(self::REPLACEMENT_STRING);
        $partContents = $this->madLibInstanceParts->pluck('content')->toArray();
        while (($occurrence = strpos($output, self::REPLACEMENT_STRING)) !== false) {
            $output = substr_replace($output, array_shift($partContents) ?? '_____', $occurrence, $replacementLength);
        }
        return $output;
    }
}
