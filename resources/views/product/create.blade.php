@extends('layouts.modal')
@section('title')
    <h5><i class="fa fa-plus-square"></i> Create Product</h5>
@endsection
@section('content')
    {!! html()->form('POST', route('products.store'))->class('form-horizontal')->id('dataForm')->attribute('enctype', 'multipart/form-data')->open() !!}
    <div class="modal-body">
        <div class="col-md-12 my-2">
            {!! html()->label('Name')->class('form-label required')->for('name') !!}
            {!! html()->text('name')->class('form-control')->placeholder('Name')->autofocus() !!}
        </div>
        <div class="col-md-12 my-2">
            {!! html()->label('Price')->class('form-label required')->for('price') !!}
            {!! html()->number('price')->class('form-control')->autofocus() !!}
        </div>
        <div class="col-md-12 my-2">
            {!! html()->label('Discount')->class('form-label required')->for('discount') !!}
            {!! html()->number('discount')->class('form-control')->autofocus() !!}
        </div>
        <div class="col-md-12 my-2">
            {!! html()->label('Status')->class('form-label required')->for('status') !!}
            {!! html()->select('status')->options(['publish' => 'Publish', 'publish' => 'Unpublish'])->class('form-control') !!}
        </div>
        <div class="col-md-12 my-2">
            {!! html()->label('Thumbnail')->class('form-label required')->for('thumbnail') !!} <br>
            {!! html()->file('thumbnail') !!}
        </div>
        <div class="col-md-12 my-2">
            {!! html()->label('Product Images')->class('form-label required')->for('images') !!} <br>
            {!! html()->file('images[]')->multiple() !!}
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
        <button name="actionBtn" id="actionButton" type="submit" value="submit" class="actionButton btn btn-primary btn-sm float-right"><i class="fa fa-save"></i> Save </button>
    </div>
    {!! html()->form()->close() !!}
@endsection
