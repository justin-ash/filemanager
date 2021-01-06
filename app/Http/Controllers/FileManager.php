<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileManager extends Controller {

	/**
	 * Recive the post data file
	 * give to the job to validate and save to database
	 *
	 * @param  Null
	 * @return Response
	 */
	public function index(Request $request) {

		$page = (int) $request->input('page') ?: 1;

		$files = collect(Storage::allFiles('/file_uplods'));
		$limit = 15;

		$slice = $files->slice(($page - 1) * $limit, $limit);

		$paginator = new \Illuminate\Pagination\LengthAwarePaginator($slice, $files->count(), $limit);
		$paginator->withPath('file-manager');
		return view('file-manager')->with('files', $paginator);
	}

	public function create(Request $request) {

		$rule = array(
			'file' => 'required|mimes:txt,doc,docx,pdf,png,jpeg,jpg,gif|max:2000',
		);
		$validator = Validator::make($request->all(), $rule);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator);
		}

		$file = $request->file('file');
		$destinationPath = 'file_uplods/';
		$originalFile = $file->getClientOriginalName();
		$fileType = $file->extension();
		$fileSize = $file->getClientSize();

		$filenameWithExt = $file->getClientOriginalName();
		$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
		$extension = $file->extension();
		$fileNameToStore = $filename . '_' . time() . '.' . $fileType;

		$file->storeAs($destinationPath, $fileNameToStore);

		$history = new History();
		$history->file_name = $originalFile;
		$history->file_path = $destinationPath . $fileNameToStore;
		$history->file_type = $fileType;
		$history->file_size = $fileSize;
		$history->created_at = date('Y-m-d H:i:s');
		$history->updated_at = date('Y-m-d H:i:s');
		$history->save();

		return redirect('file-manager');
	}

	public function delete(Request $request) {
		$filePath = $request->input('file');
		if (empty($filePath)) {
			return redirect('file-manager');
		}

		$history = History::firstOrNew(['file_path' => $filePath]);
		$history->type = 2;
		$history->save();
		Storage::delete($filePath);
		return redirect('file-manager');
	}

}
