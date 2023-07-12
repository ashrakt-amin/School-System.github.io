<?php
namespace App\Repository\Graduated;

interface FeesRepositoryInterface{

    public function index();

    public function edit($request);

    public function update($request);

    public function create();

    public function store($request);

    public function destroy($request);




}