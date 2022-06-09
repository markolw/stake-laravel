<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Message;
use App\Models\Client;
use Illuminate\Http\Request;
use Flash;
use Response;

class MessageController extends AppBaseController
{
    /**
     * Display a listing of the Message.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $messages = Message::with(['client'])->all()->toJson();
        $users = Client::all()->all()->toJson();
        dd($messages, $users);

        return view('admin.messages.index', compact('messages', 'users'));
    }

    /**
     * Show the form for creating a new Message.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.messages.create');
    }

    /**
     * Store a newly created Message in storage.
     *
     * @param CreateMessageRequest $request
     *
     * @return Response
     */
    public function store(CreateMessageRequest $request)
    {
        $input = $request->all();

        /** @var Message $message */
        $message = Message::create($input);

        Flash::success('Message saved successfully.');

        return redirect(route('admin.messages.index'));
    }

    /**
     * Display the specified Message.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Message $message */
        $message = Message::find($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('admin.messages.index'));
        }

        return view('admin.messages.show')->with('message', $message);
    }

    /**
     * Show the form for editing the specified Message.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Message $message */
        $message = Message::find($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('admin.messages.index'));
        }

        return view('admin.messages.edit')->with('message', $message);
    }

    /**
     * Update the specified Message in storage.
     *
     * @param int $id
     * @param UpdateMessageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMessageRequest $request)
    {
        /** @var Message $message */
        $message = Message::find($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('admin.messages.index'));
        }

        $message->fill($request->all());
        $message->save();

        Flash::success('Message updated successfully.');

        return redirect(route('admin.messages.index'));
    }

    /**
     * Remove the specified Message from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Message $message */
        $message = Message::find($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('admin.messages.index'));
        }

        $message->delete();

        Flash::success('Message deleted successfully.');

        return redirect(route('admin.messages.index'));
    }
}
