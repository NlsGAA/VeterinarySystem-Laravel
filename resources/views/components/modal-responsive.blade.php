@props(['id' => null, 'title' => '', 'content' => '', 'footer' => ''])

<div class="container full-height d-flex justify-content-center align-items-center modal invisible" id="{{ $id }}">
    <div class="row shadow-lg bg-body-tertiary rounded z-3 position-absolute border border-danger-subtle w-25">
        <div class="p-4 mb-2">
            <div class="title text-center">
                <h3 class="text-secondary-emphasis"> {!! $title !!} </h3>
            </div>
            <div class="content text-center align-middle">
                <h3 class="text-danger-emphasis user-select-none"> {{ $content }} </h3>
            </div>
            <div class="footer text-center mt-4">
                {!! $footer !!}
            </div>
        </div>
    </div>
</div>