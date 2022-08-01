<?php

namespace App\Http\Controllers;

use App\Models\MadLib;
use App\Models\MadLibPart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class MadLibController extends Controller
{
    public function index(): Collection
    {
        return MadLib::all()->load('madLibParts');
    }
    public function show(MadLib $madLib): MadLib
    {
        return $madLib->load(['madLibParts']);
    }

    public function store(Request $request): MadLib
    {
        $madLib = MadLib::create($request->all());
        foreach ($request->json('mad_lib_parts', []) as $type) {
            $madLib->madLibParts()->save(new MadLibPart(['type' => $type]));
        }
        return $madLib->load(['madLibParts']);
    }
}
