<?php

namespace App\Http\Controllers;

use App\History as HistoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class History extends Controller {

	public function index(Request $request) {
		$type = $request->input('type') ?? 1;

		$history = HistoryModel::where(['type' => $type])->orderBy('file_id', 'DESC')->paginate(15);
		return view('history', ['history' => $history]);
	}

	public function delete(Request $request) {
		if (empty($request->input('file'))) {
			return redirect('file-manager?type=1');
		}

		$history = HistoryModel::firstOrNew(['file_path' => $request->input('file')]);
		$history->type = 2;
		$history->save();
		Storage::delete($request->input('file'));
		return redirect('history?type=1');
	}
}
