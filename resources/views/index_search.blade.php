<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>All Dunks Test Server</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>



    <!-- Core theme CSS (includes Bootstrap)-->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <style>
        #search-results {
            position: absolute;
            top: 70%;
            left: 38%;
            width: 20%;
            background-color: #fff;
        }

        #product-image {
            max-width: 300px;
            max-height: 200px;
        }
    </style>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">All Dunks</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                </ul>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">

                            <form action="/products/searchResult" method="GET">

                                <div class="input-group mb-3">
                                    <input type="text" name="query" id="search-input" class="form-control" placeholder="Search products...">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" id="search-submit" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>

                            <div>
                                <span class="rounded" id="search-results">
                                </span>
                            </div>


                        </div>
                    </div>
                </div>



                <script src="{{ asset('js/search.js') }}"></script>
                <a class="btn btn-outline-dark col-1" href="/cart">
                    <i class="bi-cart-fill "></i>

                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill" id="cart">{{$count}}</span>
                </a>
            </div>
        </div>
        <ul class="navbar-nav ms-auto">
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <div id="searchSection">


    </div>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($Products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ asset('storage/product/' . $product->file_path) }}" alt="Product Image">
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{$product->name}}</h5>
                                <!-- Product price-->
                                ${{$product->price}}
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><button id="addToCart" class="btn btn-outline-dark mt-auto" name="{{$product->id}}" onclick="getId(this.name), counter(), checkAuth()">Add to Cart</button></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->

</body>

</html>

<script>
    $('#womansSection').hide();
    $('#searchSection').hide();

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#mensProductBtn').click(function(e) {
            $('#mensSection').show('');
            $('#womansSection').hide('');
        });

        $('#womensProductBtn').click(function(e) {
            $('#womansSection').show('');
            $('#mensSection').hide('');
        });

        $('#allProductBtn').click(function(e) {
            $('#womansSection').show('');
            $('#mensSection').show('');
        });

    });

    function counter() {
        $('#cart').html(function(i, val) {
            return +val + 1
        });
    }

    function getId(id) {
        //var items = $('#productId').val();

        $.ajax({
            data: {
                id: id,
            },
            url: 'addToCart',
            type: "GET",
            success: function(data) {
                console.log(id);
            },
            error: function(data) {
                console.log(data)
            }

        });
    }
    //function for when user clicks on search item that pops up while searching


    // check if user is sigend in
    function checkAuth() {
        $.ajax({
            type: 'GET',
            url: '/check-auth',
            success: function(data) {},
            error: function(data) {

                window.location.href = 'http://127.0.0.1:8000/login';
            }
        });
    }

    $('#search-input').on('keyup', function() {
        var query = $(this).val();

        if (query.trim() === '') {
            $('#search-results').html('');
        } else {

            $.ajax({
                url: '/products/search',
                type: 'GET',
                data: {
                    query: query
                },
                success: function(data) {


                    var results = '';

                    $.each(data, function(index, product) {
                        results += '<div class="product"> ' +
                            '<input type="hidden" id="id" name="' + product.id + '"> </input>' +
                            '<input type="hidden" id="name" name="' + product.name + '"> </input>' +
                            '<input type="hidden" id="price" name="' + product.price + '"> </input>' +
                            '<input type="hidden" id="file_path" name="' + product.file_path + '"> </input>' +
                            '<button type="" class="btn btn-light" name="' + product.id + '" id="' + product.id + '" onclick="search_submit(this.id)">' +
                            product.name + '</button>' +
                            '</div>';
                    });

                    $('#search-results').html(results);

                }
            });
        }
    });

    function search_submit(id) {
        //alert('you is in search_submit function ' + id + '');
        //console.log(id);
        console.log(id);
        $('#searchSection').show();

        var productId = document.getElementById('id').getAttribute('name');
        var productName = document.getElementById('name').getAttribute('name');
        var productPrice = document.getElementById('price').getAttribute('name');
        var productFile_path = document.getElementById('file_path').getAttribute('name');

        var test = '{{ asset( "storage/product/' + productFile_path + '") }}';

        console.log(productFile_path);


        var product = '';

        product += '<section class="py-5">' +
            '<div class="container px-4 px-lg-5 mt-5">' +
            '<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">' +

            '<div class="col mb-5">' +
            '<div class="card h-100">' +

            '<img class="card-img-top product-image" src="/storage/product/' + productFile_path + '" alt="Product Image">' +

            '<div class="card-body p-4">' +
            '<div class="text-center">' +

            '<h5 class="fw-bolder" id="name">' + productName + '</h5>' +

            '<span id="price"></span>' +
            '</div>' +
            '</div>' +

            '<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">' +
            '<div class="text-center"><button id="addToCart" class="btn btn-outline-dark mt-auto" name="' + productId + '" onclick="getId(this.name), counter(), checkAuth()">Add to Cart</button></div>' +
            ' </div>' +
            '</div>' +
            '</div>' +
            '</div>' +


            '</div>' +
            '</div>' +
            '</section>';
        $('#searchSection').html(product);


        $('#allProductSection').hide('');

    }


    $('#search-submit').click(function() {

        var query = $('#search-input').val();

        console.log(query);


        $.ajax({
            url: '/products/search_submit',
            type: 'GET',
            data: {
                query: query
            }
        });
    });
</script>