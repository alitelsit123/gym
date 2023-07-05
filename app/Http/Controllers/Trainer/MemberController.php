<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TrainerMember;
use App\Models\ScheduleNutrition;
use App\Models\AbsentExercise;
use App\Models\ScheduleExercise as Scheduleexercise;

class MemberController extends Controller
{
  public function index() {
    return view('trainer.active-member');
  }
  public function scheduleNutrition($id) {
    $member = TrainerMember::findOrFail($id);
    return view('trainer.member.schedule-nutrition', compact('member'));
  }
  public function storeNutrition() {
    $member = TrainerMember::findOrFail(request('trainer_member_id'));
    $validatedData = request()->validate([
      'daym' => ['required'],
      'description' => ['required'],
      'type' => ['required'],
      'packet_id' => ['required'],
      'trainer_member_id' => ['required'],
      'user_id' => ['required']
    ]);
    ScheduleNutrition::create($validatedData);
    return back()->with(['success' => 'Berhasil update jadwal.']);
  }
  public function updateNutrition() {
    $nutrition = ScheduleNutrition::findOrFail(request('schedule_id'));
    $validatedData = request()->validate([
      'daym' => ['required'],
      'description' => ['required'],
      'type' => ['required'],
    ]);
    ScheduleNutrition::whereId(request('schedule_id'))->update($validatedData);
    return back()->with(['success' => 'Berhasil update jadwal.']);
  }
  public function destroyNutrition() {
    ScheduleNutrition::whereId(request('id'))->delete();
    return back()->with(['success' => 'Berhasil hapus jadwal.']);
  }

  public function scheduleExercise($id) {
    $member = TrainerMember::findOrFail($id);
    return view('trainer.member.schedule-exercise', compact('member'));
  }
  public function storeexercise() {
    $member = TrainerMember::findOrFail(request('trainer_member_id'));
    $validatedData = request()->validate([
      'daym' => ['required'],
      'description' => ['required'],
      'packet_id' => ['required'],
      'trainer_member_id' => ['required'],
      'user_id' => ['required']
    ]);
    Scheduleexercise::create($validatedData);
    return back()->with(['success' => 'Berhasil update jadwal.']);
  }
  public function updateexercise() {
    $exercise = Scheduleexercise::findOrFail(request('schedule_id'));
    $validatedData = request()->validate([
      'daym' => ['required'],
      'description' => ['required'],
    ]);
    Scheduleexercise::whereId(request('schedule_id'))->update($validatedData);
    return back()->with(['success' => 'Berhasil update jadwal.']);
  }
  public function destroyMember($id) {
    $t = TrainerMember::findOrFail($id);
    $t->status = 'expired';
    $t->save();
    return back()->with(['success' => 'Berhasil mengeluarkan member.']);
  }
  public function destroyexercise() {
    Scheduleexercise::whereId(request('id'))->delete();
    return back()->with(['success' => 'Berhasil hapus jadwal.']);
  }
  public function absentExercise() {
    $member = TrainerMember::findOrFail(request('trainer_member_id'));
    $validatedData = request()->validate([
      'packet_id' => ['required'],
      'trainer_member_id' => ['required'],
      'user_id' => ['required'],
      'trainer_id' => ['required'],
      'schedule_exercise_id' => ['required']
    ]);
    $absent = AbsentExercise::create($validatedData);
    return back()->with(['success' => 'Berhasil absent.']);
  }
}
