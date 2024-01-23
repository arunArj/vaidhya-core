@extends('layouts.theme.base')
@section('dashboard')
<div class="main-content container-fluid">
  <section class="section">
    <div class="row mb-4">
      <div class="col-md-12">
        <form method="POST" action="/suppliers">
          @csrf
          <div class="card">
            <div class="card-header">
                  <h4 class="card-title">Create Supplier</h4>
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
                  <div class="col-md-6">

                    <div class="form-group">
                        <label for="name">Supplier name</label>
                        <input type="text" value="{{ old('name') }}"  name="name" class="form-control" id="name" >
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" value="{{ old('city') }}" class="form-control" id="city" >
                        @error('city')
                           <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="pin">Pin code</label>
                        <input type="text" id="pin" value="{{ old('pin') }}" class="form-control" name="pin">
                        @error('pin')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="address" >
                        @error('address')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="district">District</label>
                        <input type="text" class="form-control" value="{{ old('district') }}" name="district" id="district">
                        @error('district')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="phone" >
                        @error('phone')
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
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="contact_name">Contact Name</label>
                    <input type="text" name="contact_name" value="{{ old('contact_name') }}" class="form-control" id="contact_name" >
                    @error('contact_name')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="disabledInput">Email</label>
                      <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="email" >
                      @error('email')
                       <small class="text-danger">{{ $message }}</small>
                      @enderror
                  </div>
                </div>
                <div class="col-md-6">
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


