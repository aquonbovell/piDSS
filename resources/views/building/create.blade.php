<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight py-1">
        {{ __('Building Model') }}
      </h2>
    </div>
  </x-slot>
  @auth
  <div class="max-w-xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg dark:shadow-slate-700 p-6">
      <h2 class="py-3 font-black text-3xl text-gray-900 dark:text-gray-100 text-center">Create piDSS Building</h2>
      <form method="POST" action="{{ route('building.store') }}">
        @csrf
        <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
          <x-input-label for="annual_consumption" :value="__('Annual Consumption')" />
          <x-text-input id="annual_consumption" class="block mt-1 w-full" type="number" name="annual_consumption" :value="old('annual_consumption')" required autofocus autocomplete="annual_consumption" />
          <x-input-error :messages="$errors->get('annual_consumption')" class="mt-2" />
        </div>
        <div class="py-4">
          <x-primary-button class="dark:hover:bg-white dark:focus:bg-white">
            {{ __('Create') }}
          </x-primary-button>
        </div>
      </form>
    </div>
  </div>
  @endauth
</x-app-layout>