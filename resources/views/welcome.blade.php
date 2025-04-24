<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>نویگیشن با Livewire و Alpine.js</title>
  @livewireStyles
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    nav ul { list-style: none; padding: 0; display: flex; gap: 10px; }
    nav button { padding: 10px 20px; background: #f0f0f0; border: none; cursor: pointer; }
    nav button:hover { background: #ddd; }
    .content { margin-top: 20px; padding: 20px; background: #f9f9f9; border-radius: 5px; }
  </style>
</head>
<body>
<livewire:navigation-component />
@livewireScripts
</body>
</html>
