<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        // Load users notes
        $id = session('user.id');
        $notes = User::find($id)->notes()->whereNull('deleted_at')->get()->toArray();

        // Show home view
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        // Show new note
        return view('new_note');
    }

    public function newNoteSubmit(Request $request)
    {
        $request->validate(
            // Rules
            [
                'text_title' => 'required | min:3 | max:200',
                'text_note' => 'required | min:3 | max:3000',
            ],
            // Error messages
            [
                'text_title.required' => 'O campo titulo é obrigatório.',
                'text_title.min' => 'O campo titulo deve ter no minimo :min caracteres',
                'text_title.max' => 'O campo titulo deve ter no maximo :max caracteres',

                'text_note.required' => 'O campo nota é obrigatório.',
                'text_note.min' => 'O campo nota deve ter no mínimo :min caracteres.',
                'text_note.max' => 'O campo nota deve ter no máximo :max caracteres.',
            ]
        );

        $id = session('user.id');

        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route('home');
    }

    public function editNote($id)
    {
        $id = Operations::decryptId($id);
        if($id === null) {
            return redirect()->route('home');
        }

        $note = Note::find($id);
        return view('edit_note', ['note' => $note]);
    }

    public function editNoteSubmit(Request $request)
    {
        $request->validate(
            // Rules
            [
                'text_title' => 'required | min:3 | max:200',
                'text_note' => 'required | min:3 | max:3000',
            ],
            // Error messages
            [
                'text_title.required' => 'O campo titulo é obrigatório.',
                'text_title.min' => 'O campo titulo deve ter no minimo :min caracteres',
                'text_title.max' => 'O campo titulo deve ter no maximo :max caracteres',

                'text_note.required' => 'O campo nota é obrigatório.',
                'text_note.min' => 'O campo nota deve ter no mínimo :min caracteres.',
                'text_note.max' => 'O campo nota deve ter no máximo :max caracteres.',
            ]
        );

        if($request->note_id == null) {
            return redirect()->route('home');
        }

        $id = Operations::decryptId($request->note_id);
        if($id === null) {
            return redirect()->route('home');
        }

        $note = Note::find($id);
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route('home');
    }

    public function deleteNote($id)
    {
        //$id = $this->decryptId($id);
        $id = Operations::decryptId($id);
        if($id === null) {
            return redirect()->route('home');
        }

        $note = Note::find($id);
        return view('delete_note', ['note' => $note]);
    }

    public function deleteNoteConfirm($id)
    {
        $id = Operations::decryptId($id);
        if($id === null) {
            return redirect()->route('home');
        }

        // Soft delete with softDeletes property in model
        $note = Note::find($id);
        $note->delete();

        return redirect()->route('home');
    }
}
