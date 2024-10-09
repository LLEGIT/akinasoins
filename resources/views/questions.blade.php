<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!DOCTYPE html>
<html>
<head>
    <title>ChatGPT Integration</title>
</head>
<body>
    <h1>Chat avec ChatGPT</h1>
    
    <form method="POST" action="{{ route('ask.chatgpt') }}">
        @csrf
        <label for="prompt">Posez votre question :</label><br><br>
        <input name="response" label="oui" type="submit" value="oui">
        <input name="response" label="non" type="submit" value="non">
    </form>
  
    @if (isset($response))
        <p>{{ $response }}</p>
    @endif
</body>
</html>

</html>
