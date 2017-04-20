@extends('layout')

@section('content')
<section class="section">
    <div class="columns">
        <div class="column is-half-desktop is-offset-one-quarter">
            <form action="{{ route('convert.wordpress') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <h2 class="title">Wordpress Posts <i class="fa fa-arrow-right fa-center"></i> Statamic Files</h2>
            
                <div class="field file-drop-area">
                    <h4 class="file-msg js-set-number">Select your XML export file or drop it here...</h4>
                    <input class="file-input" type="file" name="export_file">
                </div>
            
                <div class="field is-grouped">
                    <p class="control">
                        <button class="button is-primary is-outlined">Convert</button>
                    </p>

                    <p class="control is-expanded">
                        <a href="https://codex.wordpress.org/Tools_Export_Screen" class="help is-dark is-pulled-right" target="_blank">Get your Wordpress export file.</a>
                    </p>
                </div>
            
            </form>
            
        </div>
    </div>
</section>

<hr>

<div class="modal">
    <div class="modal-background"></div>
    <div class="modal-content">

        <div class="box">
            <form action="{{ route('inquire') }}" method="POST">
                {{ csrf_field() }}

                <div class="field">
                    <label for="from" class="field-label">Email</label>
                    <p class="control">
                        <input class="input" type="email" name="from">
                    </p>
                </div>
                  
                <div class="field">
                    <label for="description" class="field-label">Describe the Conversion. (Current CMS, Type of content, etc.)</label>
                    <p class="control">
                        <textarea class="textarea" name="description"></textarea>
                    </p>
                </div>

                <div class="field">
                    <p class="control">
                       <button class="button is-primary is-outlined">Submit</button>
                     </p>
                </div>
            </form>
        </div>

    </div>
    <button class="modal-close"></button>
</div>

<section class="section has-text-centered">
    <button class="inquire button is-medium is-danger is-outlined">Need a custom conversion? We can help, it's what we do.</button>
</section>
@endsection
