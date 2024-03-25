<?php

namespace App\Repositories;

use App\Interfaces\SuperAdminInterfaces\SettlementRepositoryInterface;
use App\Models\Settlement;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SettlementRepository implements SettlementRepositoryInterface
{

    public function getAll(): LengthAwarePaginator
    {
      return Settlement::query()->with('county')->paginate(10);
    }

    public function create(array $data): bool
    {
        $newSettlement = new Settlement();

        $newSettlement->name = $data['settlementName'];
        $newSettlement->county_id = $data['countyId'];

        return $newSettlement->save();
    }

    public function update(array $data, int $id): bool
    {
        return  Settlement::query()->where('id',$id)->update([
            'name'=>$data['settlementName'],
            'county_id'=>$data['countyId'],
        ]);
    }

    public function delete(int $id):bool
    {
        return Settlement::query()->where('id',$id)->delete();
    }
}
