<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\StoreTicketMessageRequest;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TicketController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $query = $request->query('query');
        $tickets = $this->ticketRepository->getAdminIndexFiltered($query);
        return response()->json(['query' => $query, 'tickets' => $tickets], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $ticket = $this->ticketRepository->getAdminShow($id);
        $messages = $this->ticketMessageRepository->getMessagesOfTicket($id);
        $authUser = ['id' => auth()->id(), 'login' => auth()->user()->login, 'avatar' => auth()->user()->avatar];
        return response()->json(['ticket' => $ticket, 'messages' => $messages, 'authUser' => $authUser], 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function storeMessage(StoreTicketMessageRequest $request)
    {
        $ticket = $this->ticketRepository->getAdminShow($request->input('ticket_id'));
        $message = new TicketMessage($request->input());
        if (auth()->user()->role_id !== 4) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        if ($ticket->status === 'closed')
            return response()->json(['error' => 'Вы не можете отправить сообщение'], 422);
        if ($ticket->status === 'processing') $ticket->update(['status' => 'opened']);
        $message->save();
        $previous = $this->ticketMessageRepository->getPreviousTicketMessages($message->id);
        foreach ($previous as $p) {
            if (!$p->read) $p->update(['read' => 1]);
        }
        return response()->json(['success' => 'Сообщение успешно добавлено'], 200);
    }

    public function closeTicket($id)
    {
        $ticket = $this->ticketRepository->getOne($id);
        $messages = $this->ticketMessageRepository->getMessagesOfTicket($id);
        if (Gate::denies('update', $ticket)) return response()->json(['errors' => 'Недостаточно прав для выполнения этого действия', 'forbidden' => 1], 401);
        foreach ($messages as $message) {
            if (!$message->read) $message->update(['read' => 1]);
        }
        if ($ticket->status !== 'closed')
            $ticket->update(['status' => 'closed']);
        return response()->json(['success' => 'Вопрос закрыт'], 200);
    }

    public function getProcessingTicketsAndUnreadMessages()
    {
        $tickets = $this->ticketRepository->getCountOfProcessingTickets();
        $messages = $this->ticketMessageRepository->getCountOfUnreadMessages();
        return response()->json(['tickets' => $tickets, 'messages' => $messages], 200);
    }
}
