<div class="p-6 w-auto h-auto flex flex-col shadow-md shadow-gray-300">
    <h2 class="mt-6 text-xl font-semibold text-gray-900">{{ $detalles->titulo }}</h2>

    <div id="divA" class="hidden">
        <div class="flex fle-row justify-start items-center pt-2 gap-2">
            <span class="flex justify-start items-center text-sm ">{{ $detalles->empresa->ra_social }}</span>
            <div class="flex justify-center items-center">
                <span class="border-e h-5  border-gray-400"></span>
            </div>
            <span class="flex justify-start items-center text-sm ">{{ $detalles->ubicacion }} </span>
        </div>
    </div>
    <div id="divC" class="hidden">
        <div class=" flex gap-2 font-bold ">
            <span class="flex justify-start items-center text-sm ">{{ $detalles->remuneracion }}</span>
        </div>
    </div>
    <div id="divB" class="hidden">
        <div class="flex fle-row justify-start items-center pt-2 gap-2">
            <span class="flex justify-start items-center text-sm ">{{ $detalles->empresa->ra_social }}</span>
            <div class="flex justify-center items-center">
                <span class="border-e h-5  border-gray-400"></span>
            </div>
            <span class="flex justify-start items-center text-sm ">{{ $detalles->ubicacion }} </span>
            <div class="flex justify-center items-center">
                <span class="border-e h-5  border-gray-400"></span>
            </div>
            <span class="flex justify-start items-center text-sm ">{{ $detalles->remuneracion }} </span>
        </div>
    </div>
    <div class="flex flex-row gap-4 py-4">
        <a href="{{ route('postulante', ['id' => $detalles->id]) }}" class="rounded-lg py-2 px-4 text-white bg-blue-600 font-bold">Postulate
            ahora</a>

        {{-- @php
            $user = Auth::user();
            $userRoleName = $user ? ($user->roles->isNotEmpty() ? $user->roles->first()->name : null) : null;
        @endphp
        @if (Auth::check())
        @php
            $user = Auth::user();
            $userRoleName = $user->roles->isNotEmpty() ? $user->roles->first()->name : null;
        @endphp

        @if ($userRoleName === 'Postulante')
            <a href="{{ route('postulante', ['id' => $detalles->id]) }}"
                class="rounded-lg py-2 px-4 text-white bg-blue-600 font-bold">Postulate ahora</a>
        @else
            <a class="rounded-lg py-2 px-4 text-white bg-blue-600 font-bold">Aun no tienes un rol</a>
        @endif
    @else
    <a href="{{ route('postulante', ['id' => $detalles->id]) }}" class="rounded-lg py-2 px-4 text-white bg-blue-600 font-bold">Postulate
        ahora</a>
    @endif --}}
        <a href="" class="rounded-lg py-2 px-4 text-gray-800 bg-gray-300 font-bold"><i
                class="fa-regular fa-bookmark"></i></a>

    </div>
</div>
<div class="max-h-[34rem] overflow-y-auto" id="scrollableDiv">
    <div class="p-6 w-auto h-auto flex flex-col border-b border-gray-400">
        <h2 class="mt-6 text-xl font-semibold text-gray-900">Informacion del empleo</h2>
        <h6 class="text-xs font-bold text-gray-400">Así es como las especificaciones del empleo
            se
            alinean con tu perfil</h6>
        <div class="flex fle-row justify-start items-center pt-2 gap-2">
            <span class="flex justify-start items-center text-sm ">{{ $detalles->empresa->ra_social }}</span>
            <div class="flex justify-center items-center">
                <span class="border-e h-5  border-gray-400"></span>
            </div>
            <span class="flex justify-start items-center text-sm ">{{ $detalles->ubicacion }} </span>
        </div>
        <div class="flex flex-col gap-6">
            <div class="flex flex-row gap-4">
                <samp class="flex justify-start items-start"><i class="fa-solid fa-circle-dollar-to-slot"></i></samp>
                <div class="flex flex-col gap-2 font-bold ">
                    <h2 class=" text-md font-semibold text-gray-900 justify-start items-center flex">
                        Sueldo</h2>
                    <span
                        class="flex justify-start items-center text-sm bg-gray-200 rounded-md py-1 px-2">{{ $detalles->remuneracion }}
                    </span>
                </div>
            </div>
            <div class="flex flex-row gap-4">
                <samp class="flex justify-start items-start"><i class="fa-solid fa-suitcase"></i></samp>
                <div class="flex flex-col gap-2 font-bold ">
                    <h2 class=" text-md font-semibold text-gray-900 justify-start items-center flex">
                        Tipo de empleo</h2>
                    <span class="flex justify-start items-center text-sm bg-gray-200 rounded-md py-1 px-2">Tiempo
                        completo</span>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 w-auto h-auto flex flex-col">
        <div class="flex flex-col">
            <h2 class="mt-6 text-xl font-semibold text-gray-900">Ubicacion</h2>

            <div class="flex fle-row justify-start items-center pt-2 gap-2">
                <span class="flex justify-start items-center text-sm ">{{ $detalles->ubicacion }}</span>
            </div>
        </div>
        <samp class="border-b border-gray-400 py-2"></samp>
        <div class="flex flex-col">
            <h2 class="mt-6 text-xl font-semibold text-gray-900">Descripción completa del
                empleo
            </h2>

            <div class="flex fle-row justify-start items-center pt-2 gap-2">
                <p>
                    {{ $detalles->body }}
                </p>
            </div>
        </div>
        <samp class="border-b border-gray-400 py-2"></samp>
        <div class="flex flex-col">

            <div class="flex fle-row justify-start items-center pt-2 gap-2">
                <span
                    class="gap-2 flex justify-start items-center text-sm bg-gray-300 rounded-md text-black py-2 px-6 font-bold flex-row">
                    <samp><i class="fa-solid fa-flag"></i></samp>
                    <h1>Reportar empleo</h1>
                </span>
            </div>
        </div>
    </div>
</div>



<script>
    const scrollableDiv = document.getElementById('scrollableDiv');
    const divA = document.getElementById('divA');
    const divB = document.getElementById('divB');
    const divC = document.getElementById('divC');

    let isDivAVisible = false;
    let isDivBVisible = false;
    let isDivCVisible = false;

    scrollableDiv.addEventListener('scroll', function() {
        const isScrollingUp = this.scrollTop < this.previousScrollTop;
        this.previousScrollTop = this.scrollTop;

        if (isScrollingUp && !isDivAVisible) {
            divA.classList.remove('hidden');
            divA.classList.add('block');
            isDivAVisible = true;
        } else if (!isScrollingUp && isDivAVisible) {
            divA.classList.remove('block');
            divA.classList.add('hidden');
            isDivAVisible = false;
        }

        if (!isScrollingUp && !isDivBVisible) {
            divB.classList.remove('hidden');
            divB.classList.add('block');
            isDivBVisible = true;
        } else if (isScrollingUp && isDivBVisible) {
            divB.classList.remove('block');
            divB.classList.add('hidden');
            isDivBVisible = false;
        }

        if (isScrollingUp && !isDivCVisible) {
            divC.classList.remove('hidden');
            divC.classList.add('block');
            isDivCVisible = true;
        } else if (!isScrollingUp && isDivCVisible) {
            divC.classList.remove('block');
            divC.classList.add('hidden');
            isDivCVisible = false;
        }
    });
</script>
