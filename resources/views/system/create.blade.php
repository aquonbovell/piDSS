<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-baseline">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight py-1">
      {{ __('PV System Catalog') }}
      </h2>
    </div>
  </x-slot>
  @auth
  <div class="max-w-lg mx-auto">
    <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg dark:shadow-slate-700 p-6">
      <h2 class="py-3 font-black text-3xl text-gray-900 dark:text-gray-100 text-center">Create PV System</h2>
      <form method="POST" action="{{ route('system.store') }}">
        @csrf
        <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <x-input-label for="building_id" :value="__('Building')" />
        <select name="building_id" id="building_id" class="w-full bg-gray-900 rounded-md">
          <option value="" selected disabled hidden>No Building</option>
          @foreach ($buildings as $building)
          <option value="{{$building->id}}" {{old('category') == "battery" ? "selected" :""}}>{{$building->name}}</option>
          @endforeach
        </select>
        <x-input-error :messages="$errors->get('building_id')" class="mt-2" />
        <div class="py-4">
          <x-primary-button class="dark:hover:bg-white dark:focus:bg-white">
            {{ __('Create System') }}
          </x-primary-button>
        </div>
      </form>
    </div>
  </div>
  @endauth
</x-app-layout>