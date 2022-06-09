<!-- Client Stake Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_stake_id', 'Client Stake Id:') !!}
    {!! Form::text('client_stake_id', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Message Field -->
<div class="form-group col-sm-6">
    {!! Form::label('message', 'Message:') !!}
    {!! Form::text('message', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Stake Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stake_date', 'Stake Date:') !!}
    {!! Form::text('stake_date', null, ['class' => 'form-control','id'=>'stake_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#stake_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush