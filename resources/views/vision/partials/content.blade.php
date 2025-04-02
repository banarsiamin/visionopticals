@php use Carbon\Carbon; @endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('visionui/mobiscroll.javascript.min.css') }}">
    <script src="{{ asset('visionui/mobiscroll.javascript.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('visionui/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
        .readonly-input {
            border: none;
            background: transparent;
            pointer-events: none;
            padding: 4px 8px;
            width: 100%;
            text-align: center;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        }
        .prescription-table .readonly-input {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px;
            margin: 2px;
            background-color: #f8f8f8;
            min-width: 80px;
        }
    </style>

    <title>Vision optical</title>
</head>

<body>

<form method="POST" action="{{ isset($prescription) ? route('prescription.update', $prescription) : route('prescription.store') }}" id="prescriptionForm">
    @csrf
    @if(isset($prescription))
        @method('PUT')
    @endif
    <div class="container-main">
        <div class="container">

            <div class="top_section text-center">
                <img class="img" src="{{ asset('visionui/img/logo.png') }}" />
                <div class="vision-opticals">VISION OPTICALS</div>
                <div class="gray_line">
                    <p class="p">41, Prakash Nagar Near Navlakha Square, Indore (M.P.) | Mobile No.: +91 9854548448</p>
                </div>
            </div>

            <div class="second_section">
                <div class="no_and_date">
                    <div class="left">
                        <span style="font-weight: 500;">No. :</span> 
                        <span class="big_size">{{ isset($prescription) ? $prescription->invoice_no : $invoiceNo }}</span>
                        <input type="hidden" name="invoice_no" value="{{ isset($prescription) ? $prescription->invoice_no : $invoiceNo }}">
                    </div>
                    <div class="right">
                        <span style="font-weight: 500;">Date:</span>
                        @if(isset($viewMode) && $viewMode)
                            <input type="text" class="readonly-input" value="{{ isset($prescription) ? date('Y-m-d', strtotime($prescription->date)) : date('Y-m-d') }}" readonly>
                        @else
                            <input type="date" name="date" value="{{ isset($prescription) ? date('Y-m-d', strtotime($prescription->date)) : date('Y-m-d') }}" required>
                        @endif
                    </div>
                </div>
                
                <div style="" class="name_and_mob">
                    <div class="left">
                        <span style="font-weight: 500;">Name:</span>
                        @if(isset($viewMode) && $viewMode)
                            <input type="text" class="readonly-input" value="{{ $prescription->customer_name }}" readonly>
                        @else
                            <input type="text" name="customer_name" placeholder="Enter full name" value="{{ isset($prescription) ? $prescription->customer_name : '' }}" required>
                        @endif
                    </div>
                    <div class="right">
                        <span style="font-weight: 500;">Mob:</span>
                        @if(isset($viewMode) && $viewMode)
                            <input type="text" class="readonly-input" value="{{ $prescription->mobile_number }}" readonly>
                        @else
                            <input type="text" name="mobile_number" placeholder="Enter mobile no." value="{{ isset($prescription) ? $prescription->mobile_number : '' }}" required>
                        @endif
                    </div>
                </div>

                <div style="" class="prescription">
                    <div class="left">
                        <div class="">
                            <div style="float: left;margin-right: 20px;margin-top: 5px; font-weight: 500;">Prescription: </div>
                            @if(isset($viewMode) && $viewMode)
                                <input type="text" class="readonly-input" value="{{ $prescription->prescription_type }}" readonly>
                            @else
                                <select name="prescription_type">
                                    <option value="Dr." {{ isset($prescription) && $prescription->prescription_type == 'Dr.' ? 'selected' : '' }}>Dr.</option>
                                    <option value="N" {{ isset($prescription) && $prescription->prescription_type == 'N' ? 'selected' : '' }}>N</option>
                                    <option value="R" {{ isset($prescription) && $prescription->prescription_type == 'R' ? 'selected' : '' }}>R</option>
                                    <option value="P" {{ isset($prescription) && $prescription->prescription_type == 'P' ? 'selected' : '' }}>P</option>
                            </select>
                            @endif
                        </div>
</div>
</div>
</div>

