<?php
namespace App\Repository\Fees;

interface ReceiptStudentRepositoryInterface{

    public function index();

    public function edit($request);
    
    public function show($request);

    public function update($request);

    public function store($request);

    public function destroy($request);




}