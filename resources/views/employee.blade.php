<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p> you have taken {{ $user->annualDaysOff()}} day(s) of your annual days </p>
                    <p>you have taken {{ $user->sickDaysOff() }} day(s) of your annual days </p>
                    <br>
                    <a href="{{ route('user.leave.create',auth()->user()) }}" class="btn btn-primary">ask for a leave</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
