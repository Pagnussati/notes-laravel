<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // Load users notes
        $id = session('user.id');
        $notes = User::find($id)->notes()->get()->toArray();

        // Show home view
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        // Create new note
    }
}
