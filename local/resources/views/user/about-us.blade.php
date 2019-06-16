@extends('user.layout')

@section('title', 'GIỚI THIỆU')

@section('content')
	
	<div class="menu-sm">
		<div class="container">
			<ul class="nav">
				<li class="nav-item">
					<a href="/koibento/" class="nav-link">Home</a>
				</li>
				<li class="nav-item">
					<span>
						Giới thiệu
					</span>
				</li>
			</ul>
		</div>
	</div>

	<div class="about-us-top">
		<h2 class="text-uppercase text-center">giới thiệu</h2>
		<div class="container">
			<div class="about-item">
				<img src='{{ asset("local/public/images/about-top.jpg") }}' alt="about">
			</div>
			<div class="about-item">
				<h3 class="text-center text-capitalize">Văn hoá ẩm thực Nhật Bản</h3>
				<p class="text-justify">Ẩm thực Nhật Bản vốn nổi tiếng bậc nhất thế giới bởi sự cầu kỳ trong cách chế biến lẫn bài trí mỗi món ăn, hương vị món ăn Nhật thường thanh tao, nhẹ nhàng, hợp với không khí thiên nhiên của mỗi mùa, mang đậm bản sắc riêng. Ẩm thực Nhật Bản không lạm dụng quá nhiều gia vị mà chú trọng làm nổi bật hương vị tươi ngon, tinh khiết tự nhiên của món ăn. Hương vị món ăn Nhật thường thanh tao, nhẹ nhàng và phù hợp với thiên nhiên từng mùa. Do vị trí địa lý bốn bề bao quanh đều là biển, hải sản và rong biển chiếm phần lớn trong khẩu phần ăn của người Nhật. Lương thực chính của người Nhật là gạo; người Nhật cuộn gạo trong những tấm rong biển xanh đen, tạo thành món sushi, được xem là quốc thực của Nhật Bản. Các món ăn chế biến từ đậu nành cũng có tầm quan trọng đặc biệt trong ẩm thực Nhật. Các món ăn Nhật cũng thể hiện tư duy thẩm mĩ tinh tế và sự khéo léo của người nấu khi được bày biện với chỉ vài miếng ở một góc chén dĩa, để thực khách còn có thể thấy nét đẹp của vật dụng đựng món ăn.</p>
				<p class="text-justify"> Ngoài ra, nhiều thành phần dinh dưỡng trong thực phẩm Nhật Bản rất tốt cho sức khỏe. Bữa ăn không thể thiếu đậu nành và các thực phẩm chế biến từ đậu nành như miso (tương đặc), tofu (đậu hũ tươi), natto giúp ngăn chặn tình trạng tắc nghẽn mạch máu; hạt vừng đen giúp kích thích hoạt động của não ...</p>
			</div>
		</div>
		<div class="jp-img"><img src='{{ asset("local/public/images/cover.jpg") }}' alt="cover"></div>
	</div>
	<div class="container about_team">
		<h2 class="text-uppercase text-center team">đầu bếp</h2>
		<div class="row team">
			<div class="col-4">
				<img src='{{ asset("local/public/images/db1.jpg") }}' alt="db1">
				<div class="name text-center">
					<span id="">đầu bếp 1</span>
					<p id="">この番組は、「バイクの指導員なのにバイクで崖から落ちた」、「クリスマスをイビキで</p>
				</div>
			</div>
			<div class="col-4">
				<img src='{{ asset("local/public/images/db1.jpg") }}' alt="db1">
				<div class="name text-center">
					<span>đầu bếp 2</span>
					<p id="">この番組は、「バイクの指導員なのにバイクで崖から落ちた」、「クリスマスをイビキで</p>
				</div>
			</div>
			<div class="col-4">
				<img src='{{ asset("local/public/images/db1.jpg") }}' alt="db1">
				<div class="name text-center">
					<span id="">đầu bếp 3</span>
					<p id="">この番組は、「バイクの指導員なのにバイクで崖から落ちた」、「クリスマスをイビキで</p>
				</div>
			</div>
		</div>
	</div>

@endsection