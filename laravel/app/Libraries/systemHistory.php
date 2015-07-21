<?php

namespace App\Libraries;

use App\History;

use Carbon\Carbon;

class systemHistory {

	public function create($student_id, $title, $content)
	{
		$newHistory = History::create([
			'student_id' => $student_id,
			'staff_id' => NULL,
			'created_by' => 'System',
			'title' => $title,
			'content' => $content,
			'created' => Carbon::now()]);
	}

}

?>