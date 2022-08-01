<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\MadLibInstancePart
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $mad_lib_instance_id
 * @property int $mad_lib_part_id
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstancePart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstancePart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstancePart query()
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstancePart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstancePart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstancePart whereMadLibInstanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstancePart whereMadLibPartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstancePart whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\MadLibInstance $madLibInstance
 * @property string|null $content
 * @property-read \App\Models\MadLibPart $madLibPart
 * @method static \Illuminate\Database\Eloquent\Builder|MadLibInstancePart whereContent($value)
 */
class MadLibInstancePart extends Model
{
    use HasFactory;

    protected $fillable = ['mad_lib_part_id', 'content'];

    protected $hidden = ['created_at', 'updated_at'];

    public function madLibInstance(): BelongsTo
    {
        return $this->belongsTo(MadLibInstance::class);
    }

    public function madLibPart(): BelongsTo
    {
        return $this->belongsTo(MadLibPart::class);
    }
}
