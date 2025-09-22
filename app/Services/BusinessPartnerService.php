<?php

namespace App\Services;

use App\Models\BusinessPartner;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BusinessPartnerService
{
    /**
     * Filter resources based on the provided criteria.
     */
    public function filter(Request $request): Builder
    {
        $query = BusinessPartner::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('name', 'LIKE', "%{$q}%");
        }

        if ($request->filled('cnpj')) {
            $cnpj = removeSpecialCharacters($request->cnpj ?? '');
            $query->where('cnpj', $cnpj);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // ---- SORTING ----
        $allowedSorts = ['name', 'cnpj', 'type', 'created_at', 'updated_at'];
        $allowedDirs = ['asc', 'desc'];

        $sortBy = $request->get('sort_by', 'created_at');
        $sortDir = strtolower($request->get('sort_dir', 'desc'));

        if (! in_array($sortBy, $allowedSorts, true)) {
            $sortBy = 'created_at';
        }

        if (! in_array($sortDir, $allowedDirs, true)) {
            $sortDir = 'desc';
        }

        return $query->orderBy($sortBy, $sortDir);
    }

    public function create(Request $request): BusinessPartner
    {
        $businessPartner = BusinessPartner::create($request->all());

        return $businessPartner;
    }

    public function update(BusinessPartner $businessPartner, Request $request): BusinessPartner
    {
        $businessPartner->update($request->all());

        return $businessPartner;
    }
}
