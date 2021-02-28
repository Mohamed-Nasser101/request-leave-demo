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
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if ($pendingLeaves->isEmpty())
                            <p class="text-muted">no pending leaves.</p>   
                        @else
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Type</th>
                                <th scope="col">Description</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingLeaves as $leave)
                                <tr>
                                    <th scope="row">{{ $leave->id }}</th>
                                    <th scope="col">{{ $leave->user->name }}</th>
                                    <th scope="col">{{ $leave->user->email }}</th>
                                    <th scope="col">{{ $leave->from }}</th>
                                    <th scope="col">{{ $leave->to }}</th>
                                    <th scope="col">{{ $leave->type->name }}</th>
                                    <th scope="col">{{ $leave->description }}</th>
                                    <th scope="col"><form action="{{ route('update.leaves',$leave->id) }}" method="post">@csrf @method('patch')
                                    <input type="submit" class="form-control btn btn-success" id="submit"
                                    name="submit" value="approve" required></form></th>
                                    <th scope="col"><form action="{{ route('update.leaves',$leave->id) }}" method="post">@csrf @method('patch')
                                    <input type="submit" class="form-control btn btn-danger" id="submit"
                                    name="submit" value="refuse" required></form></th>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>  
                        @endif
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>