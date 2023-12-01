<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight py-1">
        {{ __('Building Model') }}
      </h2>
      @auth
      <form action="{{ route('item.create')}}" method="get">
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
  <h1 class="font-black text-3xl text-gray-900 dark:text-gray-100 text-center py-6">View piDSS Building</h1>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-3">
    <div class=" text-gray-900 dark:text-gray-100 overflow-hidden border rounded-lg dark:border-slate-700 border-slate-600 p-6 flex gap-3 justify-between flex-col-reverse md:flex-row">
      <div class="self-center">
        <p>Name: {{$building->name}}</p>
        <p>Power: {{$building->calculatePowerConsumption()}} kwh</p>
        <div class="inline-grid gap-4 grid-cols-2 w-full py-3">
          <form action="{{ route('building.edit', $building)}}" method="get">
            @csrf
            <x-primary-button class="w-full justify-center bg-green-600 dark:bg-green-600 focus:bg-green-400 focus-visible:bg-green-400 hover:bg-green-400 active:bg-green-400 dark:focus:bg-green-400 dark:focus-visible:bg-green-400 dark:hover:bg-green-400 dark:active:bg-green-400 text-white dark:text-white">
              {{__('Edit')}}
            </x-primary-button>
          </form>
          <form action="{{ route('building.destroy', $building)}}" method="post">
            @csrf
            @method('delete')
            <x-primary-button class="w-full justify-center bg-red-600 dark:bg-red-600 focus:bg-red-400 focus-visible:bg-red-400 hover:bg-red-400 active:bg-red-400 dark:focus:bg-red-400 dark:focus-visible:bg-red-400 dark:hover:bg-red-400 dark:active:bg-red-400 text-white dark:text-white">
              {{__('Delete')}}
            </x-primary-button>
          </form>
        </div>
      </div>
      <div class="self-center">
        <img src="https://placehold.co/400x300/png" alt="">
      </div>
    </div>
    <form action="{{ route('room.create')}}" method="get" class="py-4">
      @csrf
      <x-input-error :messages="$errors->get('message')" />
      <x-primary-button class="bg-green-600 dark:bg-green-600 focus:bg-green-400 focus-visible:bg-green-400 hover:bg-green-400 active:bg-green-400 dark:focus:bg-green-400 dark:focus-visible:bg-green-400 dark:hover:bg-green-400 dark:active:bg-green-400 text-white dark:text-white">
        {{__('Create Room')}}
      </x-primary-button>
    </form>
    <div class="grid grid-cols-[repeat(auto-fit,_minmax(150px,300px))] gap-3 justify-center">
      @foreach($rooms as $room)
      <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg border border-slate-600 p-4 flex justify-between flex-col">
        <div>
          <p>Room Name: {{$room->name}}</p>
          <p>Power: {{$room->calculatePowerForRoom()}} kwh</p>
        </div>
        <div class="inline-grid gap-4 grid-cols-2 w-full mt-3">
          <form action="{{ route('room.show', $room)}}" method="get">
            @csrf
            <x-primary-button class="w-full justify-center dark:hover:bg-white dark:focus:bg-white">
              {{__('View')}}
            </x-primary-button>
          </form>
          <form action="{{ route('room.edit', $room)}}" method="get">
            @csrf
            <x-primary-button class="w-full justify-center bg-green-600 dark:bg-green-600 focus:bg-green-400 focus-visible:bg-green-400 hover:bg-green-400 active:bg-green-400 dark:focus:bg-green-400 dark:focus-visible:bg-green-400 dark:hover:bg-green-400 dark:active:bg-green-400 text-white dark:text-white">
              {{__('Edit')}}
            </x-primary-button>
          </form>
          <form action="{{ route('room.destroy', $room)}}" method="post" class="col-span-full">
            @csrf
            @method('delete')
            <x-primary-button class="w-full justify-center bg-red-600 dark:bg-red-600 focus:bg-red-400 focus-visible:bg-red-400 hover:bg-red-400 active:bg-red-400 dark:focus:bg-red-400 dark:focus-visible:bg-red-400 dark:hover:bg-red-400 dark:active:bg-red-400 text-white dark:text-white">
              {{__('Delete')}}
            </x-primary-button>
          </form>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endauth
</x-app-layout>