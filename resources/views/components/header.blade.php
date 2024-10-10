<div
    class="w-full h-52 flex justify-center items-center {{ Route::current()->getName() == 'home' ? 'bg-cornFlower' : (Route::current()->getName() == 'questions' ? 'bg-tealDeer' : 'bg-ruddyPink') }}">
    <h1 class="text-white text-6xl">
        {{ Route::current()->getName() == 'home' ? 'Accueil' : (Route::current()->getName() == 'statistics' ? 'Page statistiques' : 'Diagnostic') }}
    </h1>
</div>
