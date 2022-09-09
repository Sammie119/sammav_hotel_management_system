<label>Message:</label>
    <div class="form-floating mb-3">
        <textarea rows="5" style="width: 100%" disabled>{{ $message->message }}</textarea>
    </div>
<table class="table">
  <thead class="table-secondary">
    <tr>
      <th>#</th>
      <th scope="col">Name</th>
      <th scope="col">Phone Number</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($message->phone_numbers as $i => $name)
    <tr>
      <td>{{ ++$i }}</td>
      <td scope="row">{{ $name['name'] }}</td>
      <td>{{ $name['phone'] }}</td>
    </tr>
    @endforeach    
  </tbody>
</table>