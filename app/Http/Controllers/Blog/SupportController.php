<?php

namespace App\Http\Controllers\Blog;

use App\Http\Requests\SendTicketRequest;
use App\Http\Requests\StoreTicketMessageRequest;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupportController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->ticketCategoryRepository->getAll();
        $tickets = $this->ticketRepository->getBlogTickets(auth()->id());
        return view('themes.'.currentTheme().'.support.index', compact('categories', 'tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SendTicketRequest $request)
    {
        $ticket = new Ticket($request->input());
        $ticket->save();
        return back()->with(['success' => 'Ваш вопрос отправлен администратору']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = $this->ticketRepository->getBlogTicket($id);
        $messages = $this->ticketMessageRepository->getBlogTicketMessages($id);
        return view('themes.'.currentTheme().'.support.show', compact('ticket', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Store a newly created message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMessage(StoreTicketMessageRequest $request)
    {
        $ticket = $this->ticketRepository->getOne($request->input('ticket_id'));
        $message = new TicketMessage($request->input());
        if (!auth()->check()) return back();
        if ($ticket->status === 'closed')
            return back()->withErrors(['error' => 'Вы не можете отправить сообщение']);
        $message->save();
        $previous = $this->ticketMessageRepository->getPreviousTicketMessages($message->id);
        foreach ($previous as $p) {
            if (!$p->read) $p->update(['read' => 1]);
        }
        return back()->with(['success' => 'Сообщение успешно добавлено']);
    }
}
