<div class="table-responsive">
    <table class="table" id="messages-table">
        <thead>
        <tr>
            <th>User</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($messages as $message)
            <tr>
                <td>{{ $message->client->name }}</td>
                <td>{{ $message->message }}</td>
                <td>{{ $message->stake_date }}</td>
                {{-- <td width="120">
                    {!! Form::open(['route' => ['admin.messages.destroy', $message->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('admin.messages.show', [$message->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.messages.edit', [$message->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td> --}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
