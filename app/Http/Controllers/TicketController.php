<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Barryvdh\Debugbar\Facade as Debugbar;

class TicketController extends Controller
{

    public function __construct() {
        $this->authorizeResource(Ticket::class, 'ticket');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ticket.index', [
            // Get the tickets where the user_i is equal to the current user id
            'tickets' => Ticket::where('user_id', auth()->user()->id)->get(),
            // Return the current user
            'user' => auth()->user(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);

        if($request->file('attachment')){
            $this->updateAttachment($request, $ticket);
        }

        return response()->redirectTo(route('ticket.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('ticket.view', [
            'ticket' => $ticket,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket.edit', [
            'ticket' => $ticket,
        ])->with('ticket', $ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        // Get the response from TicketPolicy
        // $response = Gate::inspect('update', $ticket);
        // if($response->allowed()){
            $ticket->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            if ($request->attachment) {
                $this->updateAttachment($request, $ticket);
            }

            return response()->redirectTo(route('ticket.index'));
        // } else {
        //     return view('errors.403');
        // }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        // Check if user is allowed to delete the ticket
        $response = Gate::inspect('delete', $ticket);
        if($response->allowed()){
            // Delete the ticket
            $ticket->delete();
        } else {
            return view('errors.403');
        }
        return response()->redirectTo(route('ticket.index'));
    }

    public function download(Ticket $ticket){
        // TODO: Implement download() method.
        // Debugbar::message("Download ticket {$ticket->id}");
        $file = Storage::path($ticket);
        dd($file);
        return Storage::download($ticket->attachment);
    }

    private function updateAttachment(FormRequest $request, Ticket $ticket): void
    {
        // Get file extension
        $extension = $request->file('attachment')->extension();
        // Generate file name
        $fileName = time() . '.' . $extension;
        // Get file contents
        $fileContents = $request->file('attachment')->get();
        // Save file
        $path = "attachments/" . $fileName;
        Storage::disk('public')->put($path, $fileContents);
        $ticket->update([
            'attachment' => $path
        ]);
    }
}
