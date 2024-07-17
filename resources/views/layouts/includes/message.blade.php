@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
            {!! $error !!}<br />
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session()->has('flash_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        @if (is_array(json_decode(session()->get('flash_success'), true)))
            {!! implode('', json_decode(session()->get('flash_success'), true)) !!}
        @else
            {!! session()->get('flash_success') !!}
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php session()->forget('flash_success'); ?>
@elseif (session()->has('flash_warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        @if (is_array(json_decode(session()->get('flash_warning'), true)))
            {!! implode('', json_decode(session()->get('flash_warning'), true)) !!}
        @else
            {!! session()->get('flash_warning') !!}
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php session()->forget('flash_warning'); ?>
@elseif (session()->has('flash_info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        @if (is_array(json_decode(session()->get('flash_info'), true)))
            {!! implode('', json_decode(session()->get('flash_info'), true)) !!}
        @else
            {!! session()->get('flash_info') !!}
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php session()->forget('flash_info'); ?>
@elseif (session()->has('flash_danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @if (is_array(json_decode(session()->get('flash_danger'), true)))
            {!! implode('', json_decode(session()->get('flash_danger'), true)) !!}
        @else
            {!! session()->get('flash_danger') !!}
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php session()->forget('flash_danger'); ?>
@elseif (session()->has('flash_message'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        @if (is_array(json_decode(session()->get('flash_message'), true)))
            {!! implode('', json_decode(session()->get('flash_message'), true)) !!}
        @else
            {!! session()->get('flash_message') !!}
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php session()->forget('flash_message'); ?>
@endif
