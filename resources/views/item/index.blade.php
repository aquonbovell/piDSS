<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-baseline">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
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
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
    <h2 class="py-6 font-black text-3xl text-gray-900 dark:text-gray-100 text-center">List piDSS Items</h2>
    <form action="/search" method="get">
      @csrf
      <div class="relative w-96">
        <x-text-input id="search" class="block w-full" type="text" name="search" placeholder="Search.." maxlength="26" autofocus autocomplete="search" />
        <button class="m-0 px-2 inline-block absolute inset-y-0 right-0 bg-gray-800 dark:bg-gray-200 border border-indigo-600 rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-1 focus:ring-indigo-600 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.612 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3l-1.4 1.4ZM9.5 14q1.875 0 3.188-1.313T14 9.5q0-1.875-1.313-3.188T9.5 5Q7.625 5 6.312 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14Z" />
          </svg></button>
      </div>
      
    </form>
    @if(count($items) > 0 )
    <div class="py-2">{{ $items->links()}}</div>
    <div class="grid grid-cols-[repeat(auto-fit,_minmax(230px,1fr))] gap-3">
      @foreach ($items as $item)
      <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg border border-slate-600 p-4 flex justify-between flex-col max-w-md">
        <div>
          <p>Name: {{$item->name}}</p>
          <p>Description: {{$item->description}}</p>
          <p>Category: {{ucwords($item->category)}}</p>
          <p>Price: ${{$item->price}}</p>
        </div>
        <div class="inline-grid gap-4 grid-cols-2 w-full pt-3">
          <form action="{{ route('item.show', $item)}}" method="get">
            @csrf
            <x-primary-button class="w-full justify-center">
              {{__('View')}}
            </x-primary-button>
          </form>
          <form action="{{ route('item.edit', $item)}}" method="get">
            @csrf
            <x-primary-button class="w-full justify-center bg-green-600 dark:bg-green-600 focus:bg-green-400 focus-visible:bg-green-400 hover:bg-green-400 active:bg-green-400 dark:focus:bg-green-400 dark:focus-visible:bg-green-400 dark:hover:bg-green-400 dark:active:bg-green-400 text-white dark:text-white">
              {{__('Edit')}}
            </x-primary-button>
          </form>
          <form action="{{ route('item.destroy', $item)}}" method="post" class="col-span-full">
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
      No items in the piDSS
    </div>
    @endif
  </div>
  @endauth
</x-app-layout>