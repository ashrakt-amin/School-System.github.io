<?php
namespace App\Repository\Attendance;

interface AttendanceRepositoryInterface{

    public function index();

    public function edit($id);

    public function show($id);

    public function update($request ,$id);

    public function store($data);

    public function delete($id);


}