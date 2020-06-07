<?php

namespace App\Repositories;

use App\Result;
use Illuminate\Database\Eloquent\Collection;
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
            throw new \Exception("An error occurred on saving match result in database");
        }

        DB::commit();

        return $save;
    }

    public function leadboard(): ?Collection
    {
        try {
            return $this->model
                ->selectRaw('
                    name,
                    CAST(COUNT(id) as UNSIGNED) as total_matches,
                    CAST(SUM(user_win) as UNSIGNED) as total_wins
                ')
                ->groupBy('name')
                ->orderBy('total_wins', 'desc')
                ->orderBy('total_matches', 'desc')
                ->get();
        } catch (\Exception $e) {
            return null;
        }
    }
}
