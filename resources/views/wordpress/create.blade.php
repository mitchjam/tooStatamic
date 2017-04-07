@extends('layout')

@section('content')
<div class="columns">
    <form action="/convert/wordpress" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <h2 class="title" for="backup_file">Convert Your Wordpress Posts To Statamic</h2>
    
        <div class="field file-drop-area">
            <span class="fake-btn">Choose Export File</span>
            <span class="file-msg js-set-number">or drop it here...</span>
            <input class="file-input" type="file" name="export_file">
        </div>
    
        <div class="field">
            <p class="control">
                <button class="button is-primary">Convert</button>
            </p>
        </div>
    
    </form>
</div>
@endsection
