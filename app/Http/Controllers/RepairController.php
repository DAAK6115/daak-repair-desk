<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Device;
use App\Models\Repair;
use App\Models\RepairStatusLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RepairController extends Controller
{
    public function index(): View
    {
        $repairs = Repair::with(['client', 'device'])
            ->latest()
            ->paginate(10);

        return view('repairs.index', compact('repairs'));
    }

    public function create(): View
    {
        return view('repairs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // Client
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'client_type' => ['nullable', 'string', 'max:100'],

            // Appareil
            'device_type' => ['required', 'string', 'max:100'],
            'brand' => ['required', 'string', 'max:100'],
            'model' => ['nullable', 'string', 'max:100'],
            'serial_number' => ['nullable', 'string', 'max:100'],
            'accessories' => ['required', 'string'],
            'physical_condition' => ['required', 'string'],
            'password_provided' => ['nullable', 'boolean'],
            'device_password' => ['nullable', 'string', 'max:255'],

            // Réparation
            'declared_issue' => ['required', 'string'],
            'diagnostic_fee' => ['nullable', 'numeric', 'min:0'],
            'expected_delivery_date' => ['nullable', 'date'],
        ]);

        $repair = DB::transaction(function () use ($validated) {
            $client = Client::create([
                'full_name' => $validated['full_name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'] ?? null,
                'address' => $validated['address'] ?? null,
                'client_type' => $validated['client_type'] ?? 'Particulier',
            ]);

            $device = Device::create([
                'client_id' => $client->id,
                'device_type' => $validated['device_type'],
                'brand' => $validated['brand'],
                'model' => $validated['model'] ?? null,
                'serial_number' => $validated['serial_number'] ?? null,
                'accessories' => $validated['accessories'],
                'physical_condition' => $validated['physical_condition'],
                'password_provided' => (bool) ($validated['password_provided'] ?? false),
                'device_password' => $validated['device_password'] ?? null,
            ]);

            $repair = Repair::create([
                'client_id' => $client->id,
                'device_id' => $device->id,
                'created_by' => auth()->id(),
                'receipt_number' => $this->generateReceiptNumber(),
                'declared_issue' => $validated['declared_issue'],
                'diagnostic_fee' => $validated['diagnostic_fee'] ?? 0,
                'status' => Repair::STATUS_DEPOSITED,
                'deposit_date' => now(),
                'expected_delivery_date' => $validated['expected_delivery_date'] ?? null,
            ]);

            RepairStatusLog::create([
                'repair_id' => $repair->id,
                'changed_by' => auth()->id(),
                'old_status' => null,
                'new_status' => Repair::STATUS_DEPOSITED,
                'note' => 'Dépôt initial de l’appareil.',
            ]);

            return $repair;
        });

        return redirect()
            ->route('repairs.show', $repair)
            ->with('success', 'Dépôt enregistré avec succès.');
    }

    public function show(Repair $repair): View
    {
        $repair->load(['client', 'device', 'creator', 'statusLogs.user']);

        return view('repairs.show', compact('repair'));
    }

    public function updateStatus(Request $request, Repair $repair): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:' . implode(',', Repair::statuses())],
            'note' => ['nullable', 'string'],
        ]);

        if ($repair->status === Repair::STATUS_DELIVERED) {
            return back()->withErrors([
                'status' => 'Ce dossier est déjà livré. Il ne peut plus être modifié librement.',
            ]);
        }

        $oldStatus = $repair->status;

        $repair->update([
            'status' => $validated['status'],
            'withdrawal_date' => $validated['status'] === Repair::STATUS_DELIVERED ? now() : $repair->withdrawal_date,
        ]);

        RepairStatusLog::create([
            'repair_id' => $repair->id,
            'changed_by' => auth()->id(),
            'old_status' => $oldStatus,
            'new_status' => $validated['status'],
            'note' => $validated['note'] ?? null,
        ]);

        return back()->with('success', 'Statut mis à jour avec succès.');
    }

    private function generateReceiptNumber(): string
    {
        $year = now()->format('Y');

        $lastRepair = Repair::whereYear('created_at', $year)
            ->orderByDesc('id')
            ->first();

        $nextNumber = $lastRepair ? $lastRepair->id + 1 : 1;

        return 'DT-REP-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}