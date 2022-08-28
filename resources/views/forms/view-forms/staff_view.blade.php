  <table class="table">
    <thead class="table-secondary">
      <tr>
        <th scope="col" colspan="4"><h5>Details of {{ $staff->fullname }}</h5></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">First Name</th>
        <td>{{ $staff->firstname }}</td>
      </tr>
      <tr>
        <th scope="row">Other Names</th>
        <td>{{ $staff->othernames }}</td>
      </tr>
      <tr>
        <th scope="row">Date of Birth</th>
        <td>{{ $staff->date_of_birth }} (Age: {{ $staff->age }})</td>
      </tr>
      <tr>
        <th scope="row">Address</th>
        <td>{{ $staff->address }}</td>
      </tr>
      <tr>
        <th scope="row">Department</th>
        <td>{{ $staff->department }}</td>
      </tr>
      <tr>
        <th scope="row">Salary Type</th>
        <td>{{ $staff->salary_type }}</td>
      </tr>
      <tr>
        <th scope="row" style="width: 30%">Level of Education</th>
        <td>{{ $staff->level_of_education }}</td>
      </tr>
      <tr>
        <th scope="row">Qualification</th>
        <td>{{ $staff->qualification }}</td>
      </tr>
      <tr>
        <th scope="row">Relative Name</th>
        <td>{{ $staff->relative_name }}</td>
      </tr>
      <tr>
        <th scope="row">Relative Number</th>
        <td>{{ $staff->relative_contact }}</td>
      </tr>
    </tbody>
  </table>