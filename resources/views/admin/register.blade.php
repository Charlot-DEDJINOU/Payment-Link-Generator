@include('layout.header')
<section class="section-admin">
    <div class="container login w-100 h-100 d-flex justify-content-center align-items-center">
        <form class="container p-5 background-white" method="POST" action="{{ route('admin.postregister') }}">
            @csrf
            <h2 class="text-warning text-center mb-3">Inscription</h2>
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Username</label>
                <input type="text" class="form-control" id="exampleInputName1" name="name" value="{{ old('name') }}"/>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ old('email') }}"/>
            </div>
            <div class="mb-3">
                <label for="exampleInputpasssword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputpassword1" name="password" value="{{ old('password') }}"/>
            </div>
            @if (isset($error))
                <div class="mb-3 alert alert-danger">{{ $error }}</div>
            @endif
            <button type="submit" class="btn btn-warning text-white">S'inscrire</button>
          </form>
    </div>
</section>
@include('layout.footer')