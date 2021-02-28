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
                    <form method="post" action="{{ route('user.leave.store',auth()->user()) }}">
                        @csrf
                        <div class="row">
                            <div class="col">
                          <label for="from">Start from</label>
                          <input type="date" class="form-control @error('from') is-invalid @enderror" id="from" name="from" value="{{ old('from') }}" required>
                          @error('from')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                          </div>
                          <div class="col">
                            <label for="to">End at</label>
                            <input type="date" class="form-control @error('to') is-invalid @enderror" id="to" name="to" required value="{{ old('to') }}">
                            @error('to')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                            </div>
                        </div>
                        <div class="row form-group mt-3">
                            <div class="col">
                            <label for="">Leave type</label>
                          <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                            <option value="type" disabled selected hidden>Please Choose a type</option>
                            @foreach($type as $item)
                            <option value="{{$item->id}}" >{{$item->name}}</option>
                            @endforeach
                          </select>
                          @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                          </div>
                          <div class="col">
                          <label for="">Deputy</label>
                            <select class="form-control @error('deputy') is-invalid @enderror" id="deputy" name="deputy" >
                              <option value="deputy" disabled selected hidden>Please Choose a deputy</option>
                              @foreach($otherUsers as $item)
                              <option value="{{$item->id}}" >{{$item->name}}</option>
                              @endforeach
                            </select>
                            @error('deputy')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="">Description</label>
                          <textarea placeholder="Description" class="form-control @error('description') is-invalid @enderror " id="description" 
                          name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" id="submit" name="submit" value="Apply" required>
                          </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>