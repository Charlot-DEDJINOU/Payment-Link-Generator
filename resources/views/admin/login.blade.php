@include('layout.header')
<section class="section-admin">
    <div class="container login w-100 h-100 d-flex justify-content-center align-items-center">
        <form class="container p-5 background-white" method="POST" action="{{ route('admin.postlogin') }}">
            @csrf
            <h2 class="text-warning text-center mb-3">Connexion</h2>
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Username</label>
                <input type="text" class="form-control" id="exampleInputName1" value="{{ old('name') }}" name="name"/>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" value="{{ old('password') }}" name="password" />
            </div>
            @error('error')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-warning text-white">Se connecter</button>
        </form>
    </div>
</section>
@include('layout.footer')