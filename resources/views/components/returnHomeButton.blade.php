<img class="w-16 h-16" class="height-80" src="{{ asset('images/returnHome.png') }}" alt="logo akinasoins" class="max-w-full h-auto" onclick="returnHome()">

<script>
    function returnHome() {
        window.location.href = "{{ url('/') }}"; 
        }
</script>
