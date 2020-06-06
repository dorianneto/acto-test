<?php

namespace App\Repositories;

use App\Result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ResultRepository
{
    /**
     * @var \App\Result
     */
    private $model;

    public function __construct(Result $model)
    {
        $this->model = $model;
    }

    public function save(array $data): Model
    {
        DB::beginTransaction();

        try {
            $save = $this->model->create($data);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception("Error Processing Request", 1);
        }

        DB::commit();

        return $save;
    }
}
