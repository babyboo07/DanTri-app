<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['cateName' => 'video', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'sự kiện', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'xã hội', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'Thế giới', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'kinh doanh', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'bất động sản', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'Thể thao', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'việc làm', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'nhân ái', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'sức khỏe', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'văn hóa', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'giải trí', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'xe ++', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'sức mạnh số', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'giáo dục', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'an sinh', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'pháp luật', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'du lịch', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'đời sống', 'parent_id' => null, 'status' => 1],
            ['cateName' => 'tình yêu', 'parent_id' => null, 'status' => 1],
            // ['cateName' => 'Chính trị', 'parent_id' => '1'],
            // ['cateName' => 'Học tập Bác', 'parent_id' => '1'],
            // ['cateName' => 'Môi trường', 'parent_id' => '1'],
            // ['cateName' => 'Giao thông', 'parent_id' => '1'],
            // ['cateName' => 'Nóng trên mạng', 'parent_id' => '1'],
            // ['cateName' => 'Sáng kiến an toàn giao thông', 'parent_id' => '1'],
            // ['cateName' => 'Quân sự', 'parent_id' => '2'],
            // ['cateName' => 'Hồ sơ - Phân tích', 'parent_id' => '2'],
            // ['cateName' => 'Thế giới đó đây', 'parent_id' => '2'],
            // ['cateName' => 'Kiều bào', 'parent_id' => '2'],
            // ['cateName' => 'Tài chính', 'parent_id' => '3'],
            // ['cateName' => 'Chứng khoán', 'parent_id' => '3'],
            // ['cateName' => 'Doanh nghiệp', 'parent_id' => '3'],
            // ['cateName' => 'Khởi nghiệp', 'parent_id' => '3'],
            // ['cateName' => 'Tiêu dùng', 'parent_id' => '3'],
            // ['cateName' => 'CAmaccao - Doanh nghiệp tiên phong', 'parent_id' => '3'],
            // ['cateName' => 'Thanh toán thông minh', 'parent_id' => '3'],
            // ['cateName' => 'Dự án', 'parent_id' => '4'],
            // ['cateName' => 'Thị trường', 'parent_id' => '4'],
            // ['cateName' => 'Nhà đất', 'parent_id' => '4'],
            // ['cateName' => 'Nhịp sống đô thị', 'parent_id' => '4'],
            // ['cateName' => 'Sống xanh', 'parent_id' => '4'],
            // ['cateName' => 'Nội thất', 'parent_id' => '4'],
            // ['cateName' => 'Bóng đá trong nước', 'parent_id' => '5'],
            // ['cateName' => 'Bóng đá Châu Âu', 'parent_id' => '5'],
            // ['cateName' => 'Tennis', 'parent_id' => '5'],
            // ['cateName' => 'Golf', 'parent_id' => '5'],
            // ['cateName' => 'World Cup 2022', 'parent_id' => '5'],
            // ['cateName' => 'Võ thuật', 'parent_id' => '5'],
            // ['cateName' => 'Các môn Thể thao khác', 'parent_id' => '5'],
            // ['cateName' => 'Hậu trường', 'parent_id' => '5'],
            // ['cateName' => 'Chính sách', 'parent_id' => '6'],
            // ['cateName' => 'Việc làm', 'parent_id' => '6'],
            // ['cateName' => 'Đưa nghị quyết 68 vào cuộc sống', 'parent_id' => '6'],
            // ['cateName' => 'Xuất khẩu lao động', 'parent_id' => '6'],
            // ['cateName' => 'Chúng tôi nói', 'parent_id' => '6'],
            // ['cateName' => 'Danh sách ủng hộ', 'parent_id' => '7'],
            // ['cateName' => 'Danh sách kết chuyển', 'parent_id' => '7'],
            // ['cateName' => 'Hoàn cảnh', 'parent_id' => '7'],
            // ['cateName' => 'Ung thư', 'parent_id' => '8'],
            // ['cateName' => 'Sống khỏe', 'parent_id' => '8'],
            // ['cateName' => 'Dịch vụ y tế quốc tế', 'parent_id' => '8'],
            // ['cateName' => 'Kiến thức giới tính', 'parent_id' => '8'],
            // ['cateName' => 'Tư vấn', 'parent_id' => '8'],
            // ['cateName' => 'Khỏe đẹp', 'parent_id' => '8'],
            // ['cateName' => 'Đời sống văn hóa', 'parent_id' => '9'],
            // ['cateName' => 'Điện ảnh', 'parent_id' => '9'],
            // ['cateName' => 'Âm nhạc', 'parent_id' => '9'],
            // ['cateName' => 'Văn học', 'parent_id' => '9'],
            // ['cateName' => 'Hậu trường', 'parent_id' => '10'],
            // ['cateName' => 'Thời trang', 'parent_id' => '10'],
            // ['cateName' => 'TVshow', 'parent_id' => '10'],
            // ['cateName' => 'Thị trường xe', 'parent_id' => '11'],
            // ['cateName' => 'Xe điện', 'parent_id' => '11'],
            // ['cateName' => 'Đánh giá', 'parent_id' => '11'],
            // ['cateName' => 'Cộng đồng xe', 'parent_id' => '11'],
            // ['cateName' => 'Kinh nghiệm - Tư vấn', 'parent_id' => '11'],
            // ['cateName' => 'Bảng giá ô tô', 'parent_id' => '11'],
            // ['cateName' => 'Sản phẩm', 'parent_id' => '12'],
            // ['cateName' => 'Di động - Viễn thông', 'parent_id' => '12'],
            // ['cateName' => 'Phần mềm - Bảo mật', 'parent_id' => '12'],
            // ['cateName' => 'Cộng đồng mạng', 'parent_id' => '12'],
            // ['cateName' => 'Góc phụ huynh', 'parent_id' => '13'],
            // ['cateName' => 'Khuyến học', 'parent_id' => '13'],
            // ['cateName' => 'Gương sáng', 'parent_id' => '13'],
            // ['cateName' => 'Giáo dục - Nghề nghiệp', 'parent_id' => '13'],
            // ['cateName' => 'Du học', 'parent_id' => '13'],
            // ['cateName' => 'Tuyển sinh', 'parent_id' => '13'],
            // ['cateName' => 'Hồ sơ vụ án', 'parent_id' => '15'],
            // ['cateName' => 'Pháp đình', 'parent_id' => '15'],
            // ['cateName' => 'Tin tức', 'parent_id' => '16'],
            // ['cateName' => 'Khám phá', 'parent_id' => '16'],
            // ['cateName' => 'Món ngon - Điểm đẹp', 'parent_id' => '16'],
            // ['cateName' => 'Tour hay - Khuyến mại', 'parent_id' => '16'],
            // ['cateName' => 'Video - Ảnh', 'parent_id' => '16'],
            // ['cateName' => 'Cộng đồng', 'parent_id' => '17'],
            // ['cateName' => 'Nhà đẹp', 'parent_id' => '17'],
            // ['cateName' => 'Thượng lưu', 'parent_id' => '17'],
            // ['cateName' => 'Chuyện lạ', 'parent_id' => '17'],
            // ['cateName' => 'Chợ online', 'parent_id' => '17'],
            // ['cateName' => 'Chuyện của tôi', 'parent_id' => '18'],
            // ['cateName' => 'Gia đình', 'parent_id' => '18'],
            // ['cateName' => 'Tình yêu', 'parent_id' => '18'],
        ];

        DB::table('categories')->insert($data);
    }
}