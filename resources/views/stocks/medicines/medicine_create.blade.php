@extends('layouts.theme.base')
@section('dashboard')
<div class="main-content container-fluid">
  <section class="section">
    <div class="row mb-4">
      <div class="col-md-12">
        <form method="POST" action="/medicines">
          @csrf
          <div class="card">
            <div class="card-header">
                  <h4 class="card-title">Create Medicine</h4>
            </div>

              <div class="card-body">
                @if(session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
              @endif
                <div class="row">
                  <div class="col-md-4">

                    <div class="form-group">
                        <label for="title">Medicine</label>
                        <input type="text" value="{{ old('title') }}"  name="title" class="form-control" id="title" >
                        @error('title')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="price">price</label>
                        <input type="text" name="price" value="{{ old('price') }}" class="form-control" id="price" >
                        @error('price')
                           <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="unit">Unit</label>
                      <select name="unit" class="form-control" id="unit" >
                        <option value="ml">ml</option>
                        <option value="grm">grm</option>
                    </select>
                      @error('unit')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" >{{ old('description') }}</textarea>
                    @error('description')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>


                <div class="col-md-12">
                  <div class="form-group">
                      <input type="submit" class="btn btn-primary">
                  </div>
                </div>
              </div>
            </div>
          </div>
      </form>
      </div>
    </div>
  </section>
</div>
@endsection


