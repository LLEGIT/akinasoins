<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT Integration</title>
</head>
<body>
    <h1>Chat avec ChatGPT</h1>
    
    <form method="POST" action="{{ route('ask.chatgpt') }}">
        @csrf
        <label for="prompt">Posez votre question :</label><br><br>
        <textarea name="prompt" id="prompt" rows="4" cols="50" required></textarea><br><br>
        <button type="submit">Envoyer</button>
    </form>

    @if (isset($response))
        <h2>Réponse de ChatGPT :</h2>
        <p>{{ $response }}</p>
    @endif
</body>
</html>
