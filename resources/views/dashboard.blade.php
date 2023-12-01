<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight py-1">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">
					{{ __("You're logged in!") }}
				</div>
			</div>
		</div>
	</div>
	<div>
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
				<h3>piDSS</h3>
				<h4>Making your solar panel system decision easier.</h4>
				<a href="{{ url('/item')}}" class="block hover:text-gray-300 w-fit">List items in piDSS</a>
				<a href="{{ url('/building')}}" class="block hover:text-gray-300 w-fit">List building models in piDSS</a>
				<a href="{{ url('/system')}}" class="block hover:text-gray-300 w-fit">List pv system models in piDSS</a>
			</div>
		</div>
	</div>
</x-app-layout>