<!DOCTYPE html>
<html lang="vi">
    <head>

        <title>Export Order</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->

        <!-- Styles -->
        <style>
            .full-height {
                font-family: courier;
            }
            .content{
                display: flex;
                flex-direction: row;
                padding: 50px;
            }
            h1{
                text-transform: uppercase;
                text-align: center;
                padding-bottom: 50px;
            }
            h3{
                text-transform: uppercase;
            }
            .koi{
                float: left;
                box-sizing: border-box;
                padding-right: 30px;
            }
            .info{
                float: left;
                box-sizing: border-box;
                padding-left: 30px;
                border-left: 1px solid gray;
            }
        </style>
    </head>
    <body>

        <?php
            function utf8convert($str) {
                if(!$str) return false;
                $utf8 = array(
                'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                'd'=>'đ|Đ',
                'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
                'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
                );
                foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
                return $str;
            }
        ?>

        <div class="full-height">     
            <h1>hoa don giao hang</h1>
            <div class="content">
                <div class="koi">
                    <h3>KOIBENTO</h3>
                    <p>Cam on quy khach !</p>
                    <br><br><br><br><br><br>
                    <p>Nhan vien giao hang</p>
                    <p>...................</p>
                    <p>Thoi gian giao hang</p>
                    <p>..../..../........</p>
                </div>
                <div class="info">
                    <h3>Chi tiet don hang</h3>
                    <p>Code: {{ $data['id'] }}</p>
                    <p>Thoi gian dat hang: {{ $data['time'] }}</p>
                    <p>Ten khach hang: {{ $data['name'] }}</p>
                    <p>San pham:</p>
                    @foreach($products as $product)
                    <p style="padding-left:50px;">{{utf8convert($product->title)}} x {{$product->pivot->quantity}} = 
                        <?php $money = (int)$product->price * (int)$product->pivot->quantity; echo $money;?>.000 VND</p>
                    @endforeach

                    <p>Gia tri don hang: {{ $data['total'] }} VND</p>
                    <br><br>     
                    <p style="padding-left:150px;">Nguoi nhan hang</p>
                    <p style="padding-left:130px;">....................</p>              
                </div>
            </div>
        </div>
    </body>
</html>