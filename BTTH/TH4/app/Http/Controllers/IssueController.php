<?php

namespace App\Http\Controllers;
use App\Models\Computer;
use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$issues = Issue::all();
        $issues = Issue::paginate(10); // Lấy 10 bản ghi mỗi trang

        return view('issues.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $computers = Computer::all(); 

        return view('issues.create', compact('computers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'computer_id' => 'required|exists:computers,id', 
            'reported_by' => 'required|string|max:50', 
            'reported_date' => 'required|date', 
            'description' => 'required|string', 
            'urgency' => 'required|in:Low,Medium,High', 
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);

        Issue::create($request->all());

        return redirect()->route('issues.index')->with('success', 'Thêm báo cáo mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Issue $issue)
    {
        return view('issues.show', compact('issue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issue $issue)
    {
        $computers = Computer::all(); 

        return view('issues.edit', compact('issue', 'computers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Issue $issue)
    {
        $request->validate([
            'computer_id' => 'required|exists:computers,id', 
            'reported_by' => 'required|string|max:50', 
            'reported_date' => 'required|date', 
            'description' => 'required|string', 
            'urgency' => 'required|in:Low,Medium,High', 
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);

        $issue->update($request->all());

        return redirect()->route('issues.index')->with('success', 'Sửa báo cáo thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issue $issue)
    {
        $issue->delete();

        return redirect()->route('issues.index')->with('success', 'xoá báo cáo thành công');
    }
}