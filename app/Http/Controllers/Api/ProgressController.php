<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @group Quản lý Tiến độ Dự án
 *
 * Các API liên quan đến việc theo dõi và cập nhật tiến độ công việc.
 */
class ProgressController extends Controller
{
    /**
     * Lấy danh sách tiến độ.
     * * Trả về toàn bộ danh sách các đầu việc đang được thực hiện trong hệ thống.
     */
    public function index()
    {
        return response()->json([
            ['id' => 1, 'task' => 'Cài đặt môi trường Laravel', 'status' => 'Hoàn thành'],
            ['id' => 2, 'task' => 'Tích hợp Scramble API', 'status' => 'Đang xử lý'],
        ]);
    }

    /**
     * Cập nhật tiến độ mới.
     * * Cho phép người dùng gửi thông tin công việc mới lên hệ thống.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        return response()->json(['message' => 'Cập nhật thành công!', 'data' => $validated], 201);
    }
}