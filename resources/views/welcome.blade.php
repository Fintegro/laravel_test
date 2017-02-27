<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #333;

                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .block-header, .block-footer{
                color: #000;
                background: #f5f5f5;
            }
            .block-header.row{
                margin-right: 0 !important;
                margin-left: 0 !important;
            }

            .block-footer.row{
                margin-right: 15px;
                margin-left: 15px;
                margin-top: 15px;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content col-sm-6">

                <div class="title m-b-md">
                    Test skills
                </div>

                <form action="/" class="form-horizontal" id="order-form">
                    <div class="form-group">
                        <label for="product_name">Product name:</label>
                        <input type="text" class="form-control" id="product_name">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity in stock:</label>
                        <input type="text" class="form-control" id="quantity">
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="price">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-default make-order">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </body>
</html>

<script>
    var totalPrice=0;
    var i = function counter(){
        var currentCount = 1;
        return function() {
            return currentCount++;
        };
    }();

    $('.make-order').on('click',function(e) {
        e.preventDefault();

        var form = {
            name: $('#order-form #product_name').val(),
            quantity: $('#order-form #quantity').val(),
            price: $('#order-form #price').val()
        };

        $.ajax({
            url: '/make-order',
            method: 'GET',
            data: {order: form},
            success: function (data) {
                var header='';

                if (!$(".content .block-header").html()) {
                    header = "<div class='row block-header table'>"
                            + "<div class='col-md-3'>Name</div>"
                            + "<div class='col-md-3'>Quantity</div>"
                            + "<div class='col-md-3'>Price</div>"
                            + "<div class='col-md-3'>Total value number</div>"
                            + '</div>';
                }
                $(".content").append(header);

                var index = i();
                totalPrice = form.price * form.quantity + totalPrice;
                var row = "<div class='row added-row' data-row-number='" + index + "'>"
                        + "<div class='col-md-3'>" + form.name + "</div>"
                        + "<div class='col-md-3'>" + form.quantity + "</div>"
                        + "<div class='col-md-3'>" + form.price + "</div>"
                        + "<div class='col-md-3 js-total-val'>" + form.price * form.quantity + "</div>"
                        + '</div>';

                if((form.price * form.quantity)!==0) {
                    $(".content").append(row);
                }

                var footer= "<div class='clearfix'></div><div class='row block-footer'>"
                        + "<div class='col-md-3'></div>"
                        + "<div class='col-md-3'></div>"
                        + "<div class='col-md-3'>Total:</div>"
                        + "<div class='col-md-3'>"+totalPrice+"</div>"
                        + '</div>'

                $(".content .block-footer").remove();
                $(".content .added-row").last().append(footer);

            }
        });
    });
</script>