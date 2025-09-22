@php
  $width = $width ?? '42';
  $height = $height ?? '22';
@endphp

<span class="text-primary">
  <img src="{{ asset('assets/img/branding/logo.png') }}" alt="logo" width="{{ $width }}" >
</span>
