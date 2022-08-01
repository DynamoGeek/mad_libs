<?php

namespace App\Http\Controllers;

use App\Models\MadLib;
use App\Models\MadLibInstance;
use Illuminate\Http\Request;

class MadLibInstanceController extends Controller
{
    public function show(string $madLibId, MadLibInstance $madLibInstance): MadLibInstance
    {
        return $madLibInstance->load(['madLibInstanceParts', 'madLibInstanceParts.madLibPart']);
    }

    public function store(MadLib $madLib): MadLibInstance
    {
        return MadLibInstance::create(['mad_lib_id' => $madLib->id])->load(['madLibInstanceParts', 'madLibInstanceParts.madLibPart']);
    }

    public function update(Request $request, string $madLibId, MadLibInstance $madLibInstance): MadLibInstance
    {
        foreach ($request->json('mad_lib_instance_parts', []) as $part) {
            $madLibInstance->madLibInstanceParts()->where('id', $part['id'])->firstOrFail()->update($part);
        }
        $madLibInstance->update($request->all());
        return $madLibInstance->refresh()->load('madLibInstanceParts', 'madLibInstanceParts.madLibPart');
    }

    public function output(Request $request, string $madLibId, MadLibInstance $madLibInstance): string
    {
        return (string)$madLibInstance;
    }
}