<div class="third_box">
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th style="font-weight: 500; text-align:left; padding-left: 20px;" class="item_bx">Items</th>
                    <th style="font-weight: 500;" class="description_th">Description</th>
                                <th style="" class="ammount_th">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p style="">Frame</p>
                    </td>
                    <td class="tbody_input">
                        <div>
                                        @if(isset($viewMode) && $viewMode)
                                            <input type="text" class="readonly-input" value="{{ $prescription->frame_description }}" readonly>
                                        @else
                                            <input type="text" placeholder="Write description" name="frame_description" value="{{ isset($prescription) ? $prescription->frame_description : '' }}">
                                        @endif
                        </div>
                    </td>
                    <td>
                                    @if(isset($viewMode) && $viewMode)
                                        <input type="text" class="readonly-input" value="₹ {{ number_format($prescription->frame_amount ?? 0, 2) }}" readonly>
                                    @else
                                        <input type="text" placeholder="₹ 0 .00" name="frame_amount" class="input_amount" value="{{ isset($prescription) ? $prescription->frame_amount : '' }}">
                                    @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="">Glasses</p>
                    </td>
                    <td class="tbody_input">
                                    @if(isset($viewMode) && $viewMode)
                                        <input type="text" class="readonly-input" value="{{ $prescription->glass_description }}" readonly>
                                    @else
                                        <input type="text" placeholder="Write description" name="glass_description" value="{{ isset($prescription) ? $prescription->glass_description : '' }}">
                                    @endif
                    </td>
                    <td>
                                    @if(isset($viewMode) && $viewMode)
                                        <input type="text" class="readonly-input" value="₹ {{ number_format($prescription->glass_amount ?? 0, 2) }}" readonly>
                                    @else
                                        <input type="text" placeholder="₹ 0 .00" name="glass_amount" class="input_amount" value="{{ isset($prescription) ? $prescription->glass_amount : '' }}">
                                    @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="">Goggle</p>
                    </td>
                    <td class="tbody_input">
                                    @if(isset($viewMode) && $viewMode)
                                        <input type="text" class="readonly-input" value="{{ $prescription->photo_description }}" readonly>
                                    @else
                                        <input type="text" placeholder="Write description" name="photo_description" value="{{ isset($prescription) ? $prescription->photo_description : '' }}">
                                    @endif
                    </td>
                    <td>
                                    @if(isset($viewMode) && $viewMode)
                                        <input type="text" class="readonly-input" value="₹ {{ number_format($prescription->photo_amount ?? 0, 2) }}" readonly>
                                    @else
                                        <input type="text" placeholder="₹ 0 .00" name="photo_amount" class="input_amount" value="{{ isset($prescription) ? $prescription->photo_amount : '' }}">
                                    @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="text-wrap: nowrap;">Contact Lenses</p>
                    </td>
                    <td class="tbody_input">
                                    @if(isset($viewMode) && $viewMode)
                                        <input type="text" class="readonly-input" value="{{ $prescription->other_description }}" readonly>
                                    @else
                                        <input type="text" placeholder="Write description" name="other_description" value="{{ isset($prescription) ? $prescription->other_description : '' }}">
                                    @endif
                    </td>
                    <td>
                                    @if(isset($viewMode) && $viewMode)
                                        <input type="text" class="readonly-input" value="₹ {{ number_format($prescription->other ?? 0, 2) }}" readonly>
                                    @else
                                        <input type="text" placeholder="₹ 0 .00" name="other" class="input_amount" value="{{ isset($prescription) ? $prescription->other : '' }}">
                                    @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="fourth_box">
    <div class="left left-30">
        <div class="table_four prescription-table">
            <table class="">
                <thead>
                    <tr>
                        <th style="font-weight: 600;"></th>
                        <th style="font-weight: 600;">SPH</th>
                        <th style="font-weight: 600;">CYL</th>
                        <th style="font-weight: 600;">AXIS</th>
                        <th style="font-weight: 600;">VISION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight: 600;">RE1</td>
                        <td>
                                        @if(isset($viewMode) && $viewMode)
                                            <input type="text" class="readonly-input" value="{{ $prescription->re_sph }}" readonly>
                                        @else
                            <div mbsc-page class="demo-responsive">
                                <div style="height:100%">
                                    <label>
                                                        <input mbsc-input class="mobiscroll-input" name="re_sph" placeholder="0" data-dropdown="true" data-input-style="outline" data-label-style="stacked" value="{{ isset($prescription) ? $prescription->re_sph : '' }}" />
                                    </label>
                                    <select class="mobiscroll-select" name="re_sph" >
                                        <option value="-19" {{ isset($prescription) && $prescription->re_sph == '-19' ? 'selected' : '' }}>-19</option>
                                        <option value="-18" {{ isset($prescription) && $prescription->re_sph == '-18' ? 'selected' : '' }}>-18</option>
                                        <option value="-17" {{ isset($prescription) && $prescription->re_sph == '-17' ? 'selected' : '' }}>-17</option>
                                        <option value="-16" {{ isset($prescription) && $prescription->re_sph == '-16' ? 'selected' : '' }}>-16</option>
                                        <option value="-15" {{ isset($prescription) && $prescription->re_sph == '-15' ? 'selected' : '' }}>-15</option>
                                        <option value="-14" {{ isset($prescription) && $prescription->re_sph == '-14' ? 'selected' : '' }}>-14</option>
                                        <option value="-13" {{ isset($prescription) && $prescription->re_sph == '-13' ? 'selected' : '' }}>-13</option>
                                        <option value="-12" {{ isset($prescription) && $prescription->re_sph == '-12' ? 'selected' : '' }}>-12</option>
                                        <option value="-11" {{ isset($prescription) && $prescription->re_sph == '-11' ? 'selected' : '' }}>-11</option>
                                        <option value="-10" {{ isset($prescription) && $prescription->re_sph == '-10' ? 'selected' : '' }}>-10</option>
                                        <option value="-9" {{ isset($prescription) && $prescription->re_sph == '-9' ? 'selected' : '' }}>-9</option>
                                        <option value="-8" {{ isset($prescription) && $prescription->re_sph == '-8' ? 'selected' : '' }}>-8</option>
                                        <option value="-7" {{ isset($prescription) && $prescription->re_sph == '-7' ? 'selected' : '' }}>-7</option>
                                        <option value="-6.50" {{ isset($prescription) && $prescription->re_sph == '-6.50' ? 'selected' : '' }}>-6.50</option>
                                        <option value="-6" {{ isset($prescription) && $prescription->re_sph == '-6' ? 'selected' : '' }}>-6</option>
                                        <option value="-5.50" {{ isset($prescription) && $prescription->re_sph == '-5.50' ? 'selected' : '' }}>-5.50</option>
                                        <option value="-5" {{ isset($prescription) && $prescription->re_sph == '-5' ? 'selected' : '' }}>-5</option>
                                        <option value="-4.50" {{ isset($prescription) && $prescription->re_sph == '-4.50' ? 'selected' : '' }}>-4.50</option>
                                        <option value="-4" {{ isset($prescription) && $prescription->re_sph == '-4' ? 'selected' : '' }}>-4</option>
                                        <option value="-3.75" {{ isset($prescription) && $prescription->re_sph == '-3.75' ? 'selected' : '' }}>-3.75</option>
                                        <option value="-3.50" {{ isset($prescription) && $prescription->re_sph == '-3.50' ? 'selected' : '' }}>-3.50</option>
                                        <option value="-3.25" {{ isset($prescription) && $prescription->re_sph == '-3.25' ? 'selected' : '' }}>-3.25</option>
                                        <option value="-3" {{ isset($prescription) && $prescription->re_sph == '-3' ? 'selected' : '' }}>-3</option>
                                        <option value="-2.75" {{ isset($prescription) && $prescription->re_sph == '-2.75' ? 'selected' : '' }}>-2.75</option>
                                        <option value="-2.50" {{ isset($prescription) && $prescription->re_sph == '-2.50' ? 'selected' : '' }}>-2.50</option>
                                        <option value="-2.25" {{ isset($prescription) && $prescription->re_sph == '-2.25' ? 'selected' : '' }}>-2.25</option>
                                        <option value="-2" {{ isset($prescription) && $prescription->re_sph == '-2' ? 'selected' : '' }}>-2</option>
                                        <option value="-1.75" {{ isset($prescription) && $prescription->re_sph == '-1.75' ? 'selected' : '' }}>-1.75</option>
                                        <option value="-1.50" {{ isset($prescription) && $prescription->re_sph == '-1.50' ? 'selected' : '' }}>-1.50</option>
                                        <option value="-1.25" {{ isset($prescription) && $prescription->re_sph == '-1.25' ? 'selected' : '' }}>-1.25</option>
                                        <option value="-1" {{ isset($prescription) && $prescription->re_sph == '-1' ? 'selected' : '' }}>-1</option>
                                        <option value="-0.75" {{ isset($prescription) && $prescription->re_sph == '-0.75' ? 'selected' : '' }}>-0.75</option>
                                        <option value="-0.50" {{ isset($prescription) && $prescription->re_sph == '-0.50' ? 'selected' : '' }}>-0.50</option>
                                        <option value="-0.25" {{ isset($prescription) && $prescription->re_sph == '-0.25' ? 'selected' : '' }}>-0.25</option>
                                        <!-- <option value="0" {{ isset($prescription) && $prescription->re_sph == '0' ? 'selected' : '' }}>0</option> -->
                                        <option value="0" {{ !isset($prescription) || $prescription->re_sph == '0' || $prescription->re_sph == null ? 'selected' : '' }}>0</option>                                                    

                                        <option value="+0.25" {{ isset($prescription) && $prescription->re_sph == '+0.25' ? 'selected' : '' }}>+0.25</option>
                                        <option value="+0.50" {{ isset($prescription) && $prescription->re_sph == '+0.50' ? 'selected' : '' }}  >+0.50</option>
                                        <option value="+0.75" {{ isset($prescription) && $prescription->re_sph == '+0.75' ? 'selected' : '' }}>+0.75</option>
                                        <option value="+1" {{ isset($prescription) && $prescription->re_sph == '+1' ? 'selected' : '' }}>+1</option>
                                        <option value="+1.25" {{ isset($prescription) && $prescription->re_sph == '+1.25' ? 'selected' : '' }}>+1.25</option>
                                        <option value="+1.50" {{ isset($prescription) && $prescription->re_sph == '+1.50' ? 'selected' : '' }}>+1.50</option>
                                        <option value="+1.75" {{ isset($prescription) && $prescription->re_sph == '+1.75' ? 'selected' : '' }}>+1.75</option>
                                        <option value="+2" {{ isset($prescription) && $prescription->re_sph == '+2' ? 'selected' : '' }}>+2</option>
                                        <option value="+2.25" {{ isset($prescription) && $prescription->re_sph == '+2.25' ? 'selected' : '' }}>+2.25</option>
                                        <option value="+2.50" {{ isset($prescription) && $prescription->re_sph == '+2.50' ? 'selected' : '' }}>+2.50</option>
                                        <option value="+2.75" {{ isset($prescription) && $prescription->re_sph == '+2.75' ? 'selected' : '' }}>+2.75</option>
                                        <option value="+3" {{ isset($prescription) && $prescription->re_sph == '+3' ? 'selected' : '' }}>+3</option>
                                        <option value="+3.25" {{ isset($prescription) && $prescription->re_sph == '+3.25' ? 'selected' : '' }}>+3.25</option>
                                        <option value="+3.50" {{ isset($prescription) && $prescription->re_sph == '+3.50' ? 'selected' : '' }}>+3.50</option>
                                        <option value="+3.75" {{ isset($prescription) && $prescription->re_sph == '+3.75' ? 'selected' : '' }}>+3.75</option>
                                        <option value="+4" {{ isset($prescription) && $prescription->re_sph == '+4' ? 'selected' : '' }}>+4</option>
                                        <option value="+4.50" {{ isset($prescription) && $prescription->re_sph == '+4.50' ? 'selected' : '' }}>+4.50</option>
                                        <option value="+5" {{ isset($prescription) && $prescription->re_sph == '+5' ? 'selected' : '' }}>+5</option>
                                        <option value="+5.50" {{ isset($prescription) && $prescription->re_sph == '+5.50' ? 'selected' : '' }}>+5.50</option>
                                        <option value="+6" {{ isset($prescription) && $prescription->re_sph == '+6' ? 'selected' : '' }}>+6</option>
                                        <option value="+6.50" {{ isset($prescription) && $prescription->re_sph == '+6.50' ? 'selected' : '' }}>+6.50</option>
                                        <option value="+7" {{ isset($prescription) && $prescription->re_sph == '+7' ? 'selected' : '' }}>+7</option>
                                        <option value="+8" {{ isset($prescription) && $prescription->re_sph == '+8' ? 'selected' : '' }}>+8</option>
                                        <option value="+9" {{ isset($prescription) && $prescription->re_sph == '+9' ? 'selected' : '' }}>+9</option>
                                        <option value="+10" {{ isset($prescription) && $prescription->re_sph == '+10' ? 'selected' : '' }}>+10</option>
                                        <option value="+11" {{ isset($prescription) && $prescription->re_sph == '+11' ? 'selected' : '' }}>+11</option>
                                        <option value="+12" {{ isset($prescription) && $prescription->re_sph == '+12' ? 'selected' : '' }}>+12</option>
                                        <option value="+13" {{ isset($prescription) && $prescription->re_sph == '+13' ? 'selected' : '' }}>+13</option>
                                        <option value="+14" {{ isset($prescription) && $prescription->re_sph == '+14' ? 'selected' : '' }}>+14</option>
                                        <option value="+15" {{ isset($prescription) && $prescription->re_sph == '+15' ? 'selected' : '' }}>+15</option>
                                        <option value="+16" {{ isset($prescription) && $prescription->re_sph == '+16' ? 'selected' : '' }}>+16</option>
                                        <option value="+17" {{ isset($prescription) && $prescription->re_sph == '+17' ? 'selected' : '' }}>+17</option>
                                        <option value="+18" {{ isset($prescription) && $prescription->re_sph == '+18' ? 'selected' : '' }}>+18</option>
                                        <option value="+19" {{ isset($prescription) && $prescription->re_sph == '+19' ? 'selected' : '' }}>+19</option>
                                    </select>
                                </div>
                            </div>
                                        @endif
                        </td>
                        <td>
                                        @if(isset($viewMode) && $viewMode)
                                            <input type="text" class="readonly-input" value="{{ $prescription->re_cyl }}" readonly>
                                        @else
                            <div mbsc-page class="demo-responsive">
                                <div style="height:100%">
                                    <label>
                                                        <input mbsc-input class="mobiscroll-input" name="re_cyl" placeholder="0" data-dropdown="true" data-input-style="outline" data-label-style="stacked" value="{{ isset($prescription) ? $prescription->re_cyl : '' }}" />
                                    </label>
                                    <select class="mobiscroll-select">
                                        <option value="-21" {{ isset($prescription) && $prescription->re_cyl == '-6' ? 'selected' : '' }}>-6</option>
                                        <option value="-20" {{ isset($prescription) && $prescription->re_cyl == '-5.50' ? 'selected' : '' }}>-5.50</option>
                                        <option value="-19" {{ isset($prescription) && $prescription->re_cyl == '-5' ? 'selected' : '' }}>-5</option>
                                        <option value="-18" {{ isset($prescription) && $prescription->re_cyl == '-4.50' ? 'selected' : '' }}>-4.50</option>
                                        <option value="-17" {{ isset($prescription) && $prescription->re_cyl == '-4' ? 'selected' : '' }}>-4</option>
                                        <option value="-16" {{ isset($prescription) && $prescription->re_cyl == '-3.75' ? 'selected' : '' }}>-3.75</option>
                                        <option value="-15" {{ isset($prescription) && $prescription->re_cyl == '-3.50' ? 'selected' : '' }}>-3.50</option>
                                        <option value="-14" {{ isset($prescription) && $prescription->re_cyl == '-3.25' ? 'selected' : '' }}>-3.25</option>
                                        <option value="-13" {{ isset($prescription) && $prescription->re_cyl == '-3' ? 'selected' : '' }}>-3</option>
                                        <option value="-12" {{ isset($prescription) && $prescription->re_cyl == '-2.75' ? 'selected' : '' }}>-2.75</option>
                                        <option value="-11" {{ isset($prescription) && $prescription->re_cyl == '-2.50' ? 'selected' : '' }}>-2.50</option>
                                        <option value="-10" {{ isset($prescription) && $prescription->re_cyl == '-2.25' ? 'selected' : '' }}>-2.25</option>
                                        <option value="-9" {{ isset($prescription) && $prescription->re_cyl == '-2' ? 'selected' : '' }}>-2</option>
                                        <option value="-8" {{ isset($prescription) && $prescription->re_cyl == '-1.75' ? 'selected' : '' }}>-1.75</option>
                                        <option value="-7" {{ isset($prescription) && $prescription->re_cyl == '-1.50' ? 'selected' : '' }}>-1.50</option>
                                        <option value="-6" {{ isset($prescription) && $prescription->re_cyl == '-1.25' ? 'selected' : '' }}>-1.25</option>
                                        <option value="-5" {{ isset($prescription) && $prescription->re_cyl == '-1' ? 'selected' : '' }}>-1</option>
                                        <option value="-4" {{ isset($prescription) && $prescription->re_cyl == '-0.75' ? 'selected' : '' }}>-0.75</option>
                                        <option value="-3" {{ isset($prescription) && $prescription->re_cyl == '-0.50' ? 'selected' : '' }}>-0.50</option>
                                        <option value="-2" {{ isset($prescription) && $prescription->re_cyl == '-0.25' ? 'selected' : '' }}>-0.25</option>                                                    
                                        <option value="0" {{ !isset($prescription) || $prescription->re_cyl == '0' || $prescription->re_cyl == null ? 'selected' : '' }}>0</option>                                                    
                                        <option value="2" {{ isset($prescription) && $prescription->re_cyl == '+0.25' ? 'selected' : '' }}  >+0.25</option>
                                        <option value="3" {{ isset($prescription) && $prescription->re_cyl == '+0.50' ? 'selected' : '' }}>+0.50</option>
                                        <option value="4" {{ isset($prescription) && $prescription->re_cyl == '+0.75' ? 'selected' : '' }}>+0.75</option>
                                        <option value="5" {{ isset($prescription) && $prescription->re_cyl == '+1' ? 'selected' : '' }}>+1</option>
                                        <option value="6" {{ isset($prescription) && $prescription->re_cyl == '+1.25' ? 'selected' : '' }}>+1.25</option>
                                        <option value="7" {{ isset($prescription) && $prescription->re_cyl == '+1.50' ? 'selected' : '' }}>+1.50</option>
                                        <option value="8" {{ isset($prescription) && $prescription->re_cyl == '+1.75' ? 'selected' : '' }}>+1.75</option>
                                        <option value="9" {{ isset($prescription) && $prescription->re_cyl == '+2' ? 'selected' : '' }}>+2</option>
                                        <option value="10" {{ isset($prescription) && $prescription->re_cyl == '+2.25' ? 'selected' : '' }}>+2.25</option>
                                        <option value="11" {{ isset($prescription) && $prescription->re_cyl == '+2.50' ? 'selected' : '' }}>+2.50</option>
                                        <option value="12" {{ isset($prescription) && $prescription->re_cyl == '+2.75' ? 'selected' : '' }}>+2.75</option>
                                        <option value="13" {{ isset($prescription) && $prescription->re_cyl == '+3' ? 'selected' : '' }}>+3</option>
                                        <option value="14" {{ isset($prescription) && $prescription->re_cyl == '+3.25' ? 'selected' : '' }}>+3.25</option>
                                        <option value="15" {{ isset($prescription) && $prescription->re_cyl == '+3.50' ? 'selected' : '' }}>+3.50</option>
                                        <option value="16" {{ isset($prescription) && $prescription->re_cyl == '+3.75' ? 'selected' : '' }}>+3.75</option>
                                        <option value="17" {{ isset($prescription) && $prescription->re_cyl == '+4' ? 'selected' : '' }}>+4</option>
                                        <option value="18" {{ isset($prescription) && $prescription->re_cyl == '+4.50' ? 'selected' : '' }}>+4.50</option>
                                        <option value="19" {{ isset($prescription) && $prescription->re_cyl == '+5' ? 'selected' : '' }}>+5</option>
                                        <option value="20" {{ isset($prescription) && $prescription->re_cyl == '+5.50' ? 'selected' : '' }}>+5.50</option>
                                        <option value="21" {{ isset($prescription) && $prescription->re_cyl == '+6' ? 'selected' : '' }}>+6</option>
                                    </select>
                                </div>
                            </div>
                                        @endif
                        </td>
                        <td>
                                        @if(isset($viewMode) && $viewMode)
                                            <input type="text" class="readonly-input" value="{{ $prescription->re_axis }}" readonly>
                                        @else
                            <div mbsc-page class="demo-responsive">
                                <div style="height:100%">
                                                    <input type="text" placeholder="0" name="re_axis" class="inpt_rele" value="{{ isset($prescription) ? $prescription->re_axis : '' }}">
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($viewMode) && $viewMode)
                                            <input type="text" class="readonly-input" value="{{ $prescription->re_vision }}" readonly>
                                        @else
                                        <div mbsc-page class="demo-responsive">
                                            <div style="height:100%">
                                                <label>
                                                        <input mbsc-input class="mobiscroll-input" name="re_vision" placeholder="0" data-dropdown="true" data-input-style="outline" data-label-style="stacked" value="{{ isset($prescription) ? $prescription->re_vision : '' }}" />
                                                </label>
                                                <select class="mobiscroll-select">
                                                    <option value="2" {{ isset($prescription) && $prescription->re_vision == '6/6' ? 'selected' : '' }}>6/6</option>
                                                    <option value="3" {{ isset($prescription) && $prescription->re_vision == '6/9' ? 'selected' : '' }}>6/9</option>
                                                    <option value="4" {{ isset($prescription) && $prescription->re_vision == '6/12' ? 'selected' : '' }}>6/12</option>
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 600;">LE</td>
                                    <td>
                                        @if(isset($viewMode) && $viewMode)
                                            <input type="text" class="readonly-input" value="{{ $prescription->le_sph }}" readonly>
                                        @else
                                        <div mbsc-page class="demo-responsive">
                                            <div style="height:100%">
                                                <label>
                                                        <input mbsc-input class="mobiscroll-input" name="le_sph" placeholder="0" data-dropdown="true" data-input-style="outline" data-label-style="stacked" value="{{ isset($prescription) ? $prescription->le_sph : '' }}" />
                                                </label>
                                                <select class="mobiscroll-select">
                                                    
                                                    <option value="-35" {{ isset($prescription) && $prescription->le_sph == '-19' ? 'selected' : '' }}>-19</option>
                                                    <option value="-34" {{ isset($prescription) && $prescription->le_sph == '-18' ? 'selected' : '' }}>-18</option>
                                                    <option value="-33" {{ isset($prescription) && $prescription->le_sph == '-17' ? 'selected' : '' }}>-17</option>
                                                    <option value="-32" {{ isset($prescription) && $prescription->le_sph == '-16' ? 'selected' : '' }}>-16</option>
                                                    <option value="-31" {{ isset($prescription) && $prescription->le_sph == '-15' ? 'selected' : '' }}>-15</option>
                                                    <option value="-30" {{ isset($prescription) && $prescription->le_sph == '-14' ? 'selected' : '' }}>-14</option>
                                                    <option value="-29" {{ isset($prescription) && $prescription->le_sph == '-13' ? 'selected' : '' }}>-13</option>
                                                    <option value="-28" {{ isset($prescription) && $prescription->le_sph == '-12' ? 'selected' : '' }}>-12</option>
                                                    <option value="-27" {{ isset($prescription) && $prescription->le_sph == '-11' ? 'selected' : '' }}>-11</option>
                                                    <option value="-26" {{ isset($prescription) && $prescription->le_sph == '-10' ? 'selected' : '' }}>-10</option>
                                                    <option value="-25" {{ isset($prescription) && $prescription->le_sph == '-9' ? 'selected' : '' }}>-9</option>
                                                    <option value="-24" {{ isset($prescription) && $prescription->le_sph == '-8' ? 'selected' : '' }}>-8</option>
                                                    <option value="-23" {{ isset($prescription) && $prescription->le_sph == '-7' ? 'selected' : '' }}>-7</option>
                                                    <option value="-22" {{ isset($prescription) && $prescription->le_sph == '-6.50' ? 'selected' : '' }}>-6.50</option>
                                                    <option value="-21" {{ isset($prescription) && $prescription->le_sph == '-6' ? 'selected' : '' }}>-6</option>
                                                    <option value="-20" {{ isset($prescription) && $prescription->le_sph == '-5.50' ? 'selected' : '' }}>-5.50</option>
                                                    <option value="-19" {{ isset($prescription) && $prescription->le_sph == '-5' ? 'selected' : '' }}>-5</option>
                                                    <option value="-18" {{ isset($prescription) && $prescription->le_sph == '-4.50' ? 'selected' : '' }}>-4.50</option>
                                                    <option value="-17" {{ isset($prescription) && $prescription->le_sph == '-4' ? 'selected' : '' }}>-4</option>
                                                    <option value="-16" {{ isset($prescription) && $prescription->le_sph == '-3.75' ? 'selected' : '' }}>-3.75</option>
                                                    <option value="-15" {{ isset($prescription) && $prescription->le_sph == '-3.50' ? 'selected' : '' }}>-3.50</option>
                                                    <option value="-14" {{ isset($prescription) && $prescription->le_sph == '-3.25' ? 'selected' : '' }}>-3.25</option>
                                                    <option value="-13" {{ isset($prescription) && $prescription->le_sph == '-3' ? 'selected' : '' }}>-3</option>
                                                    <option value="-12" {{ isset($prescription) && $prescription->le_sph == '-2.75' ? 'selected' : '' }}>-2.75</option>
                                                    <option value="-11" {{ isset($prescription) && $prescription->le_sph == '-2.50' ? 'selected' : '' }}>-2.50</option>
                                                    <option value="-10" {{ isset($prescription) && $prescription->le_sph == '-2.25' ? 'selected' : '' }}>-2.25</option>
                                                    <option value="-9" {{ isset($prescription) && $prescription->le_sph == '-2' ? 'selected' : '' }}>-2</option>
                                                    <option value="-8" {{ isset($prescription) && $prescription->le_sph == '-1.75' ? 'selected' : '' }}>-1.75</option>
                                                    <option value="-7" {{ isset($prescription) && $prescription->le_sph == '-1.50' ? 'selected' : '' }}>-1.50</option>
                                                    <option value="-6" {{ isset($prescription) && $prescription->le_sph == '-1.25' ? 'selected' : '' }}>-1.25</option>
                                                    <option value="-5" {{ isset($prescription) && $prescription->le_sph == '-1' ? 'selected' : '' }}>-1</option>
                                                    <option value="-4" {{ isset($prescription) && $prescription->le_sph == '-0.75' ? 'selected' : '' }}>-0.75</option>
                                                    <option value="-3" {{ isset($prescription) && $prescription->le_sph == '-0.50' ? 'selected' : '' }}>-0.50</option>
                                                    <option value="-2" {{ isset($prescription) && $prescription->le_sph == '-0.25' ? 'selected' : '' }}>-0.25</option>
                                                    <option value="0" {{ !isset($prescription) || $prescription->le_sph == '0' || $prescription->le_sph == null ? 'selected' : '' }}>0</option>
                                                    <option value="2" {{ isset($prescription) && $prescription->le_sph == '+0.25' ? 'selected' : '' }}>+0.25</option>
                                                    <option value="3" {{ isset($prescription) && $prescription->le_sph == '+0.50' ? 'selected' : '' }}>+0.50</option>
                                                    <option value="4" {{ isset($prescription) && $prescription->le_sph == '+0.75' ? 'selected' : '' }}>+0.75</option>
                                                    <option value="5" {{ isset($prescription) && $prescription->le_sph == '+1' ? 'selected' : '' }}>+1</option>
                                                    <option value="6" {{ isset($prescription) && $prescription->le_sph == '+1.25' ? 'selected' : '' }}>+1.25</option>
                                                    <option value="7" {{ isset($prescription) && $prescription->le_sph == '+1.50' ? 'selected' : '' }}>+1.50</option>
                                                    <option value="8" {{ isset($prescription) && $prescription->le_sph == '+1.75' ? 'selected' : '' }}>+1.75</option>
                                                    <option value="9" {{ isset($prescription) && $prescription->le_sph == '+2' ? 'selected' : '' }}>+2</option>
                                                    <option value="10" {{ isset($prescription) && $prescription->le_sph == '+2.25' ? 'selected' : '' }}>+2.25</option>
                                                    <option value="11" {{ isset($prescription) && $prescription->le_sph == '+2.50' ? 'selected' : '' }}>+2.50</option>
                                                    <option value="12" {{ isset($prescription) && $prescription->le_sph == '+2.75' ? 'selected' : '' }}>+2.75</option>
                                                    <option value="13" {{ isset($prescription) && $prescription->le_sph == '+3' ? 'selected' : '' }}>+3</option>
                                                    <option value="14" {{ isset($prescription) && $prescription->le_sph == '+3.25' ? 'selected' : '' }}>+3.25</option>
                                                    <option value="15" {{ isset($prescription) && $prescription->le_sph == '+3.50' ? 'selected' : '' }}>+3.50</option>
                                                    <option value="16" {{ isset($prescription) && $prescription->le_sph == '+3.75' ? 'selected' : '' }}>+3.75</option>
                                                    <option value="17" {{ isset($prescription) && $prescription->le_sph == '+4' ? 'selected' : '' }}>+4</option>
                                                    <option value="18" {{ isset($prescription) && $prescription->le_sph == '+4.50' ? 'selected' : '' }}>+4.50</option>
                                                    <option value="19" {{ isset($prescription) && $prescription->le_sph == '+5' ? 'selected' : '' }}>+5</option>
                                                    <option value="20" {{ isset($prescription) && $prescription->le_sph == '+5.50' ? 'selected' : '' }}>+5.50</option>
                                                    <option value="21" {{ isset($prescription) && $prescription->le_sph == '+6' ? 'selected' : '' }}>+6</option>
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($viewMode) && $viewMode)
                                            <input type="text" class="readonly-input" value="{{ $prescription->le_cyl }}" readonly>
                                        @else
                                        <div mbsc-page class="demo-responsive">
                                            <div style="height:100%">
                                                <label>
                                                        <input mbsc-input class="mobiscroll-input" name="le_cyl" placeholder="0" data-dropdown="true" data-input-style="outline" data-label-style="stacked" value="{{ isset($prescription) ? $prescription->le_cyl : '' }}" />
                                                </label>
                                                <select class="mobiscroll-select">
                                                    <option value="-21" {{ isset($prescription) && $prescription->le_cyl == '-6' ? 'selected' : '' }}>-6</option>
                                                    <option value="-20" {{ isset($prescription) && $prescription->le_cyl == '-5.50' ? 'selected' : '' }}>-5.50</option>
                                                    <option value="-19" {{ isset($prescription) && $prescription->le_cyl == '-5' ? 'selected' : '' }}>-5</option>
                                                    <option value="-18" {{ isset($prescription) && $prescription->le_cyl == '-4.50' ? 'selected' : '' }}>-4.50</option>
                                                    <option value="-17" {{ isset($prescription) && $prescription->le_cyl == '-4' ? 'selected' : '' }}>-4</option>
                                                    <option value="-16" {{ isset($prescription) && $prescription->le_cyl == '-3.75' ? 'selected' : '' }}>-3.75</option>
                                                    <option value="-15" {{ isset($prescription) && $prescription->le_cyl == '-3.50' ? 'selected' : '' }}>-3.50</option>
                                                    <option value="-14" {{ isset($prescription) && $prescription->le_cyl == '-3.25' ? 'selected' : '' }}>-3.25</option>
                                                    <option value="-13" {{ isset($prescription) && $prescription->le_cyl == '-3' ? 'selected' : '' }}>-3</option>
                                                    <option value="-12" {{ isset($prescription) && $prescription->le_cyl == '-2.75' ? 'selected' : '' }}>-2.75</option>
                                                    <option value="-11" {{ isset($prescription) && $prescription->le_cyl == '-2.50' ? 'selected' : '' }}>-2.50</option>
                                                    <option value="-10" {{ isset($prescription) && $prescription->le_cyl == '-2.25' ? 'selected' : '' }}>-2.25</option>
                                                    <option value="-9" {{ isset($prescription) && $prescription->le_cyl == '-2' ? 'selected' : '' }}>-2</option>
                                                    <option value="-8" {{ isset($prescription) && $prescription->le_cyl == '-1.75' ? 'selected' : '' }}>-1.75</option>
                                                    <option value="-7" {{ isset($prescription) && $prescription->le_cyl == '-1.50' ? 'selected' : '' }}>-1.50</option>
                                                    <option value="-6" {{ isset($prescription) && $prescription->le_cyl == '-1.25' ? 'selected' : '' }}>-1.25</option>
                                                    <option value="-5" {{ isset($prescription) && $prescription->le_cyl == '-1' ? 'selected' : '' }}>-1</option>
                                                    <option value="-4" {{ isset($prescription) && $prescription->le_cyl == '-0.75' ? 'selected' : '' }}>-0.75</option>
                                                    <option value="-3" {{ isset($prescription) && $prescription->le_cyl == '-0.50' ? 'selected' : '' }}>-0.50</option>
                                                    <option value="-2" {{ isset($prescription) && $prescription->le_cyl == '-0.25' ? 'selected' : '' }}>-0.25</option>                                                    
                                                    <option value="0" {{ !isset($prescription) || $prescription->le_cyl == '0' || $prescription->le_cyl == null ? 'selected' : '' }}>0</option>                                                    
                                                    <option value="2" {{ isset($prescription) && $prescription->le_cyl == '+0.25' ? 'selected' : '' }}>+0.25</option>
                                                    <option value="3" {{ isset($prescription) && $prescription->le_cyl == '+0.50' ? 'selected' : '' }}>+0.50</option>
                                                    <option value="4" {{ isset($prescription) && $prescription->le_cyl == '+0.75' ? 'selected' : '' }}>+0.75</option>
                                                    <option value="5" {{ isset($prescription) && $prescription->le_cyl == '+1' ? 'selected' : '' }}>+1</option>
                                                    <option value="6" {{ isset($prescription) && $prescription->le_cyl == '+1.25' ? 'selected' : '' }}>+1.25</option>
                                                    <option value="7" {{ isset($prescription) && $prescription->le_cyl == '+1.50' ? 'selected' : '' }}>+1.50</option>
                                                    <option value="8" {{ isset($prescription) && $prescription->le_cyl == '+1.75' ? 'selected' : '' }}>+1.75</option>
                                                    <option value="9" {{ isset($prescription) && $prescription->le_cyl == '+2' ? 'selected' : '' }}>+2</option>
                                                    <option value="10" {{ isset($prescription) && $prescription->le_cyl == '+2.25' ? 'selected' : '' }}>+2.25</option>
                                                    <option value="11" {{ isset($prescription) && $prescription->le_cyl == '+2.50' ? 'selected' : '' }}>+2.50</option>
                                                    <option value="12" {{ isset($prescription) && $prescription->le_cyl == '+2.75' ? 'selected' : '' }}>+2.75</option>
                                                    <option value="13" {{ isset($prescription) && $prescription->le_cyl == '+3' ? 'selected' : '' }}>+3</option>
                                                    <option value="14" {{ isset($prescription) && $prescription->le_cyl == '+3.25' ? 'selected' : '' }}>+3.25</option>
                                                    <option value="15" {{ isset($prescription) && $prescription->le_cyl == '+3.50' ? 'selected' : '' }}>+3.50</option>
                                                    <option value="16" {{ isset($prescription) && $prescription->le_cyl == '+3.75' ? 'selected' : '' }}>+3.75</option>
                                                    <option value="17" {{ isset($prescription) && $prescription->le_cyl == '+4' ? 'selected' : '' }}>+4</option>
                                                    <option value="18" {{ isset($prescription) && $prescription->le_cyl == '+4.50' ? 'selected' : '' }}>+4.50</option>
                                                    <option value="19" {{ isset($prescription) && $prescription->le_cyl == '+5' ? 'selected' : '' }}>+5</option>
                                                    <option value="20" {{ isset($prescription) && $prescription->le_cyl == '+5.50' ? 'selected' : '' }}>+5.50</option>
                                                    <option value="21" {{ isset($prescription) && $prescription->le_cyl == '+6' ? 'selected' : '' }}>+6</option>
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($viewMode) && $viewMode)
                                            <input type="text" class="readonly-input" value="{{ $prescription->le_axis }}" readonly>
                                        @else
                                        <div mbsc-page class="demo-responsive">
                                            <div style="height:100%">
                                                    <input type="text" placeholder="0" name="le_axis" class="inpt_rele" value="{{ isset($prescription) ? $prescription->le_axis : '' }}">
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($viewMode) && $viewMode)
                                            <input type="text" class="readonly-input" value="{{ $prescription->le_vision }}" readonly>
                                        @else
                                        <div mbsc-page class="demo-responsive">
                                            <div style="height:100%">
                                                <label>
                                                        <input mbsc-input class="mobiscroll-input" name="le_vision" placeholder="0" data-dropdown="true" data-input-style="outline" data-label-style="stacked" value="{{ isset($prescription) ? $prescription->le_vision : '' }}" />
                                                </label>
                                                <select class="mobiscroll-select">
                                                    <option value="2" {{ isset($prescription) && $prescription->le_vision == '2' ? 'selected' : '' }}>2</option>
                                                    <option value="3" {{ isset($prescription) && $prescription->le_vision == '3' ? 'selected' : '' }}>3</option>
                                                    <option value="4" {{ isset($prescription) && $prescription->le_vision == '4' ? 'selected' : '' }}>4</option>
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 600;">ADD</td>
                                    <td>
                                        @if(isset($viewMode) && $viewMode)
                                            <input type="text" class="readonly-input" value="{{ $prescription->add_l }}" readonly>
                                        @else
                                        <div mbsc-page class="demo-responsive">
                                            <div style="height:100%">
                                                <label>
                                                        <input mbsc-input class="mobiscroll-input" name="add_l" placeholder="0" data-dropdown="true" data-input-style="outline" data-label-style="stacked" value="{{ isset($prescription) ? $prescription->add_l : '' }}" />
                                                </label>
                                                <select class="mobiscroll-select">
                                                    <option value="0" {{ isset($prescription) && $prescription->add_l == '0' ? 'selected' : '' }}>0</option>
                                                    <option value="5" {{ isset($prescription) && $prescription->add_l == '+1.00' ? 'selected' : '' }}>+1.00</option>
                                                    <option value="6" {{ isset($prescription) && $prescription->add_l == '+1.25' ? 'selected' : '' }}>+1.25</option>
                                                    <option value="7" {{ isset($prescription) && $prescription->add_l == '+1.50' ? 'selected' : '' }}>+1.50</option>
                                                    <option value="8" {{ isset($prescription) && $prescription->add_l == '+1.75' ? 'selected' : '' }}>+1.75</option>
                                                    <option value="9" {{ isset($prescription) && $prescription->add_l == '+2' ? 'selected' : '' }}>+2</option>
                                                    <option value="10" {{ isset($prescription) && $prescription->add_l == '+2.25' ? 'selected' : '' }}>+2.25</option>
                                                    <option value="11" {{ isset($prescription) && $prescription->add_l == '+2.50' ? 'selected' : '' }}>+2.50</option>
                                                    <option value="12" {{ isset($prescription) && $prescription->add_l == '+2.75' ? 'selected' : '' }}>+2.75</option>
                                                    <option value="13" {{ isset($prescription) && $prescription->add_l == '+3' ? 'selected' : '' }}>+3</option>
                                                    <option value="14" {{ isset($prescription) && $prescription->add_l == '+3.25' ? 'selected' : '' }}>+3.25</option>
                                                    <option value="15" {{ isset($prescription) && $prescription->add_l == '+3.50' ? 'selected' : '' }}>+3.50</option>
                                                    <option value="16" {{ isset($prescription) && $prescription->add_l == '+3.75' ? 'selected' : '' }}>+3.75</option>
                                                    <option value="17" {{ isset($prescription) && $prescription->add_l == '+4' ? 'selected' : '' }}>+4</option>
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($viewMode) && $viewMode)
                                            <input type="text" class="readonly-input" value="{{ $prescription->add_r }}" readonly>
                                        @else
                                        <div mbsc-page class="demo-responsive">
                                            <div style="height:100%">
                                                <label>
                                                        <input mbsc-input class="mobiscroll-input" name="add_r" placeholder="0" data-dropdown="true" data-input-style="outline" data-label-style="stacked" value="{{ isset($prescription) ? $prescription->add_r : '' }}" />
                                                </label>
                                                <select class="mobiscroll-select">
                                                    <option value="0" {{ isset($prescription) && $prescription->add_r == '0' ? 'selected' : '' }}>0</option>
                                                    <option value="5" {{ isset($prescription) && $prescription->add_r == '+1.00' ? 'selected' : '' }}>+1.00</option>
                                                    <option value="6" {{ isset($prescription) && $prescription->add_r == '+1.25' ? 'selected' : '' }}>+1.25</option>
                                                    <option value="7" {{ isset($prescription) && $prescription->add_r == '+1.50' ? 'selected' : '' }}>+1.50</option>
                                                    <option value="8" {{ isset($prescription) && $prescription->add_r == '+1.75' ? 'selected' : '' }}>+1.75</option>
                                                    <option value="9" {{ isset($prescription) && $prescription->add_r == '+2' ? 'selected' : '' }}>+2</option>
                                                    <option value="10" {{ isset($prescription) && $prescription->add_r == '+2.25' ? 'selected' : '' }}>+2.25</option>
                                                    <option value="11" {{ isset($prescription) && $prescription->add_r == '+2.50' ? 'selected' : '' }}>+2.50</option>
                                                    <option value="12" {{ isset($prescription) && $prescription->add_r == '+2.75' ? 'selected' : '' }}>+2.75</option>
                                                    <option value="13" {{ isset($prescription) && $prescription->add_r == '+3' ? 'selected' : '' }}>+3</option>
                                                    <option value="14" {{ isset($prescription) && $prescription->add_r == '+3.25' ? 'selected' : '' }}>+3.25</option>
                                                    <option value="15" {{ isset($prescription) && $prescription->add_r == '+3.50' ? 'selected' : '' }}>+3.50</option>
                                                    <option value="16" {{ isset($prescription) && $prescription->add_r == '+3.75' ? 'selected' : '' }}>+3.75</option>
                                                    <option value="17" {{ isset($prescription) && $prescription->add_r == '+4' ? 'selected' : '' }}>+4</option>
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="right right-20">
                	<div style="text-align:right;">
                        <span>Total :</span>
                        @if(isset($viewMode) && $viewMode)
                            <input type="text" class="readonly-input" value="₹ {{ number_format($prescription->total ?? 0, 2) }}" readonly>
                        @else
                            <input type="text" name="total" style="" placeholder="₹ 0 .00" value="{{ isset($prescription) ? $prescription->total : '' }}" required>
                        @endif
                    </div>

                    <div style="text-align:right; margin-top: 10px;">
                        <span>Advance :</span>
                        @if(isset($viewMode) && $viewMode)
                            <input type="text" class="readonly-input" value="₹ {{ number_format($prescription->advance ?? 0, 2) }}" readonly>
                        @else
                            <input type="text" name="advance" style="" placeholder="₹ 0 .00" value="{{ isset($prescription) ? $prescription->advance : '' }}">
                        @endif
                    </div>

                    <div style="text-align:right; margin-top: 10px;">
                        <span>Balance :</span>
                        @if(isset($viewMode) && $viewMode)
                            <input type="text" class="readonly-input" value="₹ {{ number_format($prescription->balance ?? 0, 2) }}" readonly>
                        @else
                            <input type="text" name="balance" style="" placeholder="₹ 0 .00" value="{{ isset($prescription) ? $prescription->balance : '' }}">
                        @endif
                    </div>
                </div>
            </div>

            <div style="display:flex; align-items: center; justify-content: center;column-gap: 10px;" class="no-print">
                @if(!isset($viewMode) || !$viewMode)
                    <button type="submit" class="submit">Submit</button>
                @endif
                <a class="submit print" href="#" onclick="window.print(); return false;">Print</a>
                @if(!isset($viewMode) || !$viewMode)
                    <button type="submit" name="send_whatsapp" value="1" class="submit whatsapp">
                        <img src="{{ asset('visionui/img/whatsapp.svg') }}" style="height:22px;"> <span>Send</span>
                    </button>
                @endif
            </div>

            <div class="top_section text-center">
                <div class="gray_line" style="border-radius: 0px 0px 30px 30px;">
                    <p class="p" style=""><b>Remark:</b> 
                        @if(isset($viewMode) && $viewMode)
                            <input type="text" class="readonly-input" value="{{ $prescription->remarks }}" readonly style="width:80%;">
                        @else
                            <input type="text" name="remarks" value="{{ isset($prescription) ? $prescription->remarks : 'Constant Use, near, Bifocal, progressive' }}" style="border:none;background:transparent;width:80%;">
                        @endif
                    </p>
                </div>
            </div>

        </div>
    </div>
