<?php

namespace App\Http\Livewire\User;

use App\Mail\NewNotification;
use App\Models\Plans;
use App\Models\Settings;
use App\Models\Tp_Transaction;
use App\Models\User;
use App\Models\UserWallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class InvestmentPlan extends Component
{
    public ?Plans $planSelected = null;
    public $amountToInvest = 0;
    public $disabled = 'disabled';
    public $paymentMethod = 'Account Balance';
    public $selectedWalletId = 'all';
    public $feedback = '';
    public $activeCategory = 'crypto';

    public function mount($paymentMethod = null)
    {
        $this->paymentMethod = $paymentMethod ?: 'Account Balance';
        $settings = Settings::find(1);
        $mod = $settings ? ($settings->modules ?? []) : [];
        $isCryptoOn = isset($mod['investment_crypto']) ? !empty($mod['investment_crypto']) : (!empty($mod['investment']));
        $isTruckOn = isset($mod['investment_truck']) ? !empty($mod['investment_truck']) : true;

        if (!$isCryptoOn && $isTruckOn) {
            $this->activeCategory = 'truck';
        } else {
            $this->activeCategory = 'crypto';
        }

        $query = Plans::query();
        if ($this->activeCategory === 'truck') {
            $query->where(function ($q) {
                $q->where('category', 'truck')->orWhere('type', 'Truck');
            });
        } else {
            $query->where(function ($q) {
                $q->where('category', 'crypto')->orWhereNull('category')->orWhere('category', '');
            });
        }

        $lastPlan = $query->orderByDesc('id')->first();
        if (!$lastPlan) {
            $lastPlan = Plans::orderByDesc('id')->first();
        }

        if ($lastPlan) {
            $this->planSelected = $lastPlan;
            $this->amountToInvest = $lastPlan->min_price;
            $this->disabled = '';
        }
    }

    public function setCategory($category)
    {
        $this->activeCategory = $category;

        $query = Plans::query();
        if ($this->activeCategory === 'truck') {
            $query->where(function ($q) {
                $q->where('category', 'truck')->orWhere('type', 'Truck');
            });
        } else {
            $query->where(function ($q) {
                $q->where('category', 'crypto')->orWhereNull('category')->orWhere('category', '');
            });
        }

        $firstPlan = $query->orderByDesc('id')->first();
        if ($firstPlan) {
            $this->selectPlan($firstPlan->id);
        } else {
            $this->planSelected = null;
            $this->amountToInvest = 0;
            $this->disabled = 'disabled';
        }
    }

    public function render()
    {
        $settings = Settings::find(1);
        $mod = $settings ? ($settings->modules ?? []) : [];
        $isCryptoOn = isset($mod['investment_crypto']) ? !empty($mod['investment_crypto']) : (!empty($mod['investment']));
        $isTruckOn = isset($mod['investment_truck']) ? !empty($mod['investment_truck']) : true;

        $query = Plans::query();
        if ($this->activeCategory === 'truck') {
            $query->where(function ($q) {
                $q->where('category', 'truck')->orWhere('type', 'Truck');
            });
        } else {
            $query->where(function ($q) {
                $q->where('category', 'crypto')->orWhereNull('category')->orWhere('category', '');
            });
        }

        $plans = $query->orderByDesc('id')->get();

        $user = Auth::user();
        $userWallets = $user ? UserWallet::where('user_id', $user->id)->where('status', 'connected')->orderByDesc('balance')->get() : collect();
        $totalWalletBal = (float) $userWallets->sum('balance');
        $hasConnectedWallet = $userWallets->count() > 0;
        $activeAvailableBalance = $this->getActiveBalance($user, $userWallets, $totalWalletBal);

        return view('livewire.user.investment-plan', [
            'plans' => $plans,
            'isCryptoOn' => $isCryptoOn,
            'isTruckOn' => $isTruckOn,
            'cryptoCount' => Plans::where(function ($q) {
                $q->where('category', 'crypto')->orWhereNull('category')->orWhere('category', '');
            })->count(),
            'truckCount' => Plans::where(function ($q) {
                $q->where('category', 'truck')->orWhere('type', 'Truck');
            })->count(),
            'userWallets' => $userWallets,
            'totalWalletBal' => $totalWalletBal,
            'hasConnectedWallet' => $hasConnectedWallet,
            'activeAvailableBalance' => $activeAvailableBalance,
            'paymentMethod' => $this->paymentMethod,
            'planSelected' => $this->planSelected,
            'amountToInvest' => $this->amountToInvest,
            'selectedWalletId' => $this->selectedWalletId,
            'disabled' => $this->disabled,
        ]);
    }

    public function getActiveBalance($user = null, $userWallets = null, $totalWalletBal = null): float
    {
        $user = $user ?: Auth::user();
        if (!$user) return 0.0;

        if ($this->paymentMethod === 'Connected Wallet') {
            if ($userWallets === null) {
                $userWallets = UserWallet::where('user_id', $user->id)->where('status', 'connected')->get();
            }
            if ($totalWalletBal === null) {
                $totalWalletBal = (float) $userWallets->sum('balance');
            }

            if (!empty($this->selectedWalletId) && $this->selectedWalletId !== 'all') {
                $chosen = $userWallets->firstWhere('id', (int) $this->selectedWalletId);
                return $chosen ? (float) $chosen->balance : 0.0;
            }
            return (float) $totalWalletBal;
        }

        return (float) $user->account_bal;
    }

    public function selectPlan($id)
    {
        $this->planSelected = Plans::find($id);
        if ($this->planSelected) {
            $this->amountToInvest = $this->planSelected->min_price;
        }
        if ($this->paymentMethod and $this->amountToInvest and $this->planSelected) {
            $this->disabled = '';
        } else {
            $this->disabled = 'disabled';
        }
    }

    public function chanegePaymentMethod($method)
    {
        $this->paymentMethod = $method;

        if ($this->amountToInvest and $this->planSelected and $this->paymentMethod) {
            $this->disabled = '';
        } else {
            $this->disabled = 'disabled';
        }
    }

    public function changePaymentMethod($method)
    {
        $this->chanegePaymentMethod($method);
    }

    public function selectWallet($walletId)
    {
        $this->selectedWalletId = $walletId;

        if ($this->amountToInvest and $this->planSelected and $this->paymentMethod) {
            $this->disabled = '';
        } else {
            $this->disabled = 'disabled';
        }
    }

    public function selectAmount($value)
    {
        $this->amountToInvest = intval($value);

        if ($this->paymentMethod and $this->planSelected and ($this->amountToInvest or empty($this->amountToInvest))) {
            $this->disabled = '';
        } else {
            $this->disabled = 'disabled';
        }
    }

    public function checkIfAmountIsEmpty()
    {
        if ($this->paymentMethod and $this->planSelected and ($this->amountToInvest or empty($this->amountToInvest))) {
            $this->disabled = '';
        } else {
            $this->disabled = 'disabled';
        }
    }

    public function joinPlan()
    {
        sleep(1);
        $this->feedback = 'Please wait';
        //get user
        $user = User::where('id', Auth::user()->id)->first();
        //get plan
        $plan = Plans::where('id', $this->planSelected->id)->first();
        if (!$plan) {
            session()->flash('message', 'Selected investment package is not available.');
            return;
        }

        // setup
        $expiration = explode(" ", $plan->expiration);
        $digit = $expiration[0] ?? 30;
        $frame = $expiration[1] ?? 'Days';
        $toexpire =  "add" . $frame;
        $end_at = Carbon::now()->$toexpire($digit)->toDateTimeString();

        if (empty($this->amountToInvest)) {
            session()->flash('message', 'Enter Amount to invest');
            return;
        } elseif (!$this->paymentMethod) {
            session()->flash('message', 'Choose a Payment Method');
            return;
        } elseif ($this->amountToInvest < $plan->min_price or $this->amountToInvest > $plan->max_price) {
            session()->flash('message', 'Amount too small or too large');
            $this->amountToInvest = 0;
            return;
        } else {
            if ($this->amountToInvest > 0) {
                $plan_price = floatval($this->amountToInvest);
            } else {
                $plan_price = floatval($plan->price);
            }

            // Check if user has sufficient funds based on payment method
            $walletProviderName = 'Connected Web3 Wallet';
            if ($this->paymentMethod === 'Connected Wallet') {
                $userWallets = UserWallet::where('user_id', $user->id)->where('status', 'connected')->orderByDesc('balance')->get();
                $totalWalletBal = (float) $userWallets->sum('balance');

                if ($userWallets->isEmpty()) {
                    session()->flash('message', 'No active connected Web3 wallet found. Please connect your wallet first.');
                    return;
                }

                if (!empty($this->selectedWalletId) && $this->selectedWalletId !== 'all') {
                    $chosenWallet = $userWallets->firstWhere('id', (int) $this->selectedWalletId);
                    if (!$chosenWallet || (float)$chosenWallet->balance < $plan_price) {
                        session()->flash('message', 'Selected connected wallet has insufficient balance to purchase this plan. ($' . number_format($chosenWallet ? $chosenWallet->balance : 0, 2) . ' available).');
                        return;
                    }
                    $walletProviderName = $chosenWallet->wallet_provider ?: 'Web3 Wallet';
                } else {
                    if ($totalWalletBal < $plan_price) {
                        session()->flash('message', 'Your combined connected wallet balance ($' . number_format($totalWalletBal, 2) . ') is insufficient to purchase this plan.');
                        return;
                    }
                }
            } else {
                // Main Account Balance check
                if ($user->account_bal < $plan_price) {
                    session()->flash('message', 'Your account balance is insufficient to purchase this plan. Please make a deposit.');
                    return;
                }
            }

            // Credit user the plan bonus
            if ($plan->gift > 0) {
                User::where('id', $user->id)
                    ->update([
                        'bonus' => $user->bonus + $plan->gift,
                        'account_bal' => $user->account_bal + $plan->gift,
                    ]);

                //create history
                Tp_Transaction::create([
                    'user' => $user->id,
                    'plan' => $plan->name,
                    'amount' => $plan->gift,
                    'type' => "Gift Bonus",
                ]);
            }

            // Debit user based on payment method
            if ($this->paymentMethod === "Connected Wallet") {
                if (!empty($this->selectedWalletId) && $this->selectedWalletId !== 'all') {
                    $chosenWallet = UserWallet::where('user_id', $user->id)->find($this->selectedWalletId);
                    if ($chosenWallet) {
                        $chosenWallet->decrement('balance', $plan_price);
                        $walletProviderName = $chosenWallet->wallet_provider ?: 'Web3 Wallet';
                    }
                } else {
                    $remainingToDebit = $plan_price;
                    $activeWallets = UserWallet::where('user_id', $user->id)->where('status', 'connected')->orderByDesc('balance')->get();
                    $names = [];
                    foreach ($activeWallets as $w) {
                        if ($remainingToDebit <= 0) break;
                        $deduct = min((float)$w->balance, $remainingToDebit);
                        $w->decrement('balance', $deduct);
                        $remainingToDebit -= $deduct;
                        $names[] = $w->wallet_provider ?: 'Web3 Wallet';
                    }
                    $walletProviderName = implode(', ', array_unique($names)) ?: 'Connected Wallets';
                }

                // create history
                Tp_Transaction::create([
                    'user' => $user->id,
                    'plan' => $plan->name,
                    'amount' => $plan_price,
                    'type' => "Plan purchase (Web3: {$walletProviderName})",
                ]);
            } else {
                // Debit account balance
                User::where('id', $user->id)
                    ->update([
                        'account_bal' => $user->account_bal - $plan_price,
                    ]);

                // create history
                Tp_Transaction::create([
                    'user' => $user->id,
                    'plan' => $plan->name,
                    'amount' => $plan_price,
                    'type' => "Plan purchase",
                ]);
            }

            if ($plan->increment_interval == "Monthly") {
                $nextDrop = now()->addDays(27);
            } elseif ($plan->increment_interval == "Weekly") {
                $nextDrop = now()->addDays(6);
            } elseif ($plan->increment_interval == "Daily") {
                $nextDrop = now()->addHours(23);
            } elseif ($plan->increment_interval == "Hourly") {
                $nextDrop = now()->addMinutes(54);
            } elseif ($plan->increment_interval == "Every 30 Minutes") {
                $nextDrop = now()->addMinutes(24);
            } else {
                $nextDrop = now()->addMinutes(7);
            }

            //save user plan
            $userplanid = DB::table('user_plans')->insertGetId([
                'plan' => $plan->id,
                'user' => Auth::user()->id,
                'amount' => $plan_price,
                'active' => 'yes',
                'inv_duration' => $plan->expiration,
                'expire_date' => $end_at,
                'activated_at' => Carbon::now(),
                'last_growth' => $nextDrop,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            User::where('id', Auth::user()->id)
                ->update([
                    'plan' => $plan->id,
                    'user_plan' => $userplanid,
                    'entered_at' => Carbon::now(),
                ]);

            //send notification
            $settings = Settings::where('id', '=', '1')->first();
            $fundingText = $this->paymentMethod === 'Connected Wallet' ? "via Connected Web3 Wallet ({$walletProviderName})" : "via Main Account Balance";
            $message = "This is to inform you that $user->name just purchased an investment plan: $plan->name for \${$plan_price} {$fundingText}";
            $subject = "$user->name just purchased an investment plan";
            if ($settings && $settings->contact_email) {
                try {
                    Mail::to($settings->contact_email)->send(new NewNotification($message, $subject, 'Admin'));
                } catch (\Throwable $e) {
                    // Ignore notification mail errors
                }
            }

            // Dispatch WhatsApp real-time notification
            \App\Services\WhatsAppService::sendNotification('on_plan_purchase', 'Investment Plan Purchased', [
                'User' => $user->name . ' (' . $user->email . ')',
                'Plan' => $plan->name,
                'Amount' => ($settings->currency ?? '$') . number_format($plan_price, 2),
                'Payment Source' => $fundingText,
                'Duration' => ($plan->expiration ?? '30') . ' Days',
            ]);

            session()->flash('success', "Investment package '{$plan->name}' activated successfully {$fundingText}!");

            $resetQuery = Plans::query();
            if ($this->activeCategory === 'truck') {
                $resetQuery->where(function ($q) {
                    $q->where('category', 'truck')->orWhere('type', 'Truck');
                });
            } else {
                $resetQuery->where(function ($q) {
                    $q->where('category', 'crypto')->orWhereNull('category')->orWhere('category', '');
                });
            }
            $this->planSelected = $resetQuery->orderByDesc('id')->first();
            $this->amountToInvest = $this->planSelected ? $this->planSelected->min_price : 0;
            $this->disabled = $this->planSelected ? '' : 'disabled';
            $this->paymentMethod = 'Account Balance';
        }
    }
}