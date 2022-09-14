<!DOCTYPE>
 <html>

    <title>HMS | Payslip</title>
    <link rel="shortcut icon" href="{{ asset('public/assets/dist/img/smmie_logo.ico') }}" type="image/ico">
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap-5.2.0-dist/css/bootstrap.min.css') }}">

	<style type="text/css">
        #logo{
            text-align: center;
            border-bottom: 2px solid;
            /* margin-bottom: 10px; */
            margin-right: 14px;
        }

        #logo-text {
            font-size: 1.5rem; 
            font-weight: bold;
            margin-bottom: 5px;
            margin-top: 0px;
            text-transform: uppercase;
        }

        button {
            float: right;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 20px;
            padding-left: 20px;
            font-weight: bolder;
            border: solid 1px;
            border-radius: 20px;
            position: relative;
            margin-right: 5%;
        }

        @media print {
            .noprint, #back{
                visibility: hidden;
            }

            #myheader_opd {
                position: fixed;
                top: 0;
                right: 0; 
                }

            /* @page{
                size: landscape;
            } */

            tfoot{
                page-break-before: always;
            }
        }

        @media screen {
            #myheader_opd{
            display: none;
            }

            /* br {
                display: none;
            } */
        }

    </style>

	<script type="text/javascript">
		function print_1(){
			window.print();
			window.location = "{{ url()->previous() }}";
		}
	</script>

</head>

    <body style="width: 100%;" >

        <div id="back"><a href="{{ url()->previous() }}">Back</a></div>
        <header id="header">
            <div id="logo">
                <h5 id="logo-text">Payslip</h5>
            </div>
        </header>

        <div class = "data">
            <table class="table border-secondary mt-3">
                <tr>
                    <td colspan="2" style="width: 60%; background: #eee">EMPLOYEE INFORMATION</td>
                    <td style="width: 20%; background: #eee">PAY MONTH</td>
                    <td style="width: 20%; background: #eee">PAY TYPE</td>
                </tr>
                <tr>
                    <td style="width: 20%">Name: </td>
                    <td style="width: 40%">{{ $staff->fullname }}</td>
                    <td style="width: 20%;">{{ $pay->pay_month }}, {{ $pay->pay_year }}</td>
                    <td style="width: 20%;">{{ $staff->salary_type }}</td>
                </tr>
                <tr>
                    <td style="width: 20%">Position: </td>
                    <td style="width: 40%">{{ $staff->position }}</td>
                    <td style="width: 20%; background: #eee">Staff ID</td>
                    <td style="width: 20%; background: #eee">SSF Number</td>
                </tr>
                <tr>
                    <td style="width: 20%">Bank: </td>
                    <td style="width: 40%">{{ $staff->banker }}, {{ $staff->bank_branch }}</td>
                    <td style="width: 20%;">{{ $staff->staff_id }}</td>
                    <td style="width: 20%;">{{ $staff->ssnit_number }}</td>
                </tr>
                <tr>
                    <td style="width: 20%">Account No.: </td>
                    <td style="width: 40%">{{ $staff->bank_account }}</td>
                    <td style="width: 20%;">Annual Salary:</td>
                    <td style="width: 20%;">{{ number_format($pay->basic * 12, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="5"><br></td>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: left; background: #eee">Earnings</th>
                </tr>
                <tr>
                    <td style="width: 20%">Basic Salary</td>
                    <td style="width: 40%"></td>
                    <td style="width: 20%;">{{ number_format($pay->basic, 2) }}</td>
                    <td style="width: 20%;"></td>
                </tr>
                @php
                    $allowances = \App\Models\PayrollDependecy::where('id', $pay->depend_id)->first();
                @endphp

                @if(!empty($allowances->incomes))            
                    @foreach ($allowances->incomes as $i => $incomes)
                    <tr>
                        <td style="width: 20%" nowrap>{{ $incomes }}</td>
                        <td style="width: 40%"></td>
                        <td style="width: 20%;">{{ number_format($allowances->amount_incomes[$i], 2) }}</td>
                        <td style="width: 20%;"></td>
                    </tr>
                    @endforeach
                @endif
                
                <tr>
                    <th style="width: 20%">Gross Pay</th>
                    <td style="width: 40%"></td>
                    <td style="width: 20%;"></td>
                    <th style="width: 20%;">{{ number_format($pay->gross_income, 2) }}</th>
                </tr>
                <tr>
                    <td colspan="5"><br></td>
                </tr>
                <tr>
                    <td style="width: 20%">SSF Employer</td>
                    <td style="width: 40%"></td>
                    <td style="width: 20%;">{{ number_format($allowances->employer_ssf, 2) }}</td>
                    <td style="width: 20%;"></td>
                </tr>
                <tr>
                    <td colspan="5"><br></td>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: left; background: #eee">Deductions</th>
                </tr>
                <tr>
                    <td style="width: 20%">Income Tax</td>
                    <td style="width: 40%"></td>
                    <td style="width: 20%;">{{ number_format($allowances->tax, 2) }}</td>
                    <td style="width: 20%;"></td>
                </tr>
                <tr>
                    <td style="width: 20%">SSF Employee</td>
                    <td style="width: 40%"></td>
                    <td style="width: 20%;">{{ number_format($allowances->employee_ssf, 2) }}</td>
                    <td style="width: 20%;"></td>
                </tr>
                @if(!empty($allowances->deductions))
                    @foreach ($allowances->deductions as $i => $deductions)
                    <tr>
                        <td style="width: 20%" nowrap>{{ $deductions }}</td>
                        <td style="width: 40%"></td>
                        <td style="width: 20%;">{{ number_format($allowances->amount_deductions[$i], 2) }}</td>
                        <td style="width: 20%;"></td>
                    </tr>
                    @endforeach
                @endif
                
                <tr>
                    <th style="width: 20%">Total Deduction</th>
                    <td style="width: 40%"></td>
                    <td style="width: 20%;"></td>
                    <th style="width: 20%;">{{ number_format((array_sum($allowances->amount_deductions ?? [0]) + $allowances->tax + $allowances->employee_ssf), 2) }}</th>
                </tr>
                <tr>
                    <td colspan="5"><br></td>
                </tr>
                <tr>
                    <th style="width: 20%">Net Pay</th>
                    <td style="width: 40%"></td>
                    <td style="width: 20%;"></td>
                    <th style="width: 20%;">{{ number_format($pay->net_income, 2) }}</th>
                </tr>
            </table>

        </div>

        
        <button class="noprint btn btn-outline-dark" onclick="print_1()"> &#128438; Print</button>
		
    </body>
</html>

