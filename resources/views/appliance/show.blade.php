<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-baseline">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
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
  <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
    <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg dark:shadow-slate-700 p-6">
      <h2 class="py-3 font-black text-3xl text-gray-900 dark:text-gray-100 text-center">View piDSS Appliance</h2>
      <div class=" text-gray-900 dark:text-gray-100 overflow-hidden border rounded-lg dark:border-slate-700 border-slate-600 p-6">
        <p>Name: {{$appliance->name}}</p>
        <p>Power: {{$appliance->power}} kwh</p>
      </div>
    </div>
  </div>
  @endauth
</x-app-layout>