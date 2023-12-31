<x-app-layout>
  <x-slot name="header">
  <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight py-1">
        {{ __('Item Catalog') }}
      </h2>
      @auth
      <form action="{{ route('item.create')}}" method="get">
        @csrf
        <x-input-error :messages="$errors->get('message')" />
        <x-primary-button class="bg-green-600 dark:bg-green-600 focus:bg-green-400 focus-visible:bg-green-400 hover:bg-green-400 active:bg-green-400 dark:focus:bg-green-400 dark:focus-visible:bg-green-400 dark:hover:bg-green-400 dark:active:bg-green-400 text-white dark:text-white">
          {{__('Create Item')}}
        </x-primary-button>
      </form>
      @endauth
    </div>
  </x-slot>
  @auth
  <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
    <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg dark:shadow-slate-700 p-6">
      <h2 class="py-3 font-black text-3xl text-gray-900 dark:text-gray-100 text-center">Edit piDSS Item Attribute</h2>
      <form method="POST" action="{{ route('attribute.update' ,$attribute) }}">
        @csrf
        @method('patch')
        <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $attribute->name) }}" required autofocus autocomplete="name" />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="flex gap-3">
          <div class="w-5/6">
            <x-input-label for="value" :value="__('Value')" />
            <x-text-input id="value" class="block mt-1 w-full" type="number" name="value" value="{{ old('value', $attribute->value) }}" required autofocus autocomplete="value" />
            <x-input-error :messages="$errors->get('value')" class="mt-2" />
          </div>
          <div>
            <x-input-label for="unit" :value="__('Unit')" />
            <x-text-input id="unit" class="block mt-1 w-full" type="text" name="unit" value="{{ old('unit', $attribute->unit) }}" required autofocus autocomplete="unit" />
            <x-input-error :messages="$errors->get('unit')" class="mt-2" />
          </div>

        </div>
        <div class="py-4">
          <x-primary-button class="dark:hover:bg-white dark:focus:bg-white">
            {{ __('Save') }}
          </x-primary-button>
        </div>
      </form>
    </div>
  </div>
  @endauth
</x-app-layout>