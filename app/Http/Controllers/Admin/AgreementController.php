<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgreeRequest;
use App\Models\Agreement;
use DB;
use Illuminate\Http\Request;

class AgreementController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        //get all Agreement
        $agreements = Agreement::latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $agreements = $agreements->where('name', 'like', $keyword);
        }

        $agreements = $agreements->paginate($perPage);

        //Show All Slides
        return view('admin.pages.agreement.index', compact('agreements'));
    }


    public function create()
    {
        return view('admin.pages.agreement.create');
    }
    public function store(AgreeRequest $request)
    {
        DB::beginTransaction();

        try {

            Agreement::create([
                'name' => $request->name,
                'content' => $request->text,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Agreement Successfully Created');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit(Agreement $agreement)
    {
        return view('admin.pages.agreement.edit', compact('agreement'));
    }

    public function update(AgreeRequest $request, Agreement $agreement)
    {
        DB::beginTransaction();

        try {
            $agreement->update([
                'name' => $request->name,
                'content' => $request->text,
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Agreement Successfully Updated');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Agreement $agreement)
    {
        DB::beginTransaction();

        try {
            $agreement->delete();
            DB::commit();

            return redirect()->route('admin.agreements.index')->with('success', 'Agreement Successfully Deleted');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->route('admin.agreements.index')->with('error', $exception->getMessage());
        }
    }


}
