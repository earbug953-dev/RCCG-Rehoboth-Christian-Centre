<?php
namespace App\Http\Controllers;
use App\Models\Bulletin;

class BulletinController extends Controller
{
    public function index()
    {
        $bulletins = Bulletin::published()->paginate(12);
        return view('public.bulletins.index', compact('bulletins'));
    }
}
