<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight py-1">
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
  <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
    <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg dark:shadow-slate-700 p-6">
      <h2 class="py-3 font-black text-3xl text-gray-900 dark:text-gray-100 text-center">View PV System Equipment</h2>
      <div class=" text-gray-900 dark:text-gray-100 overflow-hidden border rounded-lg border-slate-700 p-6">
        <p>Name: {{$equipment->item->name}}</p>
        <p>Description: {{$equipment->item->description}}</p>
        <p>Price: ${{number_format($equipment->item->price,2)}}</p>
        <p>Category: {{ucwords($equipment->item->category)}}</p>
        <p>Quantity: {{number_format($equipment->quantity,0)}}</p>
        <p>Cost: ${{number_format($equipment->quantity * $equipment->item->price,2)}}</p>
      </div>
    </div>
  </div>
  @endauth
</x-app-layout>