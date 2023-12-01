<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('PV System Catalog') }}
      </h2>
      @auth
      <form action="{{ route('system.create')}}" method="get">
        @csrf
        <x-input-error :messages="$errors->get('message')" />
        <x-primary-button class="bg-green-600 dark:bg-green-600 focus:bg-green-400 focus-visible:bg-green-400 hover:bg-green-400 active:bg-green-400 dark:focus:bg-green-400 dark:focus-visible:bg-green-400 dark:hover:bg-green-400 dark:active:bg-green-400 text-white dark:text-white">
          {{__('Create System')}}
        </x-primary-button>
      </form>
      @endauth
    </div>
  </x-slot>
  @auth
  <h1 class="py-3 font-black text-3xl text-gray-900 dark:text-gray-100 text-center">View PV System</h1>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 px-3">
    <div class=" text-gray-900 dark:text-gray-100 overflow-hidden border rounded-lg dark:border-slate-600 border-slate-700 p-6 flex gap-6 justify-between flex-col-reverse md:flex-row">
      <div class="self-center">
        <p>Name: {{$system->name}}</p>
        <p>Building: {{$system->building->name}}</p>
        <p>Total Equipment Cost: ${{number_format($system->calculateTotalCost(),2)}}</p>
        <p>Total Energy: {{number_format($system->calculateTotalEnergy())}} kwh</p>
        <div class="inline-grid gap-4 grid-cols-2 w-full py-3">
          <form action="{{ route('system.edit', $system)}}" method="get">
            @csrf
            <x-primary-button class="w-full justify-center bg-green-600 dark:bg-green-600 focus:bg-green-400 focus-visible:bg-green-400 hover:bg-green-400 active:bg-green-400 dark:focus:bg-green-400 dark:focus-visible:bg-green-400 dark:hover:bg-green-400 dark:active:bg-green-400 text-white dark:text-white">
              {{__('Edit')}}
            </x-primary-button>
          </form>
          <form action="{{ route('system.destroy', $system)}}" method="post">
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
    <form action="{{ route('equipment.create')}}" method="get" class="py-4">
      @csrf
      <x-input-error :messages="$errors->get('message')" />
      <x-primary-button class="bg-green-600 dark:bg-green-600 focus:bg-green-400 focus-visible:bg-green-400 hover:bg-green-400 active:bg-green-400 dark:focus:bg-green-400 dark:focus-visible:bg-green-400 dark:hover:bg-green-400 dark:active:bg-green-400 text-white dark:text-white">
        {{__('Add Equipment')}}
      </x-primary-button>
    </form>
    <div class="grid grid-cols-[repeat(auto-fit,_minmax(150px,300px))] gap-3 justify-center">
    @foreach($system->equipments as $equipment)
      <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg border border-slate-600 p-4 flex justify-between flex-col gap-3">
        <div>
          <p>Category: {{ucwords($equipment->item->category)}}</p>
          <p>Name: {{$equipment->item->name}}</p>
          <p>Quantity: {{number_format($equipment->quantity,0)}}</p>
          <p>Cost: ${{number_format($equipment->quantity * $equipment->item->price,2)}}</p>
        </div>
        <div class="inline-grid gap-4 grid-cols-2 w-full">
          <form action="{{ route('equipment.show', $equipment)}}" method="get">
            @csrf
            <x-primary-button class="w-full justify-center dark:hover:bg-white dark:focus:bg-white">
              {{__('View')}}
            </x-primary-button>
          </form>
          <form action="{{ route('equipment.edit', $equipment)}}" method="get">
            @csrf
            <x-primary-button class="w-full justify-center bg-green-600 dark:bg-green-600 focus:bg-green-400 focus-visible:bg-green-400 hover:bg-green-400 active:bg-green-400 dark:focus:bg-green-400 dark:focus-visible:bg-green-400 dark:hover:bg-green-400 dark:active:bg-green-400 text-white dark:text-white">
              {{__('Edit')}}
            </x-primary-button>
          </form>
          <form action="{{ route('equipment.destroy', $equipment)}}" method="post" class="col-span-full">
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