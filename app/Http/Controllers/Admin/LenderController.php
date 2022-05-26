<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LenderRequest;
use App\Models\Lender;
use DB;
use Illuminate\Http\Request;

class LenderController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        //get all Lender
        $lenders = Lender::latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $lenders = $lenders->where('name', 'like', $keyword);
        }

        $lenders = $lenders->paginate($perPage);

        //Show All Slides
        return view('admin.pages.lender.index', compact('lenders'));
    }

    public function create()
    {
        return view('admin.pages.lender.create');
    }

    public function store(LenderRequest $request)
    {
        DB::beginTransaction();

        try {
            Lender::create([
                'name'     => $request->name,
                'promoted' => false,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Lender Successfully Created');
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit(Lender $lender)
    {
        return view('admin.pages.lender.edit', compact('lender'));
    }

    public function update(LenderRequest $request, Lender $lender)
    {
        DB::beginTransaction();

        try {
            $lender->update([
                'name' => $request->name,
            ]);
            DB::commit();

            return redirect()->back()->with('success', 'Lender Successfully Updated');
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Lender $lender)
    {
        DB::beginTransaction();

        try {
            $lender->delete();
            DB::commit();

            return redirect()->route('admin.lenders.index')->with('success', 'Lender Successfully Deleted');
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->route('admin.lenders.index')->with('error', $exception->getMessage());
        }
    }
}
