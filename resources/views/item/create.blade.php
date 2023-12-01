<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight py-1">
        {{ __('Item Catalog') }}
      </h2>
    </div>
  </x-slot>
  @auth
  <div class="max-w-3xl mx-auto">
    <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg dark:shadow-slate-700 p-6">
      <h2 class="py-3 font-black text-3xl text-gray-900 dark:text-gray-100 text-center">Create piDSS Item</h2>
      <form method="POST" action="{{ route('item.store') }}">
        @csrf
        <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
          <x-input-label for="description" :value="__('Description')" />
          <textarea name="description" class="block w-full border-gray-300 dark:border-gray-700 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm dark:bg-gray-900">{{old('description')}}</textarea>
          <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <x-input-label for="category" :value="__('Category')" />
        <select name="category" id="category" class="w-full bg-gray-900 rounded-md">
          <option value="" selected disabled hidden>No Category</option>
          <option value="battery" {{old('category') == "battery" ? "selected" :""}}>Battery</option>
          <option value="inverter" {{old('category') == "inverter" ? "selected" :""}}>Inverter</option>
          <option value="solar panel" {{old('category') == "solar panel" ? "selected" :""}}>Solar Panel</option>
          <option value="adapter" {{old('category') == "adapter" ? "selected" :""}}>Adapter</option>
          <option value="cable" {{old('category') == "cable" ? "selected" :""}}>Cable</option>
          <option value="wire" {{old('category') == "wire" ? "selected" :""}}>Wire</option>
        </select>
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
        <div class="flex gap-3">
          <div class="w-1/2">
            <x-input-label for="quantity" :value="__('Quantity')" />
            <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity')" required autofocus autocomplete="quantity" />
            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
          </div>
          <div class="w-1/2">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
          </div>
        </div>
        <div class="py-4">
          <x-primary-button class="dark:hover:bg-white dark:focus:bg-white">
            {{ __('Create Item') }}
          </x-primary-button>
        </div>
      </form>
    </div>
  </div>
  @endauth
</x-app-layout>