<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '.NG Academy Certificate Generator' }}</title>
     <script src="https://cdn.tailwindcss.com"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @livewireStyles
</head>
<body>
<!-- Accessible green SVG spinner -->


<style>
  /* size is controlled by the wrapper width/height (64px here) */
  .green-spinner { display:block; }

  /* rotation */
  .green-spinner .spinner {
    transform-origin: 50% 50%;
    animation: spin 1.1s linear infinite, dash 1.6s ease-in-out infinite;
  }

  /* smooth continuous rotation */
  @keyframes spin {
    100% { transform: rotate(360deg); }
  }

  /* dash animation to create the chasing stroke effect */
  @keyframes dash {
    0% {
      stroke-dasharray: 1 200;
      stroke-dashoffset: 0;
    }
    50% {
      stroke-dasharray: 90 150;
      stroke-dashoffset: -35;
    }
    100% {
      stroke-dasharray: 1 200;
      stroke-dashoffset: -125;
    }
  }
</style>

    {{ $slot }}
     <x-toaster-hub />
    @livewireScripts
</body>
</html>