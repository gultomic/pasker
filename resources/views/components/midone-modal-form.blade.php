@props([
    'header',
    'size' => 'medium',
])

@php
    switch ($size) {
        case 'small':
            $modalSize = 'modal-sm';
            break;
        case 'large':
            $modalSize = 'modal-lg';
            break;
        case 'extra-large':
            $modalSize = 'modal-xl';
            break;
        case 'medium':
        default:
            $modalSize = '';
            break;
    }
@endphp
<!-- BEGIN: Modal Content -->
<div id="midone-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog {{ $modalSize }}">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="mr-auto text-base font-medium">{{ $header }}</h2>
            </div>

            {{ $slot }}

            <div class="text-right modal-footer">
                {{ $footer }}
            </div>
        </div>
    </div>
</div>
<!-- END: Modal Content -->
