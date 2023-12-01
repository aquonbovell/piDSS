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
  <div class="max-w-xl mx-auto">
    <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg dark:shadow-slate-700 p-6">
      <h2 class="py-3 font-black text-3xl text-gray-900 dark:text-gray-100 text-center">Edit PV System</h2>
      <form method="POST" action="{{ route('system.update' ,$system) }}">
        @csrf
        @method('patch')
        <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name' , $system->name)" required autofocus autocomplete="name" />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <x-input-label for="building_id" :value="__('Building')" />
        <select name="building_id" id="building_id" class="w-full bg-gray-900 rounded-md">
          @foreach ($buildings as $building)
          <option value="{{$building->id}}" {{old('building_id' , $system->building_id) == $building->id ? "selected" :""}}>{{$building->name}}</option>
          @endforeach
        </select>
        <x-input-error :messages="$errors->get('building_id')" class="mt-2" />
        <div class="py-4">
          <x-primary-button class="dark:hover:bg-white dark:focus:bg-white">
            {{ __('Update System') }}
          </x-primary-button>
        </div>
      </form>
    </div>
  </div>
  @endauth
</x-app-layout>