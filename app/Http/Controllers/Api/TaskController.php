<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;

/**
 * @group Quản lý Công việc
 * API xử lý các thao tác liên quan đến tiến độ công việc của hệ thống.
 */
use App\Traits\ApiResponse;

class TaskController extends Controller {
    use ApiResponse; // Sử dụng Trait ở đây

    public function index() {
        $tasks = Task::all();
        return $this->success($tasks, "Lấy danh sách thành công");
    }

    /**
     * Tạo công việc mới.
     * Gửi tiêu đề và trạng thái để bắt đầu một tiến độ mới.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,doing,done',
            'progress_percent' => 'integer|min:0|max:100'
        ]);

        $task = Task::create($validated);
        return response()->json(['message' => 'Đã tạo công việc!', 'data' => $task], 201);
    }

    /**
     * Chi tiết công việc.
     * Lấy thông tin chi tiết của một ID công việc cụ thể.
     */
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy công việc này trong hệ thống!'
            ], 404);
        }

        return new TaskResource($task);
    }
    /**
     * Cập nhật tiến độ.
     * Thay đổi trạng thái hoặc phần trăm hoàn thành.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => 'sometimes|in:todo,doing,done',
            'progress_percent' => 'sometimes|integer|min:0|max:100',
        ]);

        $task->update($validated);
        return response()->json(['message' => 'Đã cập nhật!', 'data' => $task]);
    }

    /**
     * Xóa công việc.
     * Gỡ bỏ hoàn toàn công việc khỏi hệ thống.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Đã xóa công việc thành công.']);
    }
}
