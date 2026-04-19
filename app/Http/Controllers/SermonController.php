<?php

namespace App\Http\Controllers;

use App\Models\Sermon;

class SermonController extends Controller
{
    public function index()
    {
        $sermons = Sermon::published()->latest()->paginate(12);
        return view('public.sermons.index', compact('sermons'));
    }

    public function show(Sermon $sermon)
    {
        abort_unless($sermon->is_published, 404);
        return view('public.sermons.show', compact('sermon'));
    }
}
