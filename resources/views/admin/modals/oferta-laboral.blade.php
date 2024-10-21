<div>
    <x-dialog-modal wire:model="isOpen" maxWidth="lg">
        <x-slot name="title">
            @if ($ruteCreate)
            <h3 class="text-center">Registrar nueva Oferta Laboral</h3>
            @else
            <h3 class="text-center">Actualizar Oferta Laboral</h3>
            @endif
        </x-slot>
        <x-slot name="content">
            <form autocomplete="off">

                <input type="hidden" wire:model="oferta_laboral.id">
                <div class="flex flex-col sm:flex-row gap-2.5 w-full px-2">
                    <div class="flex flex-col gap-2.5 w-full">
                        <div class="mb-1 w-full">
                            <x-label value="Titulo " class="font-bold" />
                            <x-input class="w-full" type="text" wire:model="ofertaLaboral.titulo" />
                            @unless (!empty($ofertaLaboral['titulo']))
                            <x-input-error for="ofertaLaboral.titulo" />
                            @endunless
                        </div>
                        <div>
                            <x-label value="Descripcion de la ofertaLaboral" class="font-bold" />
                            <x-input class="w-full" type="text" wire:model="ofertaLaboral.descripcion" />
                            @unless (!empty($ofertaLaboral['descripcion']))
                            <x-input-error for="ofertaLaboral.descripcion" />
                            @endunless
                        </div>
                        <div>
                            <x-label value="Detalles de la ofertaLaboral" class="font-bold" />
                            <textarea class="w-full rounded-md" wire:model="ofertaLaboral.body"></textarea>
                            @unless (!empty($ofertaLaboral['body']))
                            <x-input-error for="ofertaLaboral.body" />
                            @endunless
                        </div>
                        <div class="mb-1 w-full">
                            <x-label value="Ubicacion " class="font-bold" />
                            <x-input class="w-full" type="text" wire:model="ofertaLaboral.ubicacion" />
                            @unless (!empty($ofertaLaboral['ubicacion']))
                            <x-input-error for="ofertaLaboral.ubicacion" />
                            @endunless
                        </div>
                        <div class="flex flex-row gap-2.5 justify-start">
                            <div class="w-1/2">
                                <x-label value="Remuneracion de la ofertaLaboral" class="font-bold" />
                                <x-input class="w-full" type="text" wire:model="ofertaLaboral.remuneracion" />
                                @unless (!empty($ofertaLaboral['remuneracion']))
                                <x-input-error for="ofertaLaboral.remuneracion" />
                                @endunless
                            </div>
                            <div class="w-1/2">
                                <x-label value="Limite de postulantes" class="font-bold" />
                                <x-input class="w-full" type="text" wire:model="ofertaLaboral.limite_postulante" />
                                @unless (!empty($ofertaLaboral['limite_postulante']))
                                <x-input-error for="ofertaLaboral.limite_postulante" />
                                @endunless
                            </div>
                        </div>

                        <div class="flex flex-row gap-2.5 justify-start">
                            <div class="flex-auto">
                                <x-label value="Fecha de Inicio" class="font-bold" />
                                <x-input class="w-full" type="date" wire:model="ofertaLaboral.fecha_inicio" />
                                @unless (!empty($ofertaLaboral['fecha_inicio']))
                                <x-input-error for="ofertaLaboral.fecha_inicio" />
                                @endunless
                            </div>
                            <div class="flex-auto">
                                <x-label value="Fecha de Cierre" class="font-bold" />
                                <x-input class="w-full" type="date" wire:model="ofertaLaboral.fecha_fin" />
                                @unless (!empty($ofertaLaboral['fecha_fin']))
                                <x-input-error for="ofertaLaboral.fecha_fin" />
                                @endunless
                            </div>
                        </div>


                        <div class="flex flex-col sm:flex-row gap-2.5">
                            <div class="flex-auto">
                                <x-label value="Estado" class="font-bold" />
                                <x-select wire:model="ofertaLaboral.state">
                                    <x-slot name="options">
                                        <option value="" selected>Seleccione...</option>
                                        <option value="1" {{ $ofertaLaboral['state'] ?? '' == 1 ? 'selected' : '' }}>
                                            Escondido
                                        </option>
                                        <option value="2" {{ $ofertaLaboral['state'] ?? '' == 2 ? 'selected' : '' }}>
                                            Visible
                                        </option>
                                    </x-slot>
                                </x-select>
                                @error('ofertaLaboral.state')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex-auto">
                                <x-label value="Empresa" class="font-bold" />
                                <x-select wire:model="ofertaLaboral.empresa_id">
                                    <x-slot name="options">
                                        <option value="" selected>Seleccione...</option>
                                        @foreach ($empresas as $empresa)
                                        <option value="{{ $empresa->id }}" {{ $ofertaLaboral['empresa_id'] ?? '' == $empresa->id ? 'selected' : '' }}>
                                            {{ $empresa->ra_social }}
                                        </option>
                                        @endforeach
                                    </x-slot>
                                </x-select>
                                @error('ofertaLaboral.empresa_id')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="flex-auto">
                                <x-label value="Categoria Laboral" class="font-bold" />
                                <x-select wire:model="ofertaLaboral.category_id">
                                    <x-slot name="options">
                                        <option value="" selected>Seleccione...</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $ofertaLaboral['category_id'] ?? '' == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </x-slot>
                                </x-select>
                                @error('ofertaLaboral.category_id')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div> --}}
                        </div>
                        <input hidden wire:model="ofertaLaboral.user" />
                    </div>
                    <input hidden wire:model="ofertaLaboral.user_id" />

                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-button-danger wire:click="$set('isOpen',false)">Cancelar</x-button-danger>
            <x-button-success wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store, image" class="disabled:opacity-25">
                @if ($ruteCreate)
                Registrar
                @else
                Actualizar
                @endif
            </x-button-success>
        </x-slot>

    </x-dialog-modal>
</div>
