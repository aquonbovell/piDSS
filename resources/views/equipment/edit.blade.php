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
      <form method="POST" action="{{ route('equipment.update' ,$equipment) }}">
        @csrf
        @method('patch')
        <x-input-label for="item_id" :value="__('Item')" />
        <select name="item_id" id="item_id" class="w-full bg-gray-900 rounded-md">
          @foreach ($items as $item)
          <option value="{{$item->id}}" {{old('item_id' , $equipment->item_id) == $item->id ? "selected" :""}}>{{$item->name}}, {{$item->category}}</option>
          @endforeach
        </select>
        <div>
          <x-input-label for="quantity" :value="__('Quantity')" />
          <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" value="{{ old('quantity', $equipment->quantity) }}" required autofocus autocomplete="quantity" />
          <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
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