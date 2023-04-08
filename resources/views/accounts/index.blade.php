<x-app-layout>
    <x-slot name="heder">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accounts') }}
        </h2>
    </x-slot>
    <div class="p-2 bg-slate-100 sm:rounded-lg m-1 w-full mx-1 shadow-sm">
        <div class="relative w-full">
            <div class="absolute right-0">
                <a href="{{ route('account.create') }}" class="bg-blue-500 text-white rounded-md py-1 px-2 my-4 hover:bg-blue-400 hover:text-blue-700 hover:border-blue-200 hover:border-4">
                Register New Account
                </a>
            </div>
        </div>
        <table class="table-auto w-full mt-6">
            <tr class="border-b-4 border-gray-400 font-bold capitalize">
                <th class="py-1 px-6 text-left">Account</th>
                <th class="py-1 px-6 text-right">Year of account Opening</th>
                <th class="py-1 px-6 text-left">Code</th>
                <th class="py-1 px-6 text-right">Principle</th>
                <th class="py-1 px-6">Action</th>
            </tr>
            @forelse ($accounts as $account)
            <tr class="border-b-2 border-gray-300">
                <td class="py-0 px-6">
                    <a href="{{ route('account.show', $account->id) }}">
                        {{ ($account->Name) }}
                    </a>
                </td>
                <td class="py-0 px-6 text-right">{{ $account->year }}</td>
                <td class="py-0 px-6 text-left">{{ $account->Code }}</td>
                <td class="py-0 px-6 text-right">{{ number_format($account->AnualPrinciple, 2, '.', ',') }}</td>
                <td class="py-0 grid grid-cols-2">
                    <a href="{{ route('account.edit', $account->id) }}" class="text-blue-500 bg-slate-300 m-px rounded text-center font-bold">
                        Edit
                    </a>
                    <form class="bg-red-600 px-0 m-px text-center rounded" action="{{route('account.destroy', $account->id)}}" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white italic font-bold">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr><td colspan="5" class="text-red-500">No record in the database!!!</td></tr>
            @endforelse
        </table>
    </div>
</x-app-layout>