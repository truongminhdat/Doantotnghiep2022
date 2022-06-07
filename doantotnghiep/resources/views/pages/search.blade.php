<div class="container py-5 ">
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-search">
                <form action="#" method="GET" role="form">
                    <input type="hidden" name="s" value="">
                    <input type="hidden" name="post_type" value="bat-dong-san">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                            <select name="danh-muc" id="inputdanhmuc" class="form-control">
                                <option value="all">Loại tin</option>
                                @foreach($loaiphong as $data)
                                <option value="phong-tro">{{$data->Tenloaiphong}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                            <select name="khu-vuc" id="khuvucoption" class="form-control">
                                <option value="all">Chọn quận</option>
                                @foreach($loaiquan as $data)
                                <option value="lien-chieu">{{$data->Tenquan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                            <select name="khu-vuc" id="khuvucoption" class="form-control">
                                <option value="all">Chọn quận</option>
                                @foreach($phuong as $data)
                                    <option value="lien-chieu">{{$data->TenPhuong}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                            <select name="dien-tich" id="inputdientich" class="form-control">
                                <option value="0">Diện tích</option>
                                <option value="1">Dưới 20m2</option>
                                <option value="2">20m2 - 30m2</option>
                                <option value="3">30m2 - 40m2</option>
                                <option value="4">40m2 - 50m2</option>
                                <option value="5">50m2 - 60m2</option>
                                <option value="6">60m2 - 70m2</option>
                                <option value="7">70m2 - 80m2</option>
                                <option value="8">80m2 - 90m2</option>
                                <option value="9">90m2 - 100m2</option>
                                <option value="10">Trên 100m2</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                            <select name="khoang-gia" id="inputkhoang-gia" class="form-control">
                                <option value="0">Khoảng giá</option>
                                <option value="1">&lt; 500K</option>
                                <option value="2">500K - 1 triệu</option>
                                <option value="3">1 triệu - 1 triệu 5</option>
                                <option value="4">1 triệu 5 - 2 triệu</option>
                                <option value="5">2 triệu - 3 triệu</option>
                                <option value="6">3 triệu - 4 triệu</option>
                                <option value="7">4 triệu - 5 triệu</option>
                                <option value="8">&gt; 5 triệu</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                            <button class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
