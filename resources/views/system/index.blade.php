<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-baseline">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-normal">
        {{ __('PV System Catalog') }}
      </h2>
      @auth
      <form action="{{ route('system.create')}}" method="get">
        @csrf
        <x-input-error :messages="$errors->get('message')" />
        <x-primary-button class="bg-green-600 dark:bg-green-600 focus:bg-green-400 focus-visible:bg-green-400 hover:bg-green-400 active:bg-green-400 dark:focus:bg-green-400 dark:focus-visible:bg-green-400 dark:hover:bg-green-400 dark:active:bg-green-400 text-white dark:text-white">
          {{__('Create PV System')}}
        </x-primary-button>
      </form>
      @endauth
    </div>
  </x-slot>
  @auth
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
    <h2 class="py-6 font-black text-3xl text-gray-900 dark:text-gray-100 text-center">List PV Systems</h2>
    @if(count($systems) > 0 )
    <div class="grid grid-cols-[repeat(auto-fit,_minmax(230px,1fr))] gap-3">
      @foreach ($systems as $system)
      <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg border border-slate-600 p-4 flex justify-between flex-col max-w-md mx-auto w-full">
        <div>
          <p>Name: {{$system->name}}</p>
          <p>Building: {{$system->building->name}}</p>
          <p>Total Equipment Cost: ${{number_format($system->calculateTotalCost(),2)}}</p>
          <p>Total Energy: {{number_format($system->calculateTotalEnergy())}} kwh</p>
        </div>
        <div class="inline-grid gap-4 grid-cols-2 w-full pt-3">
          <form action="{{ route('system.show', $system)}}" method="get">
            @csrf
            <x-primary-button class="w-full justify-center dark:hover:bg-white dark:focus:bg-white">
              {{__('View')}}
            </x-primary-button>
          </form>
          <form action="{{ route('system.edit', $system)}}" method="get">
            @csrf
            <x-primary-button class="w-full justify-center bg-green-600 dark:bg-green-600 focus:bg-green-400 focus-visible:bg-green-400 hover:bg-green-400 active:bg-green-400 dark:focus:bg-green-400 dark:focus-visible:bg-green-400 dark:hover:bg-green-400 dark:active:bg-green-400 text-white dark:text-white">
              {{__('Edit')}}
            </x-primary-button>
          </form>
          <form action="{{ route('system.destroy', $system)}}" method="post" class="col-span-full">
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
    @else
    <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg dark:shadow-slate-700 p-6 text-center font-bold text-xl">
      No PV Systems in the piDSS
    </div>
    @endif
  </div>
  @endauth
</x-app-layout>