<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // Load users notes

        // Show home view
        return view('home');
    }

    public function newNote()
    {
        // Create new note
    }
}
