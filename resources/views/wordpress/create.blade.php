@extends('layout')

@section('content')
<div class="column is-half-desktop is-offset-one-quarter">
    <form action="/convert/wordpress" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <h2 class="title" for="backup_file">Wordpress Posts <i class="fa fa-arrow-right fa-center"></i> Statamic Files</h2>
    
        <div class="field file-drop-area">
            <h4 class="file-msg js-set-number">Choose Wordpress export file or drop it here...</h4>
            <input class="file-input" type="file" name="export_file">
        </div>
    
        <div class="field">
            <p class="control">
                <button class="button is-primary is-outlined">Convert</button>
            </p>
        </div>
    
    </form>
</div>
@endsection
