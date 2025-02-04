@extends('layout')

@section('content')
<link rel="stylesheet" href="/css/affiliate.css">
<div class="section">
    <div class="section-page">
        <div class="quest-banner affiliate">
            <div class="caption">
                <h1><span>Referral programme</span></h1>
            </div>
            <div class="info"><span>Earning {{$settings->ref_perc}}% from your referrals' winnings.</span></div>
            <div class="info"><span>Your referrals have brought {{$settings->ref_sum}} to your real balance</span></div>
        </div>
        <div class="affiliate-stats">
            <div class="left">
                <div class="affiliate-stats-item">
                    <div class="wrap">

                            <div class="affiliates-form">
            <div class="text">Your referral link:</div>
            <form>
                <div class="form-row">
                    <div class="form-field input-group">
                        <div class="input-valid">
                            <input class="input-field" type="text" name="code" id="code" readonly="" value="{{ strtolower($_SERVER['REQUEST_SCHEME']).'://' }}{{ strtolower($settings->domain) }}/?ref={{$u->unique_id}}">
                            <div class="input-group-append">
                                <button type="button" class="btn" onclick="copyToClipboard('#code')"><span>Copy</span></button>
                                <div class="copy-tooltip"><span>Copied</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

                    </div>
                </div>
                <div class="affiliate-stats-item border-top">
                    <div class="wrap border-right">
                        <div class="block">
                            <svg class="icon icon-network">
                                <use xlink:href="/img/symbols.svg#icon-network"></use>
                            </svg>
                            <div class="num">{{$u->link_trans}}</div>
                            <div class="text">TRANSITIONS</div>
                        </div>
                    </div>
                    <div class="wrap">
                        <div class="block">
                            <svg class="icon icon-person">
                                <use xlink:href="/img/symbols.svg#icon-person"></use>
                            </svg>
                            <div class="num">{{$u->link_reg}}</div>
                            <div class="text">REGISTRATIONS</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="affiliate-stats-item full">
                    <div class="wrap">
                    
                            <div class="block">
                            <div class="form-row">
                            <div class="form-label">Total profit</div>
                            <div class="form-field">
                            <div class="input-valid">
                            <input id="total-affiliate-amount" class="input-field input-with-icon" value="{{$u->ref_money_all}}" readonly="">
                            <div class="input-icon">
                            <svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg>
                            </div>
                            </div>
                            </div></div>
                            
                            <div class="form-row">
                            <div class="form-label">Available balance</div>
                            <div class="form-field">
                            <div class="input-valid">
                            <input id="total-affiliate-amount" class="input-field input-with-icon" value="{{$u->ref_money}}" readonly="">
                            <div class="input-icon">
                            <svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg>
                            </div>
                            </div>
                            </div></div>
                            <span id="withdraw-button" class="" data-toggle="tooltip" data-placement="top" title="Минимальная сумма снятия {{ $settings->min_ref_withdraw }} монет"><button type="button" {{ $u->ref_money < $settings->min_ref_withdraw  ? 'disabled' : '' }} class="btn">Take</button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection