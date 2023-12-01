<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight py-1">
        {{ __('Building Model') }}
      </h2>
      @auth
      <form action="{{ route('building.create')}}" method="get">
        @csrf
        <x-input-error :messages="$errors->get('message')" />
        <x-primary-button class="bg-green-600 dark:bg-green-600 focus:bg-green-400 focus-visible:bg-green-400 hover:bg-green-400 active:bg-green-400 dark:focus:bg-green-400 dark:focus-visible:bg-green-400 dark:hover:bg-green-400 dark:active:bg-green-400 text-white dark:text-white">
          {{__('Model Building')}}
        </x-primary-button>
      </form>
      @endauth
    </div>
  </x-slot>
  @auth
  <div class="max-w-7xl mx-auto lg:px-8 px-4">
    <h2 class="font-black text-3xl text-gray-900 dark:text-gray-100 text-center py-6">List Building Models</h2>
    @if(count($buildings) > 0 )
    <div class="grid grid-cols-[repeat(auto-fit,_minmax(250px,1fr))] gap-4 justify-between">
      @foreach ($buildings as $building)
      <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg border dark:border-slate-700 border-slate-600 p-4 flex flex-col max-w-md mx-auto w-full">
        <div>
          <p>Name: {{$building->name}}</p>
          <p>Power: {{$building->calculatePowerConsumption()}} kwh</p>
        </div>
        <div class="inline-grid gap-4 grid-cols-2 w-full pt-3">
          <form action="{{ route('building.show', $building)}}" method="get">
            @csrf
            <x-input-error :messages="$errors->get('message')" />
            <x-primary-button class="w-full justify-center dark:hover:bg-white dark:focus:bg-white">
              {{__('View')}}
            </x-primary-button>
          </form>
          <form action="{{ route('building.edit' ,$building)}}" method="get">
            @csrf
            <x-input-error :messages="$errors->get('message')" />
            <x-primary-button class="bg-green-600 dark:bg-green-600 focus:bg-green-400 focus-visible:bg-green-400 hover:bg-green-400 active:bg-green-400 dark:focus:bg-green-400 dark:focus-visible:bg-green-400 dark:hover:bg-green-400 dark:active:bg-green-400 text-white dark:text-white w-full justify-center">
              {{__('Edit')}}
            </x-primary-button>
          </form>
          <form action="{{ route('building.destroy', $building)}}" method="post" class="col-span-full">
            @csrf
            @method('delete')
            <x-input-error :messages="$errors->get('message')" />
            <x-primary-button class="w-full justify-center bg-red-600 dark:bg-red-600 focus:bg-red-400 focus-visible:bg-red-400 hover:bg-red-400 active:bg-red-400 dark:focus:bg-red-400 dark:focus-visible:bg-red-400 dark:hover:bg-red-400 dark:active:bg-red-400 text-white dark:text-white">
              {{__('Delete')}}
            </x-primary-button>
          </form>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg dark:shadow-slate-700 p-6 text-center font-bold text-xl">
      No buildings in the piDSS
    </div>
    @endif
  </div>
  @endauth
</x-app-layout>