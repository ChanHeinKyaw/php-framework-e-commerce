<div class="container-fluid bg-dark">
    <nav class="container navbar navbar-expand-lg navbar-light bg-faded">
        <a class="navbar-brand text-white" href="/">
          <img src="{{ asset('images/coder.png') }}" alt="" width="30" height="30" class="rounded">
          <span class="ml-3">Online Shopping</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-list text-white"></i>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link text-white" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="/admin">Admin Panel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" style="cursor: pointer" onclick="goToCartPage()">
                  Cart
                  <span class="badge badge-danger badge-fill" style="position: relative; top: -10px; left: -5px;">0</span>
                </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
</div>

@section('script')
  <script>
    function goToCartPage(){
      alert(123);
    }
  </script>
@endsection