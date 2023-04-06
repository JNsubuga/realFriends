<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member Details') }}
            <a href="{{ route('member.index') }}" class="bg-blue-500 text-white rounded-md py-1 px-2 my-4 hover:bg-blue-400 hover:text-blue-700 hover:border-blue-200 hover:border-4">
                &lAarr; Members List
            </a>
        </h2>
    </x-slot>
    <div class="p-4 m-1 w-full">
        <div class="relative w-full">
            <div class="uppercase font-extrabold text-green-700 text-xl absolute left-0">
                {{ $toDetail->Names}}
            </div>
            <div class="absolute font-extrabold text-red-600 text-xl right-0">
                {{ $toDetail->Code }}
            </div>
        </div>
        <div class="text-right mt-6">
            Total Capital Contribution: {{ number_format($toDetail->currentBalance, 2, '.', ',') }}
        </div>
       <div>
            <table class="table-auto w-full mt-6">
                <tr class="border-b-4 border-gray-400 font-bold capitalize">
                    <th class="py-1 px-6 text-left">Date</th>
                    <th class="py-1 px-6 text-left">Description</th>
                    <th class="py-1 px-6 text-left">Folio</th>
                    <th class="py-1 px-6 text-right">Dr</th>
                    <th class="py-1 px-6 text-right">Cr</th>
                </tr>
                @forelse ($toDetail->transactions as $transaction)
                    <tr class="border-b-2 border-gray-300">
                        <td class="py-0 px-6">{{ ($transaction->txnDate) }}</td>
                        <td class="py-0 px-6">{{ ($transaction->account->Name) }}</td>
                        <td class="py-0 px-6 text-left">{{ 'F'.$transaction->account->year.'-'.$transaction->member->Code.'-'.$transaction->account->Code }}</td>
                        <td class="py-0 px-6 text-right">{{ number_format($transaction->Cr, 2, '.', ',') }}</td>
                        <td class="py-0 px-6 text-right">{{ number_format($transaction->Dr, 2, '.', ',') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-red-500">No record in the database!!!</td></tr>
                @endforelse
            </table>
        </div>
    </div>
</x-app-layout>