</form>

@if(!isset($viewMode) || !$viewMode)
    <script>
        mobiscroll.setOptions({
            locale: mobiscroll.localeEn,
            theme: 'ios',
            themeVariant: 'light'
            });
        
        document.querySelectorAll('.mobiscroll-select').forEach((select, index) => {
          let input = document.querySelectorAll('.mobiscroll-input')[index];
          
          mobiscroll.select(select, {
             inputElement: input,
             touchUi: true,
                display: 'anchored'
       });
          
          input.addEventListener('click', function () {
                mobiscroll.getInst(select).open();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('prescriptionForm');
            const amountInputs = document.querySelectorAll('.input_amount');
            const totalInput = document.querySelector('input[name="total"]');
            const advanceInput = document.querySelector('input[name="advance"]');
            const balanceInput = document.querySelector('input[name="balance"]');

            // Format number to Indian currency format
            function formatIndianCurrency(number) {
                return '₹ ' + (number / 100).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }

            // Parse currency string to number (in paise)
            function parseCurrency(value) {
                if (!value) return 0;
                // Remove currency symbol, commas and convert to float
                const numericValue = parseFloat(value.replace(/[^\d.-]/g, '')) || 0;
                // Convert to paise (multiply by 100)
                return Math.round(numericValue * 100);
            }

            function calculateTotal() {
                let total = 0;
                amountInputs.forEach(input => {
                    const value = parseCurrency(input.value);
                    if (value > 0) {
                        total += value;
                    }
                });
                totalInput.value = formatIndianCurrency(total);
                
                // Update hidden input for total
                let hiddenTotal = form.querySelector('input[name="total_actual"]');
                if (!hiddenTotal) {
                    hiddenTotal = createHiddenInput('total', total);
                    form.appendChild(hiddenTotal);
                }
                hiddenTotal.value = total;
                
                calculateBalance();
            }

            function calculateBalance() {
                const total = parseCurrency(totalInput.value);
                const advance = parseCurrency(advanceInput.value);
                const balance = Math.max(0, total - advance);
                balanceInput.value = formatIndianCurrency(balance);
                
                // Update hidden inputs for advance and balance
                let hiddenAdvance = form.querySelector('input[name="advance_actual"]');
                let hiddenBalance = form.querySelector('input[name="balance_actual"]');
                
                if (!hiddenAdvance) {
                    hiddenAdvance = createHiddenInput('advance', advance);
                    form.appendChild(hiddenAdvance);
                }
                if (!hiddenBalance) {
                    hiddenBalance = createHiddenInput('balance', balance);
                    form.appendChild(hiddenBalance);
                }
                
                hiddenAdvance.value = advance;
                hiddenBalance.value = balance;
            }

            // Create hidden input for actual values
            function createHiddenInput(name, value) {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = name + '_actual';
                input.value = value;
                return input;
            }

            // Handle input for amount fields
            amountInputs.forEach(input => {
                // Create hidden input for each amount field
                const hiddenInput = createHiddenInput(input.name, '');
                form.appendChild(hiddenInput);

                input.addEventListener('input', function(e) {
                    let value = this.value.replace(/[^\d.]/g, '');
                    
                    // Handle decimal points
                    const parts = value.split('.');
                    if (parts.length > 2) {
                        value = parts[0] + '.' + parts.slice(1).join('');
                    }
                    
                    if (parts.length === 2 && parts[1].length > 2) {
                        value = parts[0] + '.' + parts[1].substring(0, 2);
                    }
                    
                    this.value = value;
                    calculateTotal();
                });

                input.addEventListener('blur', function() {
                    const value = parseCurrency(this.value);
                    if (value > 0) {
                        this.value = formatIndianCurrency(value);
                        // Update hidden input
                        const hiddenInput = form.querySelector(`input[name="${this.name}_actual"]`);
                        if (hiddenInput) {
                            hiddenInput.value = value;
                        }
                    } else {
                        this.value = '';
                        const hiddenInput = form.querySelector(`input[name="${this.name}_actual"]`);
                        if (hiddenInput) {
                            hiddenInput.value = '0';
                        }
                    }
                    calculateTotal();
                });
            });

            // Handle input for advance field
            advanceInput.addEventListener('input', function(e) {
                let value = this.value.replace(/[^\d.]/g, '');
                
                const parts = value.split('.');
                if (parts.length > 2) {
                    value = parts[0] + '.' + parts.slice(1).join('');
                }
                
                if (parts.length === 2 && parts[1].length > 2) {
                    value = parts[0] + '.' + parts[1].substring(0, 2);
                }
                
                this.value = value;
                calculateBalance();
            });

            advanceInput.addEventListener('blur', function() {
                const value = parseCurrency(this.value);
                if (value > 0) {
                    this.value = formatIndianCurrency(value);
                } else {
                    this.value = '';
                }
                calculateBalance();
            });

            // Make total and balance read-only
            totalInput.readOnly = true;
            balanceInput.readOnly = true;

            // Initialize calculations and format any pre-filled values
            amountInputs.forEach(input => {
                if (input.value) {
                    const value = parseCurrency(input.value);
                    input.value = formatIndianCurrency(value);
                    const hiddenInput = form.querySelector(`input[name="${input.name}_actual"]`);
                    if (hiddenInput) {
                        hiddenInput.value = value;
                    }
                }
            });

            if (advanceInput.value) {
                const value = parseCurrency(advanceInput.value);
                advanceInput.value = formatIndianCurrency(value);
            }

            calculateTotal();

            // Update form submission to use hidden inputs
            form.addEventListener('submit', function(e) {
                const hiddenInputs = form.querySelectorAll('input[name$="_actual"]');
                hiddenInputs.forEach(hidden => {
                    const originalName = hidden.name.replace('_actual', '');
                    const originalInput = form.querySelector(`input[name="${originalName}"]`);
                    if (originalInput) {
                        originalInput.value = hidden.value;
                    }
                });
            });
        });
    </script>
@endif

</body>

</html>

