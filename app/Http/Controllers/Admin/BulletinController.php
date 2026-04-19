<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BulletinController extends Controller
{
    public function index()
    {
        $bulletins = Bulletin::orderBy('bulletin_date', 'desc')->paginate(15);
        return view('admin.bulletins.index', compact('bulletins'));
    }

    public function create()
    {
        return view('admin.bulletins.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'bulletin_file' => 'required|file|mimes:pdf|max:20480',
            'bulletin_date' => 'required|date',
            'is_published'  => 'boolean',
        ]);

        $data['file_path']    = $request->file('bulletin_file')->store('bulletins', 'public');
        $data['is_published'] = $request->boolean('is_published');

        unset($data['bulletin_file']);
        Bulletin::create($data);

        return redirect()->route('admin.bulletins.index')
                         ->with('success', 'Bulletin uploaded successfully!');
    }

    public function destroy(Bulletin $bulletin)
    {
        Storage::disk('public')->delete($bulletin->file_path);
        $bulletin->delete();

        return redirect()->route('admin.bulletins.index')
                         ->with('success', 'Bulletin deleted.');
    }
}
