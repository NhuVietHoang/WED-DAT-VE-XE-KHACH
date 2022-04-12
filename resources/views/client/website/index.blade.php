@extends('client.layout.main')
@section('title')
Trang chủ
@endsection
@section('content')
<link rel="stylesheet" href="fontend/css3/owl.carousel.css">
<link rel="stylesheet" href="fontend/style.css">
<link rel="stylesheet" href="fontend/css3/responsive.css">
<script src="fontend/js/jquery-1.11.2.min.js"></script>
<script src="fontend/js3/owl.carousel.min.js"></script>
<script src="fontend/js3/jquery.sticky.js"></script>
<script src="fontend/js3/main.js"></script>
<div class="main">
    <!--  Slide -->
    <div class="mainleft">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php $j = 0; ?>
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                @foreach($slide as $u)
                @if($j !=0)
                <li data-target="#myCarousel" data-slide-to="{{$j}}"></li>
                <?php $j = $j + 1; ?>
                @else
                <?php $j = $j + 1; ?>
                @endif
                @endforeach
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" style="height: 400px;">
                <div class="item active" onclick="location.href='{{url("tintuc")}}/{{$slide[0]->id}}';">
                    <img src="upload/{{$slide[0]->image}}" style="width:100%; height: 400px;">
                    <div class="carousel-caption">
                        <h3 style="width: 50%; margin-bottom: 5em;"><i>{{$slide[0]->title}}</i></h3>
                    </div>
                </div>
                <?php $i = 0; ?>
                @foreach($slide as $slides)
                @if($i !=0)
                <div class="item" onclick="location.href='{{url("tintuc")}}/{{$slides->id}}';">
                    <img src="upload/{{$slides->image}}" style="width:100%; height: 400px;">
                    <div class="carousel-caption">
                        <h3 style="width: 50%;margin-bottom: 5em;"><i>{{$slides->title}}</i></h3>
                    </div>
                </div>
                @else
                <?php $i = 1; ?>
                @endif
                @endforeach
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- Kết slide -->
    <!-- Phần tìm vé trang chủ -->
    <!-- <div class="mainright">
                <div class="timchuyendi"><h4>ĐẶT VÉ TRỰC TUYẾN</h4></div>
               Form tìm vé 
                <form name="timve" action="#" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                     Chọn nơi đi 
                      <div class="diadiem">
                          <label>Chọn Nơi Khởi Hành: </label>
                          <div class="input-group" style="box-shadow: 0 3px #F3AD45;">
                               <span class="input-group-addon"><i class="fa fa-bus"></i></span>
                               <input type="text" name="noidi" class="form-control txtnoidi" list="diadiem" placeholder="Nơi đi">        
                          </div>
                      </div>
                   Chọn nơi đến
                      <div class="diadiem">
                          <label>Chọn Nơi Đến </label>
                          <div class="input-group" style="box-shadow: 0 3px #F3AD45;">
                               <span class="input-group-addon"><i class="fa fa-bus"></i></span>
                               <input type="text" name="noiden" class="form-control txtnoiden" list="diadiem" placeholder="Nơi đến">
                          </div>
                      </div>
                   Chọn ngày đi
                    <div class="ngaydi">
                        <label>Chọn ngày đi: </label>
                            <div class="form-group" style="box-shadow: 0 3px #F3AD45;">
                                <div class='input-group date'>
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar" style="color: #f57812;"></span>
                                    </span>
                                    <input type='date' class="form-control txtngaydi" name="Ngaydi" id="txtdate" style="padding-left: 0" />
                                </div>
                             </div>
                         Button tìm vé
                        <div class="tim">
                            <i class="fa fa-ticket icon-flat bg-btn-actived"></i>
                            <button type="button" class="btn" id="timchuyendimain"><a>Tìm vé</a></button>
                        </div>
                    </div>
                  </form>
                  <!-- Kết form tìm vé -->
</div>
<div style="clear: left;"></div>
<!-- Kết phần tìm vé ở trang chủ -->

<!-- Tuyến phổ biến -->

<div class="tintuc">
    <div class="tentintuc">
        <h3>Tuyết xe phổ biến</h3>
    </div>
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <div class="product-carousel">
                            @foreach($lo_trinhs as $lo_trinh)
                            <div class="single-product">
                                <div class="product-f-image">
                                    @if (isset($lo_trinh) && $lo_trinh->image != null)
                                    <img src="image/{{$lo_trinh->image??'' }}" alt="">
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Đặt Vé</a>
                                    </div>
                                    @else
                                    <img src="image/no_image.png" alt="">
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Đặt Vé</a>
                                    </div>
                                    @endif
                                </div>
                                <div style="margin-top: 7px;" class="col-md-12 d-flex">
                                    <div class="col-md-6 fa fa-map-marker icon">
                                        {{$lo_trinh->km}} Km
                                    </div>
                                    <div class="col-md-6 fa fa-clock-o icon">
                                        {{$lo_trinh->time_intend}}h
                                    </div>
                                </div>
                                <h2 style=" margin-top: 30px; font-weight: bold;text-align: center;"><a href="#">{{$lo_trinh->route}}</a></h2>

                                <!-- <div class="product-carousel-price">
                                        <ins>{{ number_format(180000, 0,",",".") }} đ</ins> <del style="color: red;">{{ number_format(220000,0,",",".") }} đ</del>
                                    </div> -->

                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- End main content area -->

