<?php
namespace App\Repository\Section;

interface SectionRepositoryInterface{

    public function index();

    public function GetGender();

    public function Getspecialization();

    public function edit($id);

    public function update($request,$id);

    public function store($request);

    public function delete($id);


}