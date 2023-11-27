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
    @if(count($items) > 0 )
    <div class="grid grid-cols-[repeat(auto-fit,_minmax(230px,1fr))] gap-3">
      @foreach ($items as $item)
      <div class=" text-gray-900 dark:text-gray-100 overflow-hidden rounded-lg border border-slate-600 p-4 flex justify-between flex-col">
        <div>
          <p>Name: {{$item->name}}</p>
          <p>Description: {{$item->description}}</p>
          <p>Category: {{ucfirst($item->category)}}</p>
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