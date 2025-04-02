@extends('vision.layouts.app')

@section('content')
@if(session('success'))
<div class="notification notification-success show" style="background-color: #4CAF50; color: white; padding: 15px; border-radius: 5px; margin-bottom: 15px; text-align: center;">
    <span>{{ session('success') }}</span>
</div>
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
                    <span style="font-weight: 500;">No. :</span> <span class="big_size">{{ $prescription->invoice_no }}</span>
                </div>
                <div class="right">
                    <span style="font-weight: 500;">Date:</span>
                    <input type="text" disabled value="{{ $prescription->date->format('d/m/Y') }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px;">
                </div>
            </div>
            
            <div style="" class="name_and_mob">
                <div class="left">
                    <span style="font-weight: 500;">Name:</span>
                    <input type="text" disabled value="{{ $prescription->customer_name }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px;">
                </div>
                <div class="right">
                    <span style="font-weight: 500;">Mob:</span>
                    <input type="text" disabled value="{{ $prescription->mobile_number }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px;">
                </div>
            </div>

            <div style="" class="prescription">
                <div class="left">
                    <div class="">
                        <div style="float: left;margin-right: 20px;margin-top: 5px; font-weight: 500;">Prescription: </div>
                        <select disabled style="border: 1px solid #ddd; background: white; padding: 4px 8px;">
                            <option selected>{{ $prescription->prescription_type }}</option>
                        </select>
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
                            <td><p style="">Frame</p></td>
                            <td class="tbody_input">
                                <input type="text" disabled value="{{ $prescription->frame_description }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                            </td>
                            <td>
                                <input type="text" disabled value="₹ {{ $prescription->frame_amount }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; text-align: right;">
                            </td>
                        </tr>
                        <tr>
                            <td><p style="">Glass</p></td>
                            <td class="tbody_input">
                                <input type="text" disabled value="{{ $prescription->glass_description }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                            </td>
                            <td>
                                <input type="text" disabled value="₹ {{ $prescription->glass_amount }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; text-align: right;">
                            </td>
                        </tr>
                        <tr>
                            <td><p style="">Photo</p></td>
                            <td class="tbody_input">
                                <input type="text" disabled value="{{ $prescription->photo_description }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                            </td>
                            <td>
                                <input type="text" disabled value="₹ {{ $prescription->photo_amount }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; text-align: right;">
                            </td>
                        </tr>
                        <tr>
                            <td><p style="text-wrap: nowrap;">Other</p></td>
                            <td class="tbody_input">
                                <input type="text" disabled value="{{ $prescription->other_description }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                            </td>
                            <td>
                                <input type="text" disabled value="₹ {{ $prescription->other }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; text-align: right;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="fourth_box">
            <div class="left left-30">
                <div class="table_four">
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
                                    <input type="text" disabled value="{{ $prescription->re_sph }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                                </td>
                                <td>
                                    <input type="text" disabled value="{{ $prescription->re_cyl }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                                </td>
                                <td>
                                    <input type="text" disabled value="{{ $prescription->re_axis }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                                </td>
                                <td>
                                    <input type="text" disabled value="{{ $prescription->re_vision }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: 600;">LE</td>
                                <td>
                                    <input type="text" disabled value="{{ $prescription->le_sph }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                                </td>
                                <td>
                                    <input type="text" disabled value="{{ $prescription->le_cyl }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                                </td>
                                <td>
                                    <input type="text" disabled value="{{ $prescription->le_axis }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                                </td>
                                <td>
                                    <input type="text" disabled value="{{ $prescription->le_vision }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: 600;">ADD</td>
                                <td>
                                    <input type="text" disabled value="L: {{ $prescription->add_l }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                                </td>
                                <td>
                                    <input type="text" disabled value="R: {{ $prescription->add_r }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; width: 100%;">
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="payments">
            <div class="left">
            </div>
            <div class="right right-20">
                <div style="text-align:right;">
                    <span>Total :</span>
                    <input type="text" disabled value="₹ {{ $prescription->total }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; text-align: right;">
                </div>

                <div style="text-align:right; margin-top: 10px;">
                    <span>Advance :</span>
                    <input type="text" disabled value="₹ {{ $prescription->advance }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; text-align: right;">
                </div>

                <div style="text-align:right; margin-top: 10px;">
                    <span>Balance :</span>
                    <input type="text" disabled value="₹ {{ $prescription->balance }}" style="border: 1px solid #ddd; background: white; padding: 4px 8px; text-align: right;">
                </div>
            </div>
        </div>

        <div style="display:flex; align-items: center; justify-content: center;column-gap: 10px;" class="no-print">
            <a class="submit" href="{{ route('prescription.index') }}">New Prescription</a>
            <button class="submit print" type="button">Print</button>
            <a class="submit whatsapp" href="{{ route('prescription.whatsapp', $prescription) }}"><img src="{{ asset('visionui/img/whatsapp.svg') }}" style="height:22px;"> <span>Send</span></a>
        </div>

        <div class="top_section text-center">
            <div class="gray_line" style="border-radius: 0px 0px 30px 30px;">
                <p class="p" style=""><b>Remark:</b> {{ $prescription->remarks ?? 'Constant Use, near, Bifocal, progressive' }}</p>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    body {
        margin: 0;
        padding: 0;
    }
    .container-main {
        margin: 0;
        padding: 0;
    }
    .container {
        box-shadow: none;
    }
    input[disabled], select[disabled] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border: none !important;
        background: transparent !important;
    }
}

/* Add specific print button styling */
.submit.print {
    background-color: #2196F3;
}
.submit.print:hover {
    background-color: #0b7dda;
}
</style>

<script>
// Add print functionality
document.addEventListener('DOMContentLoaded', function() {
    const printButton = document.querySelector('.submit.print');
    if (printButton) {
        printButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.print();
        });
    }
});
</script>
@endsection 