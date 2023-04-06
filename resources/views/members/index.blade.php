<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Members') }}

        </h2>
    </x-slot>

    {{-- <div class="py-12"> 
    <div class="py-4 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx-2">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div> 
    </div>--}}
    <div class="p-2 bg-white dark:bg-gray-800 sm:rounded-lg w-full mx-1 shadow-sm mt-1">
        <div class="relative w-full">
            <div class="absolute right-0">
                <a href="{{ route('member.create') }}" class="bg-blue-800 text-white dark:bg-blue-200 dark:text-black rounded-md py-1 px-2 my-4 hover:bg-blue-400 hover:text-blue-700 hover:border-blue-200 hover:border-4">
                    Register Member
                </a>
            </div>
        </div>
        <div class="rounded-lg p-4 bg-transparent w-full mt-8 grid grid-cols-5 space-x-2 space-y-2">
            @forelse ($members as $member)
            <div class="rounded-lg border border-green-600 p-2 shadow-lg">
                <div class="flex relative py-1">
                    <h1 class="w-3/border-b-2 border-gray-500 font-bold capitalize absolute left-0">
                        <a href="{{ route('member.show', $member->id) }}">{{ $member->Names }}</a>
                    </h1>
                    <span class="w-1/4 border-b-2 border-gray-500 font-bold capitalize text-blue-500 absolute right-0">
                        <a href="{{ route('member.memberAccounts', $member->id) }}">Accounts</a>
                    <span>
                </div>

                <div class="mt-6">
                    <div class="flex relative">
                        <p class="absolute left-0">Member Code:</p><p class="absolute right-0 text-green-700 font-extrabold">{{ $member->Code }}</p>
                    </div>
                    <div class="flex relative mt-5">
                        <p class="absolute left-0">Weight</p><p class="absolute right-0 text-green-700 font-extrabold">{{ number_format($member->currentBalance,2,'.',',') }}</p>
                    </div>
                </div>

                <div class="flex relative mt-6">
                    <a href="{{ route('member.edit', $member->id) }}" class="text-blue-500 bg-slate-300 m-px rounded text-center font-bold px-2">
                        Edit
                    </a>
                    <form action="{{ route('member.destroy', $member->id) }}" class="bg-red-600 px-0 m-px text-center rounded absolute right-0" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Member\'s Record from the system!!!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white italic font-bold px-2">Delete</button>
                    </form>
                </div>
            </div>
            @empty
                <p class="text-red-600">No Reocrd in the database!!!</p>
            @endforelse
        </div>
    </div>
</x-app-layout>