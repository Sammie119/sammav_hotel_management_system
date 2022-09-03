<h4>Loan Details for {{ $staff->fullname }}</h4>
  <table class="table">
    <thead class="table-secondary">
      <tr>
        <th>Description</th>
        <th>Amount</th>
        <th>Amount Paid</th>
        <th>Total Paid</th>
        <th>Month(s)</th>
        <th>Status</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      @php
        $des = $loan->description;
      @endphp
      @forelse ($loan->loan_pay as $loan)
        <tr>
          <td>{{ $des }}</td>
          <td>{{ number_format($loan->amount, 2) }}</td>
          <td>{{ number_format($loan->amount_paid, 2) }}</td>
          <td>{{ number_format($loan->total_amount_paid, 2) }}</td>
          <td>{{ $loan->months_paid }}</td>
          <td>{{ getLoanStatus($loan->status) }}</td>
          <td>{{ $loan->updated_at->format('d-m-Y') }}</td>
        </tr>
      @empty
        
      @endforelse
      
    </tbody>
  </table>