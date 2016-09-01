<div class="row">
    <div class="col-sm-6 col-md-4 col-lg-2 col-sm-offset-3 col-md-offset-4 col-lg-offset-5">
        {!! Form::model($account, ['route' => 'accounts.store']) !!}
            <div class="form-group">
                {!! Form::label('name') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'autofocus']) !!}
            </div>

            {!! Form::submit(null, ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