<!-- Phần tin tức -->
<hr>
<div class="tintuc">
    <div class="tentintuc">
        <h3>Tin Tức Nổi Bật</h3>
    </div>
    <ul>
        @foreach($tintuc as $y)
        <li onclick="location.href='{{url("tintuc")}}/{{$y->id}}';">
            <img src="upload/{{$y->image}}">
            <a><strong>{{$y->title}}</strong></a>
        </li>
        @endforeach
    </ul>
    <div style="clear: left;"></div>
    <div class="tintucbutton">
        <button class="btn" onclick="location.href='{{url("tintuc")}}';"><a>Xem Toàn Bộ</a></button>
    </div>
</div>
<div style="clear: left;"></div>
<!-- Kết phần tin tức -->
<!-- Dịch vụ nổi bật -->
<div class="dichvu">
    <h4>" Hãy đến với chúng tôi "</h4>
    <h2>Để Nhận Dịch Vụ Tốt Nhất !</h2>
    <div class="dv">
        <img src="images/free_wifi.png" />
        <br>
        <strong>Wifi Miễn Phí Mọi Nơi !</strong>
    </div>
    <div class="dv">
        <img src="images/dien.png" />
        <br>
        <strong>Ổ Cắm Theo Từng Chổ Ngồi !</strong>
    </div>
    <div class="dv">
        <img src="images/chongoi.png" />
        <br>
        <strong>Chổ Ngồi/Nằm Thỏa mái !</strong>
    </div>
</div>
<!-- Kết phần dịch vụ nổi bật -->
</div>
@endsection
@section('excontent')
<datalist id="diadiem" style="display: none;">
    @isset($tinh)
    @foreach($tinh as $t)
    <option value="{{$t->name}}">
        @endforeach
        @endisset
</datalist>
<div id="hienloitimchuyen" class="modal fade">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header" style="background: rgb(0,64,87); color: #FFF; text-align: center;">
                <button class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                <h4 class="modal-title">Thông báo</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- <script type="text/javascript">
         /*Xử lý input date của chọn ngày đi*/
        function chonngay(){
            var d = new Date();
            var ngay = d.getDate()<10? ('0'+d.getDate()):d.getDate();
            var thang = (d.getMonth() + 1) <10? ('0'+d.getMonth()+1):d.getMonth()+1;
            var nam = d.getFullYear();
            document.getElementById("txtdate").min=nam+"-"+thang+"-"+ngay;
            document.getElementById("txtdate").value= nam+"-"+thang+"-"+ngay;
        }
        chonngay();
        $(document).ready(function(){
            $("#timchuyendimain").click(function(){
                var noidi = $(".txtnoidi").val();
                var noiden = $(".txtnoiden").val();
                var ngaydi = $(".txtngaydi").val();
                var diadiem = $("#diadiem option");
                /*ngay di*/
                var d = new Date();
                var ngay = d.getDate()<10? ('0'+d.getDate()):d.getDate();
                var thang = d.getMonth() + 1 <10? ('0'+d.getMonth()+1):d.getMonth()+1;
                var nam = d.getFullYear();
                var ngayhientai =nam+"-"+thang+"-"+ngay;
                
                /*kiem tra noi di*/
                if(noidi == "" || noiden =="" || ngaydi==""){
                    $("#hienloitimchuyen .modal-body").html("Bạn phải nhập đủ thông tin!");
                    $("#hienloitimchuyen").modal("show");
                }
                else{
                    if(Date.parse(ngaydi)<Date.parse(ngayhientai)){  
                        $("#hienloitimchuyen .modal-body").html("Ngày đi không được nhỏ hơn ngày hiện tại!");
                        $("#hienloitimchuyen").modal("show");
                     }
                     else{
                    var ktnoidi =false;
                    var ktnoiden =false;
                    for(i=0;i<diadiem.length;i++){
                        if(noidi == diadiem[i].value)
                        {
                            ktnoidi = true;

                        }                   
                            if(noiden == diadiem[i].value)
                        {
                            ktnoiden = true;
                            
                        }
                    }

                    if(ktnoidi == false && ktnoiden == false){
                         $("#hienloitimchuyen .modal-body").html("Bạn phải nhập đúng nơi đi, nơi đến!");
                         $("#hienloitimchuyen").modal("show");    
                    }
                    else if(ktnoidi == false){
                        $("#hienloitimchuyen .modal-body").html("Bạn phải nhập đúng nơi đi!");
                         $("#hienloitimchuyen").modal("show");  
                    }
                    else if(ktnoiden == false){
                        $("#hienloitimchuyen .modal-body").html("Bạn phải nhập đúng nơi đến!");
                         $("#hienloitimchuyen").modal("show");  
                    }
                    else if(noidi == noiden){
                         $("#hienloitimchuyen .modal-body").html("Nơi đi không được trùng với nơi đến!");
                         $("#hienloitimchuyen").modal("show"); 
                    }
                    else{
                         document.forms["timve"].submit();
                    }
                }
                }
            });     
         });
    </script> -->
@endsection